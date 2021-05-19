<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripAcommodationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_acommodations')->insert([
            'agency_id' => 1 ,
            'name' =>  'Pousada Sunset do sul',
            'description' =>  'Lorem impsum',
            'images' => '["image1.png","image2.png"]' 
        ]);
    }
}
