<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order\OrderTicketPackage;
use Faker\Generator as Faker;

$factory->define(OrderTicketPackage::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->word()) . ' ' . ucfirst($faker->word()),
        'tax' => mt_rand(69, 199),
        'accommodation_name' => ucfirst($faker->word()) . ' ' . ucfirst($faker->word()),
    ];
});
