<?php

use Illuminate\Database\Seeder;

class TripAdditionalPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_additional_packages')->insert([
            [
                'trip_schedule_id' => 1,
                'name' => 'Passeio de Lancha',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'amount' => 95
            ],
            [
                'trip_schedule_id' => 1,
                'name' => 'Passeio de jetski',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'amount' => 80
            ],
            [
                'trip_schedule_id' => 1,
                'name' => 'Tiroleza',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'amount' => 40
            ],
        ]);
    }
}
