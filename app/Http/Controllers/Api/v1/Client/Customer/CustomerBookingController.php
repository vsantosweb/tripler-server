<?php

namespace App\Http\Controllers\Api\v1\Client\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Booking\BookingResource;
use App\Models\Booking\Booking;
use App\Models\Trip\TripSchedule;
use App\Models\Trip\TripSchedulePassengerType;
use Illuminate\Http\Request;
use PagarMe\Client as PagarMe;
use Stevebauman\Location\Facades\Location;


class CustomerBookingController extends Controller
{
    protected $pagarme;

    public function __construct()
    {
        $this->pagarme =  new PagarMe(env('PAGARME'));
    }

    /**
     * Inicia uma nova reserva
     */

    public function createBooking(Request $request)
    {
        try {

            $tripSchedule = TripSchedule::where('uuid', $request->trip_schedule_uuid)->firstOrfail();

            $passengers = $request->passengers;

            $tripSchedule->checkAvaiability($passengers);

            $booking = auth()->user()->bookings()->firstOrCreate([
                'trip_schedule_id' => $tripSchedule->id,
                'booking_status_id' => 2,
                'agency_id' => $tripSchedule->trip->agency->id,
                'quantity' => count($passengers),
                'check_in_date' => $tripSchedule->start_date,
                'check_out_date' => $tripSchedule->end_date,
                'unit_price' => $tripSchedule->price,
                'expire_at' => now()->addDays(3),
                'is_package' => false,
            ]);

            array_map(function ($passenger) use ($booking, $tripSchedule) {

                $passengerType = $tripSchedule->passengers()->where('uuid', $passenger['passenger_type_uuid'])->firstOrfail();
                $boarding = $tripSchedule->boardings()->where('uuid', $passenger['boarding_location_uuid'])->firstOrfail();

                $booking->items()->create([

                    'booking_id' => $booking->id,
                    'passenger_type_id' => $passengerType->id,
                    'boarding_location_id' => $boarding->id,
                    'price_fee' => $passengerType->pivot->amount,
                    'total_amount' => $tripSchedule->price + $passengerType->pivot->amount,

                ]);

                $booking->total = $booking->total + ($tripSchedule->price + $passengerType->pivot->amount);

                $booking->save();
            }, $passengers);

            return $this->outputJSON(new BookingResource($booking->with('items')->find($booking->id)), 'Reserva iniciada com sucesso', false, 201);
        } catch (\Throwable $th) {

            return $this->outputJSON([], $th->getMessage(), true, 400);
        }
    }

    // Confirmar reserva 
    public function confirmBooking(Request $request, $bookingCode)
    {
        $booking = auth()->user()->bookings()->where('code', $bookingCode)->firstOrfail();

        $bookItems = $booking->items;
        
        array_map(function ($passenger) use ($bookItems) {

            $bookItems->map(function ($item)  use ($passenger) {

                $item->where('uuid', $passenger['uuid'])->update([
                    'name' => $passenger['name'],
                    'email' => $passenger['email'],
                    'phone' => $passenger['phone'],
                    'birthday' => $passenger['birthday']
                ]);
            });
        }, $request->passengers);
        
        $booking->booking_status_id = 3;
        $booking->save();
        $booking->refresh();
        
        return $this->outputJSON(new BookingResource($booking), 'success', true, 200);
    }

