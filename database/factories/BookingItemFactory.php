<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Booking\BookingItem;
use Faker\Generator as Faker;

$factory->define(BookingItem::class, function (Faker $faker) {
    return [
        // 'booking_id' => '',
        // 'passenger_type_id' => '',
        // 'boarding_location_id' => '',
        'name' => $faker->name,
        'email' => $faker->email,
        'document' => uniqid(),
        'phone' => $faker->phoneNumber(),
        'birthday' => $faker->date(),
        // 'total_amount' => '',
    ];
});
