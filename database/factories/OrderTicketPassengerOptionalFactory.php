<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order\OrderTicketPassengerOptional;
use Faker\Generator as Faker;

$factory->define(OrderTicketPassengerOptional::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->word()),
        'tax' => mt_rand(20, 120),
    ];
});
