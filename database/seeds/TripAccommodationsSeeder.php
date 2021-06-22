<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripAccommodationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_accommodations')->insert([
            'agency_id' => 1 ,
            'name' =>  'Pousada Sunset do sul',
            'description' =>  'Lorem impsum',
            'images' => '["https://storage.googleapis.com/static-content-hc/sites/default/files/cataloina_porto_doble_balcon2_2.jpg","https://www.iberian.property/media/image/2017/12/18/catalonia-a-a.jpg"]' 
        ]);
    }
}
