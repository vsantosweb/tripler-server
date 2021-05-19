<?php

namespace App\Http\Controllers\Api\v1\Client\Customer;

use App\Models\Trip\TripOrder;
use App\Models\Trip\TripOrderTransaction;
use App\Models\Trip\TripProcess;
use App\Models\Trip\TripTax;
use App\Notifications\Order\OrderApprovedNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PagarMe\Client as PagarMe;

class CustomerOrderController extends CustomerController
{
    public function create(Request $request)
    {
        try {

            $tripOrder = $this->tripOrder->store($request);

        } catch (\Exception $e) {
            return $this->outputJSON([], $e->getMessage(), true, 500);
        }

        $customerAddress = $request->customer['address'];

        $pagarme = new PagarMe(env('PAGARME'));

        $transaction = $pagarme->transactions()->create([
            'amount' => intval($request->totalAmount * 100),
            'card_id' => $request->card['id'],
            'payment_method' => $request->paymentMethod['slug'],
            'postback_url' => 'https://ac6405dc8caeb8ea75bc7f5804c651e9.m.pipedream.net',
            // 'postback_url' => env('APP_URL') . '/api/v1/postback/order',
            'customer' => [
                'external_id' => $tripOrder->code,
                'name' => $request->customer['name'],
                'type' => 'individual',
                'country' => 'br',
                'email' => $request->customer['email'],
                'documents' => [
                    [
                        'type' => 'cpf',
                        'number' => '38998897032'
                    ]
                ],
                'phone_numbers' => ['+551199999999'],
            ],
            'billing' => [
                'name' => $request->customer['name'],
                'address' => [
                    'country' => 'br',
                    'street' => explode(',', $customerAddress['address_1'])[0],
                    'street_number' => explode(',', $customerAddress['address_1'])[1],
                    'state' => $customerAddress['state']['code'],
                    'city' => $customerAddress['city'],
                    'neighborhood' => $customerAddress['address_2'],
                    'zipcode' => $customerAddress['postcode']
                ]
            ],

            'items' => [
                [
                    'id' => '1',
                    'title' => $request->name,
                    'unit_price' => intval($request->totalAmount * 100),
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

        return $this->outputJSON($transaction, '$e->getMessage()', 'false', 201);
    }

    public function cancel($orderID)
    {
    }

    public function postBackOrder(Request $request)
    {
        $tripOrder = TripOrder::where('code',  $request['transaction[customer][external_id]'])->first();

        $newTransaction = TripOrderTransaction::firstOrCreate([
            'trip_order_id' => $tripOrder->id,
            'status' => $request['current_status'],
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'code' => Str::uuid(),
            'metadata' => $request->all()
        ]);
        
        if($newTransaction->status === 'paid')
        {
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
