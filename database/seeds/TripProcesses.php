<?php

use Illuminate\Database\Seeder;

class TripProcesses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_processes')->insert([
            'code' => md5(time()),
            'customer_id' => 1,
            'trip_schedule_id' => 1,
            'status' => 1,
            'trip_metadata' => '',
        ]);
    }
}
