<?php

use Illuminate\Database\Seeder;

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
                'slug' => 'terminal-grajau'
            ],
            [
                'agency_id' => 1,
                'name' => 'Term. Varginha',
                'slug' => 'terminal-varginha'
            ],
        ]);
    }
}