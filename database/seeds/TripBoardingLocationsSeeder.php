<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripBoardingLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_boarding_locations')->insert([
            [
                'agency_id' => 1,
                'name' => 'Term. Grajaú',
                'slug' => 'terminal-grajau',
                'departure_time' => '22:00'
            ],
            [
                'agency_id' => 1,
                'name' => 'Term. Varginha',
                'slug' => 'terminal-varginha',
                'departure_time' => '22:00'
            ],
        ]);

        DB::table('trip_boardings')->insert([
            ['trip_schedule_id' => 1, 'trip_boarding_id' => 1],
            ['trip_schedule_id' => 1, 'trip_boarding_id' => 2],
        ]);
    }
}
