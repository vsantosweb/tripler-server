<?php

use App\Models\Order\OrderTicket;
use Illuminate\Database\Seeder;

class OrderTicketBoardingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (OrderTicket::all() as $item) {
            $item->passengers()->saveMany(factory(OrderTicketPassengerOptional::class, 1)->make());
        }
    }
}
