<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Trip\Trip;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Trip::class, function (Faker $faker) {

    $name = ucfirst($faker->city()) . ' - ' . ucfirst($faker->city()) . ' ' . $faker->stateAbbr();

    return [
        'agency_id' => 1,
        'trip_category_id' => $faker->numberBetween($min = 1, $max = 5),
        'uuid' => Str::uuid(),
        'name' => $name,
        'slug' => Str::slug($name),
        'images' => array_fill(0, 6, 'http://lorempixel.com/g/700/700/'),
        'thumbnail' => 'http://lorempixel.com/g/700/700/',
        'description' => $faker->paragraph(mt_rand(1, 4)),
        'trip_status_id' => 1,
    ];
});