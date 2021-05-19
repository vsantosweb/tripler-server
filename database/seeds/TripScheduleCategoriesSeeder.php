<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TripScheduleCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_schedule_categories')->insert([

            [
                'code' => Str::uuid(),
                'name' => 'Bate & Volta',
                'slug' => 'bate-volta',
                'color' => '#ff8507'

            ],

            [
                'code' => Str::uuid(),
                'name' => 'Fim de Semana',
                'slug' => 'fim-de-semana',
                'color' => '#5828e8'
            ],
            [
                'code' => Str::uuid(),
                'name' => 'Férias',
                'slug' => 'ferias',
                'color' => '#eee'

            ],

        ]);
    }
}
