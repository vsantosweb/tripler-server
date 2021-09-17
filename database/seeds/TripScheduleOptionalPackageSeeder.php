<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripScheduleOptionalPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_schedule_optional_packages')->insert([
            [
                'trip_schedule_id' => 1,
                'trip_optional_package_id' => 1,
                'thumbnail' => 'http://lorempixel.com/g/700/700',
                'gallery' => "['http://lorempixel.com/g/700/700', 'http://lorempixel.com/g/700/700', 'http://lorempixel.com/g/700/700']",
                'price' => mt_rand(3, 300),
                'quantity' => mt_rand(3, 20),
            ],
            [
                'trip_schedule_id' => 2,
                'trip_optional_package_id' => 2,
                'thumbnail' => 'http://lorempixel.com/g/700/700',
                'gallery' => "['http://lorempixel.com/g/700/700', 'http://lorempixel.com/g/700/700', 'http://lorempixel.com/g/700/700']",
                'price' => mt_rand(3, 300),
                'quantity' => mt_rand(3, 20),
            ],
            [
                'trip_schedule_id' => 3,
                'trip_optional_package_id' => 3,
                'thumbnail' => 'http://lorempixel.com/g/700/700',
                'gallery' => "['http://lorempixel.com/g/700/700', 'http://lorempixel.com/g/700/700', 'http://lorempixel.com/g/700/700']",
                'price' => mt_rand(3, 300),
                'quantity' => mt_rand(3, 200),
            ]
        ]);
    }
}
