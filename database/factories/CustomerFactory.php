<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Customer\Customer;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

$factory->define(Customer::class, function (Faker $faker) {

    $gender = ['M', 'F'];
    
    return [
        'name'=> $faker->name,
        'uuid' => Str::uuid(),
        'email'=> $faker->email,
        'password'=> Hash::make('password'),
        'document_1'=> uniqid(),
        'birthday'=> $faker->date(),
        'gender'=> $gender[mt_rand(0,1)],
        'phone'=> $faker->phoneNumber(),
        'email_verified_at'=> now(),
        'home_dir' => 'customers/'. Str::uuid()
    ];
});
