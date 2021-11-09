<?php

use App\Models\Trip\TripOrderItem;
use Illuminate\Database\Seeder;

class TripOrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TripOrderItem::class, 3)->create()->each(function ($order) {
            $orderItem = factory(App\Models\Trip\TripOrderItemPassenger::class, 1)->make();
            $order->tripOrderItem()->saveMany($orderItem);
        });
    }
}
