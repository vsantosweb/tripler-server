<?php

use App\Models\Trip\TripScheduleCancellationModel;
use Illuminate\Database\Seeder;

class TripScheduleCancellationModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
  
        TripScheduleCancellationModel::create([
            'name' => 'Padrão (Deliberação Normativa)',
            'default' => true,
            'rules'=> json_decode(str_replace(array("\r", "\n", " "), "",'
             [
                {
                  "refund_percent": 90,
                  "range_days_before_start": [31]
                },
                {
                  "refund_percent": 80,
                  "range_days_before_start": [21, 30]
                },
                {
                  "refund_percent": 0,
                  "range_days_before_start": [20]
                }
              ]
            
            '))
        ]); 
    }
}
