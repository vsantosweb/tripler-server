<?php

use Illuminate\Database\Seeder;

class TripPassagerTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_passager_types')->insert([
            [
                'trip_schedule_id' => 1,
                'name' => 'Criança (5 a 10 anos)',
                'amount' => 15,
            ],
            [
                'trip_schedule_id' => 1,
                'name' => 'Adulto (a partir de 11 anos)',
                'amount' => 30,
            ]
        ]);
    }
}
