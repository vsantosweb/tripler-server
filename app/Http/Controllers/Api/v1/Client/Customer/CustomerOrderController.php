<?php

namespace App\Http\Controllers\Api\v1\Client\Customer;

use App\Models\Trip\TripOrder;
use App\Models\Trip\TripOrderTransaction;
use App\Models\Trip\TripProcess;
use App\Models\Trip\TripSchedule;
use App\Models\Trip\TripTax;
use App\Notifications\Order\OrderApprovedNotification;
use App\Notifications\Order\OrderPlacedNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PagarMe\Client as PagarMe;

class CustomerOrderController extends CustomerController
{
    public function index()
    {
        return $this->outputJSON(auth()->user()->orders()->orderBy('created_at', 'DESC')->get(), '', false, 200);
    }
    
    public function create(Request $request)
    {

        $ticketAmountTotal = 0;
        $totalOrder = 0;

        foreach ($request->tickets as $ticket) {

            $totalOrder += $ticket['total'];
            $ticketAmountTotal += $ticket['unit_price'];
        }

        $newOrder = auth()->user()->orders()->firstOrCreate([
            'code' => strtoupper(uniqid()),
            'agency_id' => TripSchedule::find($request->trip_schedule_id)->trip->agency_id,
            'total' => $totalOrder,
            'expire_at' => now()->addMinute(15),
            'status' => 3,
        ]);

        $newTicket =  $newOrder->ticket()->firstOrCreate([
            'trip_schedule_id' => $request->trip_schedule_id,
            'type' => TripSchedule::find($request->trip_schedule_id)->trip->name,
            'period' => TripSchedule::find($request->trip_schedule_id)->period->name,
            'price' => TripSchedule::find($request->trip_schedule_id)->price,
            'total' => TripSchedule::find($request->trip_schedule_id)->price * count($request->tickets),
            'quantity' => count($request->tickets),
            'is_package' => false
        ]);

        $newTicket->boarding()->firstOrCreate([
            'name' => $request['boarding']['name'],
            'departure_time' => $request['boarding']['departure_time']
        ]);

        foreach ($request->tickets as $ticket) {

            $newPassenger = $newTicket->passengers()->firstOrCreate([
                'name' => $ticket['info']['name'],
                'type' => $ticket['type'],
                'email' => $ticket['info']['email'],
                'tax' => $ticket['tax'],
                'price' => $ticket['price'],
                'total' => $ticket['unit_price'],
            ]);

            if (!empty($ticket['optionals'])) {

                foreach ($ticket['optionals'] as $optional) {
                    $newPassenger->optionals()->firstOrCreate([
                        'name' => $optional['name'],
                        'tax' => $optional['amount']
                    ]);
                }
            }
        }

        return $this->outputJSON($newOrder->load('ticket'), '', false, 201);
    }

    public function show($code)
    {
        $order = auth()->user()->orders()->where('code', $code)->firstOrFail();

        return $this->outputJSON($order->load('ticket'), '', false, 200);
    }

    public function payment(Request $request)
    {
        $order = auth()->user()->orders()->where('code', $request->order)->firstOrfail();

        $pagarme = new PagarMe(env('PAGARME'));

        // $card = $pagarme->cards()->create([
        //     'holder_name' => $request->card_holder_name,
        //     'number' => $request->card_number,
        //     'expiration_date' => $request->card_expiration_date,
        //     'cvv' => $request->card_cvv
        // ]);

        $transaction = $pagarme->transactions()->create([
            'amount' => intval($order->total * 100),
            // 'card_id' => $request->card['id'],
            'payment_method' => $request->payment_method,
            'postback_url' => 'https://39f6202b8f680f3e16f1812a4d2610ed.m.pipedream.net',
            'payment_method' => $request->payment_method,
            'card_holder_name' => $request->card_holder_name,
            'card_cvv' => $request->card_cvv,
            'card_number' => $request->card_number,
            'card_expiration_date' => $request->card_expiration_date,
            'customer' => [
                'external_id' => auth()->user()->uuid,
                'name' => auth()->user()->name,
                'type' => 'individual',
                'country' => 'br',
                'email' => auth()->user()->email,
                'phone_numbers' => ['+5511969595521'],
                'documents' => [
                    ['type' => 'cpf', 'number' => '52770317075']
                ],
            ],
            'billing' => [
                'name' =>  auth()->user()->name,
                'address' => [
                    'country' => 'br',
                    'street' => auth()->user()->address->address_1,
                    'street_number' => '07',
                    'state' => auth()->user()->address->state->code,
                    'city' =>  auth()->user()->address->city,
                    'neighborhood' => auth()->user()->address->address_1,
                    'zipcode' => auth()->user()->address->postcode
                ]
            ],

            'items' => [
                [
                    'id' => '1',
                    'title' => $order->ticket->type . ' ' . $order->ticket->period,
                    'unit_price' => intval($request->amount * 100),
                    'quantity' => 1,
                    'tangible' => false
                ],
            ],
            'split_rules' => [
                [
                    'id' => env('PAGARME_ADMIN_ID'),
                    'percentage' => intval(TripTax::first()->percent_tax),
                    'recipient_id' => 're_ckfg1b1x202gzp66eygzvjd68'
                ],
                [
                    'id' => env('PAGARME_AGENCY_ID'),
                    'percentage' => intval(100 - TripTax::first()->percent_tax),
                    'recipient_id' => 're_ckf8mdiry05d3ou6d3ex5eoha',
                    'charge_processing_fee' => 'true'
                ]
            ]
        ]);

        $order->status = 2;
        $order->save();

        auth()->user()->notify(new OrderPlacedNotification($order));

        return $this->outputJSON($order->code, $transaction->status, false, 201);
    }

    public function cancel($orderID)
    {
    }

    public function postBackOrder(Request $request)
    {
        return $request->all();
        
        $tripOrder = TripOrder::where('code',  $request['transaction[customer][external_id]'])->first();

        $newTransaction = TripOrderTransaction::firstOrCreate([
            'trip_order_id' => $tripOrder->id,
            'status' => $request['current_status'],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'code' => Str::uuid(),
            'metadata' => $request->all()
        ]);

        if ($newTransaction->status === 'paid') {
            $tripOrder->status = 1;

            $tripProcess = new TripProcess();

            $tripProcess->firstOrCreate([
                'code' => Str::uuid(),
                'customer_id' => $tripOrder->customer->id,
                'trip_schedule_id' => $tripOrder->tripOrderItem->trip_schedule_id,
                'status' => 1,
                'trip_metadata' => $tripOrder,
                'start_date' =>  $tripOrder->tripOrderItem->tripSchedule->start_date,
                'end_date' =>  $tripOrder->tripOrderItem->tripSchedule->end_date,
            ]);

            return $tripOrder->customer->notify(new OrderApprovedNotification($tripOrder));
        }

        return $newTransaction;
    }
}
