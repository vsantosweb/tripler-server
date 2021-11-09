<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Trip\TripRoadmapStepValue;
use Faker\Generator as Faker;

$factory->define(TripRoadmapStepValue::class, function (Faker $faker) {

    $types = ['food', 'period', 'local'];

    return [
        'type' => $types[mt_rand(0, 2)],
        'value' => $faker->paragraph(mt_rand(1, 3))
    ];
    
});
