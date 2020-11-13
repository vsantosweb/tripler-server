<?php

use Illuminate\Database\Seeder;

class TripScheduleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_schedule_category')->insert([

            [
                'name' => 'Bate & Volta',
                'slug' => 'bate-volta'
            ],

            [
                'name' => 'Fim de Semana',
                'slug' => 'fim-de-semana'
            ],
            [
                'name' => 'Férias',
                'slug' => 'ferias'
            ],
            
        ]);
    }
}
