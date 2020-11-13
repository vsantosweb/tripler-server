<?php

use Illuminate\Database\Seeder;

class TripScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_schedules')->insert([
            'trip_id' => 1,
            'trip_category_id' =>2,
            'start_date' => now(),
            'end_date' => now()->addDay(2),
            'only_day' =>0,
            'published' =>1,
            'vacancies_quantity' =>50,
            'vacancies_filled' =>0,
            'price' =>350,
        ]);
    }
}
