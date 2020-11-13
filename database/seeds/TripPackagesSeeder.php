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
                'agency_id' => 1,
                'name' => 'Casal',
                'description' => 'Quarto privativo com ar condic. para 2 pessoas (cama de casal)',
                'quantity' => 2,
                'amount' => 15,
                'shared' => 0
            ],
            [
                'agency_id' => 1,
                'name' => 'Triplo',
                'description' => 'Quarto privativo com ar condic. para 3 pessoas',
                'quantity' => 3,
                'amount' => 10,
                'shared' => 0
            ],
            [
                'agency_id' => 1,
                'name' => 'Único',
                'description' => 'Vaga em quarto com ar condic. compartilhado para mulheres',
                'quantity' => 3,
                'amount' => 0,
                'shared' => 1
            ],
        ]);
    }
}
