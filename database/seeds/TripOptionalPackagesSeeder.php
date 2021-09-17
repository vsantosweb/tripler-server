<?php

use Illuminate\Database\Seeder;

class TripOptionalPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_optional_packages')->insert([
            [
                'agency_id' => 1,
                'name' => 'Passeio de Lancha',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            ],
            [
                'agency_id' => 1,
                'name' => 'Passeio de jetski',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            ],
            [
                'agency_id' => 1,
                'name' => 'Tiroleza',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            ],
        ]);
    }
}
