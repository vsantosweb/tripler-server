<?php

use App\Models\Trip\TripOrderItem;
use App\Models\Trip\TripOrderItemPassenger;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TripOrderItemPassengerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        foreach (TripOrderItem::all() as $item) {
            $item->passengers()->saveMany(factory(TripOrderItemPassenger::class, $item->quantity)->make());
        }
     
    }
}
