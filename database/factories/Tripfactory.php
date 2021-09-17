<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Trip\Trip;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Trip::class, function (Faker $faker) {
    return [
        'agency_id' => 1,
        'trip_category_id' => $faker->numberBetween($min = 1, $max = 4),
        'code' => md5(microtime()),
        'name' => $faker->city(),
        'slug' => Str::slug($faker->city()),
        'image' => 'http://lorempixel.com/g/700/700/',
        'image_url' => 'http://lorempixel.com/g/700/700/',
        'description' => $faker->paragraph(),
        'trip_status_id' => 1,
    ];
});
