<?php

use App\Models\Trip\TripOrder;
use App\Models\Trip\TripOrderItem;
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

        factory(TripOrder::class, 3)->create()->each(function($order){
            $orderItem = factory(App\Models\Trip\TripOrderItem::class,1)->make();
            $order->tripOrderItem()->saveMany($orderItem);
        });
    }
}
