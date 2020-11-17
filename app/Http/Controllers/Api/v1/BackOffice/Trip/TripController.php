<?php

namespace App\Http\Controllers\Api\v1\BackOffice\Trip;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\Trip\Trip;
use App\Models\Trip\TripBoardingLocation;
use App\Models\Trip\TripCart;
use App\Models\Trip\TripCategory;
use App\Models\Trip\TripOrder;
use App\Models\Trip\TripOrderHistory;
use App\Models\Trip\TripOrderTransaction;
use App\Models\Trip\TripOrderTransictionHistory;
use App\Models\Trip\TripPassagerType;
use App\Models\Trip\TripSchedule;
use App\Models\Trip\TripSeoUrl;
use App\Models\Trip\TripStatus;
use App\Models\Trip\TripTax;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class TripController extends Controller
{
    public function __construct(

        TripOrder $tripOrder,
        TripOrderTransaction $tripOrderTransaction,
        TripCategory $tripCategory,
        TripSchedule $tripSchedule,
        TripStatus $tripStatus,
        TripTax $tripTax,
        Trip $trip,
        TripOrderHistory $tripOrderHistory,
        TripOrderTransictionHistory $tripOrderTransictionHistory,
        TripSeoUrl $tripSeoUrl,
        TripPassagerType $tripPassagerType,
        TripCart $tripCart,
        Customer $customer,
        TripBoardingLocation $tripBoardingLocation
    ) {
        $this->tripOrder = $tripOrder;
        $this->tripCategory = $tripCategory;
        $this->tripSchedule = $tripSchedule->with('trip', 'category', 'passagerTypes', 'packages', 'boardingLocations', 'additionalPackages');
        $this->tripStatus = $tripStatus;
        $this->tripTax = $tripTax;
        $this->trip = $trip;
        $this->tripOrderTransaction = $tripOrderTransaction;
        $this->$tripOrderHistory = $tripOrderHistory;
        $this->tripOrderTransictionHistory = $tripOrderTransictionHistory;
        $this->tripSeoUrl = $tripSeoUrl;
        $this->customer = $customer;
        $this->tripPassagerType = $tripPassagerType;
        $this->tripCart = $tripCart;
        $this->tripBoardingLocation = $tripBoardingLocation;
    }
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

        // $validator = Validator::make($request->all(), [

        //     'name' => ['required'],
        //     'price' => ['required'],
        //     'image' => ['nullable'],
        //     'start_date' => 'required',
        //     'end_date' => 'required',
        //     'trip_schedule_category_id' => 'required',
        //     'vacancies' => 'required',
        //     'trip_schedule_status_id' => 'nullable',
        //     'description' => 'required',
        // ]);


        // if ($validator->fails()) {
        //     return $this->outputJSON([], $validator->errors(), 'true', 400);
        // }

        $newTrip = $this->trip->firstOrCreate([

            'name' => $request->name,
            'code' => Str::uuid(),
            'agency_id' => auth()->guard('agency')->user()->load('agency')->agency->id,
            'trip_category_id' => $request->trip_category_id,
            'trip_status_id' => 1,
            'trip_tax_id' => 1,
            'image_url' => 'sss',
            'price' => $request->price,
            'start_date' => $request->start_date,
            'end_date' => $request->start_end,
            'vacancies_quantity' => $request->vacancies_quantity,
            'description' => $request->description,

        ]);

        $this->tripSeoUrl->firstOrCreate([
            'trip_id' => $newTrip->id,
            'keyword' => Str::slug($newTrip->name)
        ]);

        $newTrip->home_dir =  auth()->user()->home_dir . DIRECTORY_SEPARATOR .
            auth()->guard('agency')->user()->load('agency')->agency->home_dir . DIRECTORY_SEPARATOR . 'trips/' . $newTrip->code;

        // $image = new ImageHelper();

        // $newTrip->image_url = $image->decodeBase64($request->image_base64)->store($newTrip->home_dir);

        return $newTrip;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'ok';
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
}
