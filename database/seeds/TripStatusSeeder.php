<?php

use Illuminate\Database\Seeder;

class TripStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_status')->insert([

            [
                'name' => 'Ativo',
                'slug' => 'ativo'
            ],

            [
                'name' => 'Desativado',
                'slug' => 'desativado'
            ],
            [
                'name' => 'Rascunho',
                'slug' => 'rascunho'
            ],
        ]);
    }
}
