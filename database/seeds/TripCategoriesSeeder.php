<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TripCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_categories')->insert([

            [
                'code' => Str::uuid(),
                'name' => 'Lazer e Bem Estar',
                'slug' => 'lazer-bem-estar',
                'color' => '#ff8507'

            ],
            [
                'code' => Str::uuid(),
                'name' => 'Praias',
                'slug' => 'praias',
                'color' => '#5828e8'
            ],
            [
                'code' => Str::uuid(),
                'name' => 'Eco Turismo',
                'slug' => 'ecotur',
                'color' => '#eee'

            ],
            [
                'code' => Str::uuid(),
                'name' => 'Eventos',
                'slug' => 'eventos',
                'color' => '#eee'
            ],
            [
                'code' => Str::uuid(),
                'name' => 'Parques',
                'slug' => 'parques',
                'color' => '#eee'
            ],

        ]);
    }
}
