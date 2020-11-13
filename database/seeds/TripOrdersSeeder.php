<?php

use Illuminate\Database\Seeder;

class TripOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_orders')->insert([
            'code' => md5(time()),
            'customer_id' => 1,
            'trip_schedule_id' => 1,
            'trip_package_id' => 1,
            'amount' => 450.00,
            'tax' => 25.00,
            'payment_method' => 'credit card',
            'boarding_location' => 'Term. Barra Funda',
            'trip_order_Status_id' => 2,
            'customer_id' => 1,
            'expire_at' => now()->addDays(4)
        ]);

        DB::table('trip_order_transactions')->insert([
            'code' => md5(time()),
            'trip_order_id'=> 1,
            'ip' => '192.168.0.25',
            'tax' => 15,
            'geo_location' => '45.457 4564.8787',
            'user_agent' => 'Google Chrome',
        ]);
    }
}
