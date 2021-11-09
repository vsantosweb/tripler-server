<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Trip\TripRequirementItem;
use Faker\Generator as Faker;

$factory->define(TripRequirementItem::class, function (Faker $faker) {
    return [
        'title' => ucfirst($faker->word()),
        'description'=> $faker->paragraph(mt_rand(1,3)),
        'allowed' => mt_rand(0, 1)
    ];
});
