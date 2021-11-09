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
        DB::table('trip_taxes')->insert(
            [
                'name' => 'Free',
                'percent_tax' => 0
            ],
            [
                'name' => 'Standard',
                'percent_tax' => 8
            ],
            [
                'name' => 'Premium',
                'percent_tax' => 10
            ]
        );
    }
}
