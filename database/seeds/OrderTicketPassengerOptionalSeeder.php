<?php

use App\Models\Order\OrderTicketPassenger;
use App\Models\Order\OrderTicketPassengerOptional;
use Illuminate\Database\Seeder;

class OrderTicketPassengerOptionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (OrderTicketPassenger::all() as $item) {
            // $item->passengers()->saveMany(factory(OrderTicketPassengerOptional::class, 1)->make());
        }
    }
}
