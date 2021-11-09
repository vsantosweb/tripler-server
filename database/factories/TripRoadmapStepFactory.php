<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Trip\TripRoadmapStep;
use Faker\Generator as Faker;

$factory->define(TripRoadmapStep::class, function (Faker $faker) {

    $types = ['date', 'time', 'local'];

    return [
        'type' => $types[mt_rand(0, 2)],
        'title' => ucfirst($faker->word()),
        'event_date' => now(),
        'description'=> $faker->paragraph(mt_rand(1,3))
    ];
});
