<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Trip\TripRequirement;
use Faker\Generator as Faker;

$factory->define(TripRequirement::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->word()),
        'description'=> $faker->paragraph(mt_rand(1,3)),
    ];
});