    #Efetuar pagamento de uma reserva
    public function bookingPayment(Request $request, $bookingCode)
    {

        $booking = auth()->user()->bookings()->where('code',  $bookingCode)->firstOrfail();

        if ($booking->booking_status_id !== 3) return $this->outputJSON([], 'Reserva não confirmada', true, 400);

        $transaction = $this->pagarme->transactions()->create([
            'amount' => intval($booking->total * 100),
            // 'card_id' => $request->card['id'],
            'payment_method' => $request->payment_method,
            'postback_url' => 'https://39f6202b8f680f3e16f1812a4d2610ed.m.pipedream.net',
            'payment_method' => $request->payment_method,
            'card_holder_name' => $request->card_holder_name,
            'card_cvv' => $request->card_cvv,
            'card_number' => $request->card_number,
            'card_expiration_date' => $request->card_expiration_date,
            'customer' => [
                'external_id' => $booking->code,
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
                    'state' => auth()->user()->address->state,
                    'city' =>  auth()->user()->address->city,
                    'neighborhood' => auth()->user()->address->address_1,
                    'zipcode' => auth()->user()->address->postcode
                ]
            ],

            'items' => array_map(function ($item) use ($booking) {

                $bookingItemInstnace = $booking->items()->where('uuid', $item['uuid'])->first();
                return [
                    'id' => $bookingItemInstnace->uuid,
                    'title' => $booking->tripSchedule->trip->name . ' - ' . $bookingItemInstnace->passengerType->passenger->name,
                    'unit_price' => intval($bookingItemInstnace->total_amount * 100),
                    'quantity' => 1,
                    'tangible' => false
                ];
            }, $booking->items->toArray()),

            'split_rules' => [
                [
                    'id' => env('PAGARME_ADMIN_ID'),
                    'percentage' => intval($booking->agency->type->percent_tax),
                    'recipient_id' => 're_ckfg1b1x202gzp66eygzvjd68'
                ],
                [
                    'id' => env('PAGARME_AGENCY_ID'),
                    'percentage' => intval(100 - $booking->agency->type->percent_tax),
                    'recipient_id' => 're_ckf8mdiry05d3ou6d3ex5eoha',
                    'charge_processing_fee' => 'true'
                ]
            ]
        ]);

        $booking->booking_status_id = 4;
        $booking->accepted_terms = true;

        $booking->save();

        // auth()->user()->notify(new OrderPlacedNotification($order));

        return $this->outputJSON($booking, $transaction->status, false, 201);
    }

    public function getPostbackTransaction(Request $request)
    {

        $booking = Booking::where('code',  $request['transaction[customer][external_id]'])->first();

        $bookingTransaction =  $booking->transactions()->create([
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'metadata' => $request->all(),
            'amount' => intval($request['transaction[paid_amount]']) / 100,
            'status' => $request['transaction[status]'],
            'payment_method' => $request['transaction[payment_method]'],
            'transaction_date' => now(),
            'geolocation' => Location::get($request->ip())->latitude . ',' . Location::get($request->ip())->longitude,
        ]);

        if ($bookingTransaction->status === 'paid') {

            $booking->booking_status_id = 1;

            // return $tripOrder->customer->notify(new OrderApprovedNotification($tripOrder));
        }

        return $this->outputJSON($bookingTransaction, 'sucess', false, 201);
    }

    public function bookingCancelByCustomer(Request $request, $bookingCode)
    {
        $booking = auth()->user()->bookings()->where('code',  $bookingCode)->firstOrfail();

        if($booking->is_refund) return $this->outputJSON([], 'Transação já estornada', true, 400);

        $cancelStatus = $booking->status->where('name', 'cancelled-by-customer')->firstOrfail();

        $cancellationRules = $booking->tripSchedule->cancellationModel->rules;


        $daysBeforeStart = now()->diffInDays($booking->check_in_date);


        function closest($num, $array)
        {
            $current = $array[0];

            foreach ($array as $value) {

                if (abs($num - $value) < abs($num - $current)) $current = $value;
            }
            return  $current;
        }

        $rangeDays = [];

        foreach ($cancellationRules as $rules) {

            foreach ($rules->range_days_before_start as $days) {

                array_push($rangeDays, $days);
            }
        }

        $cancellationModelChosed = null;

        foreach ($cancellationRules as $rule) {

            foreach ($rule->range_days_before_start as $days) {

                if (closest($daysBeforeStart, $rangeDays) === $days) {
                    $cancellationModelChosed = $rule;
                }
            }
        }


        $refundAmount = $booking->total * $cancellationModelChosed->refund_percent / 100;

       
        if ($booking->status->name === 'paid') {

            $partialRefundedTransaction = $this->pagarme->transactions()->refund([
                'id' => $booking->transactions()->first()->metadata->id,
                'amount' => $refundAmount * 100,
            ]);

            $booking->is_refund = true;
            $booking->refund_paid = $refundAmount;
            // $booking->booking_status_id = 6;
        }
        
        $booking->booking_status_id = $cancelStatus->id;
        $booking->cancel_date = now();
        $booking->save();

        return $this->outputJSON($booking, 'Reserva cancelada com sucesso', false, 200);
    }
}

// array = [2, 42, 82, 122, 162, 202, 242, 282, 322, 362]
// number = 112
// print closest (number, array)

// def closest (num, arr):
//     curr = arr[0]
//     foreach val in arr:
//         if abs (num - val) < abs (num - curr):
//             curr = val
//     return curr
