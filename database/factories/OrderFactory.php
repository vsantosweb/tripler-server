<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'code' => strtoupper(date('Y') . uniqid()),
        'customer_id' => 1,
        'status' => 2,
        'agency_id' => 1,
        'payment_method' => null,
        'subtotal' => mt_rand(80, 800),
        'total' => mt_rand(80, 800),
        'discount' => 0,
        'total_paid' => 0,
        'expire_at' => now()->addDays(3)
    ];
});
