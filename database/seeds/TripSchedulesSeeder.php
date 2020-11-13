<?php

use Illuminate\Database\Seeder;

class TripSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_schedules')->insert([
            [
                'uid' => md5(microtime()),
                'agency_id' => 1,
                'price' => 320,
                'trip_id' => 1,
                'start_date' => now(),
                'end_date' => now()->addDays(4),
                'vacancies_quantity' => 50,
                'trip_schedule_status_id' => 1,
                'trip_tax_id' => 1,
            ],
            [
                'uid' => md5(microtime()),
                'agency_id' => 1,
                'trip_id' => 2,
                'price' => 220,
                'vacancies_quantity' => 60,
                'start_date' => now(),
                'end_date' => now()->addDays(20),
                'trip_schedule_status_id' => 1,
                'trip_tax_id' => 1,
            ],
        ]);
    }
}
