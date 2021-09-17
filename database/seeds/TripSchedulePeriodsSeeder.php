<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TripSchedulePeriodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_schedule_periods')->insert([

            [
                'uuid' => Str::uuid(),
                'name' => 'Bate & Volta',
                'slug' => 'bate-volta',
            ],

            [
                'uuid' => Str::uuid(),
                'name' => 'Fim de Semana',
                'slug' => 'fim-de-semana',
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Férias',
                'slug' => 'ferias',
            ],

        ]);
    }
}
