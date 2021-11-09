<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Booking\Booking;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
    return [
        'code' => strtoupper(uniqid()),
        'customer_id' => 2,
        'agency_id' => 1,
        // 'trip_schedule_id' => '',
        'status' => 3,
        'is_package' => 0,
        // 'check_in_date' => '',
        // 'check_out_date' => '',
        'booking_date' => now(),
        // 'cancel_date' => '',
        // 'tax' => TripTax::first()->tax,
        'expire_at' => now()->addDays(3),
    ];
});
