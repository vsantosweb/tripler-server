<?php

use Illuminate\Database\Seeder;

class AgenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agencies')->insert([

            'customer_id' => 2,
            'company_name' => 'Mario Bross Turismo LTDA',
            'company_email' => 'mturimos@mturismo.com',
            'phone' => '15454555',
            'uid' => '564564878000158',
            'state_id'=> 1,
            'home_dir' => 'agencies/'. md5(microtime())
        ]);
    }
}
