<?php

use Illuminate\Database\Seeder;

class TripScheduleStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_schedule_status')->insert([

            [
                'name' => 'Vagas Disponíveis',
                'slug' => 'vagas-disponiveis'
            ],

            [
                'name' => 'Poucas Vagas',
                'slug' => 'poucas-vagas'
            ],
            [
                'name' => 'Esgotado',
                'slug' => 'esgotado'
            ],
            
        ]);
    }
}
