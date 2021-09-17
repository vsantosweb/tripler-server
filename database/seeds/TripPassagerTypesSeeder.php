<?php

use Illuminate\Database\Seeder;

class TripPassengerTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_passenger_types')->insert([
            [
                'name' => 'Adulto',
                'slug' => 'adulto',
                'description' => 'A partir de 18 anos'
            ],
            [
                'name' => 'Menor',
                'slug' => 'menor',
                'description' => 'Até 17 anos'
            ]
        ]);

        DB::table('trip_schedule_passenger_types')->insert([
            [
                'trip_schedule_id' => 1,
                'trip_passenger_type_id' => 1,
                'amount' => 15,
                'quantity' => 4,
            ],
            [
                'trip_schedule_id' => 1,
                'trip_passenger_type_id' => 2,
                'amount' => 5,
                'quantity' => 8,
            ],
            [
                'trip_schedule_id' => 2,
                'trip_passenger_type_id' => 1,
                'amount' => 15,
                'quantity' => 5,
            ],
            [
                'trip_schedule_id' => 2,
                'trip_passenger_type_id' => 2,
                'amount' => 5,
                'quantity' => 10,
            ]
        ]);
    }
}
