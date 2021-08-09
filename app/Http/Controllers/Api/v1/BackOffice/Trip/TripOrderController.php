<?php

namespace App\Http\Controllers\Api\v1\BackOffice\Trip;

use App\Models\Trip\TripOrderItem;
use App\Notifications\Order\OrderPlacedNotification;
use Illuminate\Http\Request;

class TripOrderController extends TripController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentTripSchedule =  $this->tripSchedule->where('code', $request->code)->firstOrFail();

        try {

            $currentTripSchedule->fillVacancie($request->passengers);
        } catch (\Exception $e) {

            throw new \Exception($e->getMessage(), 1);
        }

        // $customerLocation = \Location::get($request->ip());
        $amount = $this->tripTax->calculate($request->totalAmount);

        $newOrder = $this->tripOrder->firstOrCreate([

            'code' => strtoupper(date('Y') . uniqid()),
            'customer_id' => $request->customer['id'],
            'trip_order_status_id' => 2,
            'boarding_location' =>  str_replace(array("\r", "\n", " "), "", $request->boarding_location),
            'trip_name' => $request->name,
            'trip_package' => str_replace(array("\r", "\n", " "), "", $request->package),
            'passengers' => str_replace(array("\r", "\n", " "), "", $request->passengers),
            'payment_method' => $request->paymentMethod['slug'],
            'total_amount' => $request->totalAmount,
            'expire_at' => now()->addDays(3),
            'user_agent' => $request->userAgent(),
            'tax' => $amount['tax'],

        ]);

        TripOrderItem::firstOrCreate([
            'trip_schedule_id' => $currentTripSchedule->id,
            'trip_order_id' => $newOrder->id,
            'price' => $currentTripSchedule->price,
            'total' =>  $currentTripSchedule->price * count($request->passengers),
            'quantity' => count($request->passengers)
        ]);

        $newOrder->customer->notify(new OrderPlacedNotification($newOrder));

        return $newOrder;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function orderCancel()
    {
    }
}
