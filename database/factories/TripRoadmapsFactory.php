<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Trip\TripRoadmap;
use App\Models\Trip\TripSchedule;
use Faker\Generator as Faker;

$factory->define(TripRoadmap::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->word()) . ' '. ucfirst($faker->word()),
        'description'=> $faker->paragraph(mt_rand(1,3))
    ];
});
