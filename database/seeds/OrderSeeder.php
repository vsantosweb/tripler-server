<?php

use App\Models\Order\Order;
use App\Models\Order\OrderTicket;
use App\Models\Order\OrderTicketBoarding;
use App\Models\Order\OrderTicketPackage;
use App\Models\Order\OrderTicketPassenger;
use App\Models\Order\OrderTicketPassengerOptional;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Order::class, 5)->create()->each(function ($order) {
            
            factory(OrderTicket::class, 1)->create(['order_id' => $order->id])->each(function ($ticket) {
                $ticket->passengers()->saveMany(factory(OrderTicketPassenger::class, $ticket->quantity)->make());

                $ticket->boarding()->saveMany(factory(OrderTicketBoarding::class, 1)->make());

                $ticket->passengers()->each(function ($passenger) {
                    $passenger->optionals()->saveMany(factory(OrderTicketPassengerOptional::class, mt_rand(1, 3))->make());
                });

                if ($ticket->is_package) {
                    $ticket->package()->saveMany(factory(OrderTicketPackage::class, 1)->make());
                }
            });
        });
    }
}
