<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Trip\TripSchedule;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(TripSchedule::class, function (Faker $faker) {

    return [
        'code' => Str::uuid(),
        'trip_id' => 1,
        'trip_schedule_category_id' => mt_rand(1, 2),
        'start_date' => now(),
        'trip_schedule_status_id' => 1,
        'end_date' => now()->addDay(2),
        'only_day' => 0,
        'published' => 1,
        'vacancies_quantity' => mt_rand(30, 65),
        'vacancies_filled' => mt_rand(1, 25),
        'price' => mt_rand(80, 700),
    ];
});
