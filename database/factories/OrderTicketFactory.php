<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order\OrderTicket;
use Faker\Generator as Faker;

$factory->define(OrderTicket::class, function (Faker $faker) {
    return [
        'trip_schedule_id' => 1,
        'type' => 'Pacote',
        'period' => 'Bate & Volta',
        'price' => mt_rand(80, 700),
        'total'=>  mt_rand(80, 700),
        'quantity' => mt_rand(1, 10),
        'is_package' => mt_rand(0, 1)
    ];
});
