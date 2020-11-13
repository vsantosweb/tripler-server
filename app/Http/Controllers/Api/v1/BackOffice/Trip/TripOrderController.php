<?php

namespace App\Http\Controllers\Api\v1\BackOffice\Trip;

use App\Http\Controllers\Controller;
use App\Mail\OrderPlacedMail;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
        if (!$currentTripSchedule->fillVacancie()) {
            return $this->outputJSON([], 'Limit of vacancies reaching', 'true', 400);
        }

        // $moipCustomer = new MoipCustomer();
        // return  $moipCustomer->create($this->customer->with('address', 'cards')->find($request->customer_id));

        // $customerLocation = \Location::get($request->ip());
        // $amount = $this->tripTax->calculate($request->amount);
        $newOrder = $this->tripOrder->firstOrCreate([

            'code' => strtoupper(date('Y').uniqid()),
            'customer_id' => $request->customer['id'],
            'trip_order_status_id' => 2,
            'boarding_location' =>  str_replace(array("\r", "\n", " "), "",$request->boarding_location),
            'trip_name' => $request->name,
            'trip_package' => str_replace(array("\r", "\n", " "), "", $request->package),
            'passagers' => str_replace(array("\r", "\n", " "), "", $request->passagers),
            'payment_method' => $request->paymentMethod['slug'],
            'total_amount' => $request->totalAmount,
            'tax' => 6,

        ]);

        // $newOrder->customer->email;
        Mail::to('soaresanserson221@gmail.com')->send(new OrderPlacedMail($newOrder));

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
