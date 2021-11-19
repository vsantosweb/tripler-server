<?php

use Illuminate\Database\Seeder;

class AgencyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agency_types')->insert(
            [
                [
                    'name' => 'Basic',
                    'percent_tax' => 0
                ],
                [
                    'name' => 'Standard',
                    'percent_tax' => 10
                ],
                [
                    'name' => 'Premium',
                    'percent_tax' => 12
                ]
            ]
        );
    }
}
