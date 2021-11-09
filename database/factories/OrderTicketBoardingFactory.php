<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order\OrderTicketBoarding;
use Faker\Generator as Faker;

$factory->define(OrderTicketBoarding::class, function (Faker $faker) {
    return [
        'name' => $faker->locale(),
        'departure_time' => $faker->time()
    ];
});
