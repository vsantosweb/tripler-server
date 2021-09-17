<?php

namespace App\Http\Controllers\Api\v1\BackOffice\Trip;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\Trip\Trip;
use App\Models\Trip\TripSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TripScheduleController extends TripController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $loggedAgency = Customer::find(auth()->user()->id)->agencyOwner;
        return $this->tripSchedule->find($loggedAgency->id)->paginate(20);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'price' => ['required'],
            'image' => ['nullable'],
            'start_date' => 'required',
            'end_date' => 'required',
            'trip_schedule_period_id' => 'required',
            'vacancies' => 'required',
            'trip_schedule_status_id' => 'nullable',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->outputJSON($validator->errors(), 'true', 400);
        }

        try {
            $agency = Customer::find(auth()->user()->id)->agencyOwner;
            $createdTripSchedule = $this->tripSchedule->firstOrCreate(
                [
                    'agency_id' => $agency->id,
                    'name' => $request->name,
                    'price' => $request->price,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'trip_schedule_period_id' => $request->trip_schedule_period_id,
                    'vacancies' => $request->vacancies,
                    'trip_schedule_status_id' => 1,
                    'description' => $request->description,
                ]);

            $image = str_replace(' ', '+', $request->image);
            $imageBin = base64_decode($image);
            $imageName = md5($request->name . time()) . '.jpeg';

            $imagePath = $agency->home_dir . DIRECTORY_SEPARATOR . 'events' . DIRECTORY_SEPARATOR . $imageName;

            Storage::disk('public')->put($imagePath, $imageBin);

            $imageUrl = Storage::disk('public')->url($imagePath, $imageBin);
            $createdTripSchedule->image = $imagePath;
            $createdTripSchedule->image_url = $imageUrl;
            $createdTripSchedule->save();
            return $this->outputJSON($createdTripSchedule, 'true');

        } catch (\Exception $e) {

            return $this->outputJSON($e->getMessage(), 'false', 500);
        }
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

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'price' => ['required'],
            'image' => ['nullable'],
            'start_date' => 'required',
            'end_date' => 'required',
            'trip_schedule_period_id' => 'required',
            'vacancies' => 'required',
            'trip_schedule_status_id' => 'nullable',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->outputJSON($validator->errors(), 'true', 400);
        }

        try {
            $agency = Customer::find(auth()->user()->id)->agencyOwner;
            $updatedTripSchedule = $this->tripSchedule->updateOrCreate(
                ['id' => $id],
                [
                    'agency_id' => $agency->id,
                    'name' => $request->name,
                    'price' => $request->price,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'trip_schedule_period_id' => $request->trip_schedule_period_id,
                    'vacancies' => $request->vacancies,
                    'trip_schedule_status_id' => 1,
                    'description' => $request->description,
                ]);

            if (isset($request->image)) {

                $image = str_replace(' ', '+', $request->image);
                $imageBin = base64_decode($image);
                $imageName = md5($request->name . time()) . '.jpeg';

                $imagePath = $agency->home_dir . DIRECTORY_SEPARATOR . 'events' . DIRECTORY_SEPARATOR . $imageName;

                Storage::disk('public')->delete($updatedTripSchedule->image);

                Storage::disk('public')->put($imagePath, $imageBin);

                $imageUrl = Storage::disk('public')->url($imagePath, $imageBin);
                $updatedTripSchedule->image = $imagePath . DIRECTORY_SEPARATOR . $imageName;
                $updatedTripSchedule->image_url = $imageUrl;
                $updatedTripSchedule->save();

            }
            return $this->outputJSON($updatedTripSchedule, 'true');

        } catch (\Exception $e) {

            return $this->outputJSON($e->getMessage(), 'false', 500);
        }
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

    protected function trips()
    {
        return $this->trip->with('tripSchedule', 'customer');
    }
}
