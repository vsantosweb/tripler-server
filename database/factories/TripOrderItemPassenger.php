<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Trip\TripOrderItemPassenger;
use Faker\Generator as Faker;

$factory->define(TripOrderItemPassenger::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'rg' =>uniqid(),
        'birthday' => $faker->date(),
        'phone' => $faker->phoneNumber(),
        'price' => $faker->numberBetween(10, 150),
        'discount' => 0,
        'total' => 0,
        'optionals' => '[{"name": "Passeio de jetski", "amount": 120},{"name": "Seguro Viagem", "amount": 30}]',
        'metadata' => '',
    ];
});
