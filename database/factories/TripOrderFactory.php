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
        'agency_id' => 1,
        'boarding_location' => $faker->address,
        'distination' => $faker->city(),
        'package' => $faker->name(),
        'period' => $faker->word(),
        'payment_method' => null,
        'subtotal' => mt_rand(80, 800),
        'total_amount' => mt_rand(80, 800),
        'discount' => 0,
        'total_paid' => 0,
        'expire_at' => now()->addDays(3)
    ];
});
