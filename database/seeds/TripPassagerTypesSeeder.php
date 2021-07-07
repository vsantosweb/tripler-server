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

        DB::table('trip_schedules_passager_types')->insert([
            [
                'trip_schedule_id' => 1,
                'trip_passager_type_id' => 1,
                'amount' => 15,
            ],
            [
                'trip_schedule_id' => 1,
                'trip_passager_type_id' => 2,
                'amount' => 5
            ]
        ]);
    }
}
