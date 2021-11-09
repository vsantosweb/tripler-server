<?php

use App\Models\Order\OrderTicket;
use App\Models\Order\OrderTicketPassenger;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrderTicketPassengerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        // foreach (OrderTicket::all() as $item) {
        //     $item->passengers()->saveMany(factory(OrderTicketPassenger::class, $item->quantity)->make());
        // }
     
    }
}
