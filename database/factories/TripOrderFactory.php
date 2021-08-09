<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Trip\TripOrder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(TripOrder::class, function (Faker $faker) {
    return [
        'code' => strtoupper(date('Y') . uniqid()),
        'customer_id' => 1,
        'trip_order_status_id' => 2,
        'boarding_location' =>  str_replace(array("\r", "\n", " "), "", 'test'),
        'trip_name' => $faker->address,
        'trip_package' => str_replace(array("\r", "\n", " "), "", 'test'),
        'passengers' => str_replace(array("\r", "\n", " "), "", 'test'),
        'payment_method' => 'credit_card',
        'total_amount' => mt_rand(80, 800),
        'expire_at' => now(),
        'tax' => 6,
    ];
});
