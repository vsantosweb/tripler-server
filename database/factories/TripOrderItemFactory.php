<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Trip\TripOrderItem;
use Faker\Generator as Faker;

$factory->define(TripOrderItem::class, function (Faker $faker) {
    return [
        'trip_schedule_id' => 1,
        'price' => mt_rand(80, 700),
        'quantity' => mt_rand(1, 6)
    ];
});
