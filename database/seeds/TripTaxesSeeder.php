<?php

use Illuminate\Database\Seeder;

class TripTaxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_taxes')->insert([
            'percent_tax' => 10
        ]);
    }
}
