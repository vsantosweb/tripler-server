<?php

use Illuminate\Database\Seeder;

class TripPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_packages')->insert([
            [
                'trip_accommodation_id' => 1,
                'name' => 'Casal',
                'description' => 'Quarto privativo com ar condic. para 2 pessoas (cama de casal)',
                'quantity' => 2,
                'amount' => 150,
                'shared' => 0
            ],
            [
                'trip_accommodation_id' => 1,
                'name' => 'Triplo',
                'description' => 'Quarto privativo com ar condic. para 3 pessoas',
                'quantity' => 3,
                'amount' => 120,
                'shared' => 0
            ],
            [
                'trip_accommodation_id' => 1,
                'name' => 'Único',
                'description' => 'Vaga em quarto com ar condic. compartilhado para mulheres',
                'quantity' => 1,
                'amount' => 110,
                'shared' => 1
            ],
        ]);

        DB::table('trip_schedule_packages')->insert([
            ['trip_schedule_id' => 1, 'trip_package_id' => 1],
            ['trip_schedule_id' => 1, 'trip_package_id' => 2],
            ['trip_schedule_id' => 1, 'trip_package_id' => 3]
        ]);
    }
}
