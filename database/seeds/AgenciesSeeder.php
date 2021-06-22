<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

            'name' => 'Mario Bross Turismo LTDA',
            'email' => 'mturimos@mturismo.com',
            'password' => Hash::make('password'),
            'phone' => '15454555',
            'uid' => '564564878000158',
            'state_id'=> 1,
            'home_dir' => 'agencies/'. md5(microtime())
        ]);
    }
}
