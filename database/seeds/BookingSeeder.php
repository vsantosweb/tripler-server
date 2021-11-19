<?php

use App\Models\Booking\Booking;
use App\Models\Booking\BookingItem;
use App\Models\Booking\BookingStatuses;
use App\Models\Customer\Customer;
use App\Models\Trip\TripSchedule;
use App\Models\Trip\TripTax;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        BookingStatuses::insert([
            ['name' => 'paid', 'label' => 'Pago'],
            ['name' => 'oppened', 'label' => 'Em aberto'],
            ['name' => 'confirmed', 'label' => 'Confirmada'],
            ['name' => 'processing', 'label' => 'Em processamento'],
            ['name' => 'cancelled-by-system', 'label' => 'Cancelado pelo sistema'],
            ['name' => 'expired', 'label' => 'Expirado'],
            ['name' => 'cancelled-by-customer', 'label' => 'Cancelado pelo cliente'],
            ['name' => 'cancelled-by-agency', 'label' => 'Cancelado pela agencia'],
        ]);

        TripSchedule::all()->random(6)->each(function ($tripSchedule) {

            $vacancies = mt_rand(1, 6);

            factory(Booking::class, 1)->create([

                'trip_schedule_id' => $tripSchedule->id,
                'agency_id' => 1,
                'customer_id' => mt_rand(1, Customer::count()),
                'check_in_date' => $tripSchedule->start_date,
                'booking_status_id' => 2,
                'check_out_date' => $tripSchedule->end_date,
                'quantity' => $vacancies,
                'unit_price' => $tripSchedule->price,

            ])->each(function ($booking) use ($tripSchedule) {

                $passangerType = $tripSchedule->passengers->random();

                factory(BookingItem::class, $booking->quantity)->create([

                    'booking_id' => $booking->id,
                    'uuid' => Str::uuid(),
                    'passenger_type_id' =>  $passangerType->pivot->id,
                    'boarding_location_id' => $tripSchedule->boardings->random()->id,
                    'total_amount' =>  $passangerType->pivot->amount + $tripSchedule->price,
                    'price_fee' => $passangerType->pivot->amount,

                ])->each(function ($bookingItem) use ($booking) {

                    $totalAmount = $booking->total + $bookingItem->total_amount;
                    // dd( ($totalAmount / 100) * TripTax::first()->tax_percent);
                    $booking->update([
                        'total' => $totalAmount,
                        'commission_fee' => $totalAmount / 100 * TripTax::first()->percent_tax
                    ]);
                });
            });

            $tripSchedule->vacancies_filled = $vacancies + $tripSchedule->vacancies_filled;
            $tripSchedule->vacancies_quantity =  $tripSchedule->vacancies_quantity - $vacancies;
            $tripSchedule->save();
        });
    }
}
