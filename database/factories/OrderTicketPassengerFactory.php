<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order\OrderTicketPassenger;
use Faker\Generator as Faker;

$factory->define(OrderTicketPassenger::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'document' =>uniqid(),
        'type' => 'Adulto',
        'birthday' => $faker->date(),
        'phone' => $faker->phoneNumber(),
        'price' => $faker->numberBetween(10, 150),
        'tax' => $faker->numberBetween(10, 150),
        'total' => $faker->numberBetween(10, 150),
    ];
});
