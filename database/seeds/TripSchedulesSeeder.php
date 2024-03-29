<?php

use App\Models\Trip\TripSchedule;
use Illuminate\Database\Seeder;

class TripSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TripSchedule::class, 20)->create();
    }
}
