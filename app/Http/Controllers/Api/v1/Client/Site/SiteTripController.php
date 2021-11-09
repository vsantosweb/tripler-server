<?php

namespace App\Http\Controllers\Api\v1\Client\Site;

use App\Http\Controllers\Api\v1\BackOffice\Trip\TripController;
use App\Http\Resources\TripResource;
use App\Http\Resources\TripScheduleResource;
use App\Models\Order\Order;
use App\Models\Trip\Trip;
use App\Models\Trip\TripCategory;
use App\Models\Trip\TripSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiteTripController extends TripController
{
    public function schedules()
    {
        return $this->outputJSON($this->tripSchedule->get(), '', false, 200);
    }

    public function tripsByCategory()
    {
        $query = TripCategory::all()->map(fn ($category) => [
            'id' => $category->id,
            'name' => $category->name,
            'slug' =>  $category->slug,
            'trips' => $category->trips->map(fn ($trip) => new TripResource($trip)),
        ]);

        return $this->outputJSON($query, '', false, 200);
    }
    public function show($uuid)
    {
        $trip = Trip::with(['schedules' => fn ($query) => $query->where('trip_schedule_status_id', 1)])->where('uuid', $uuid)->firstOrFail();

        return $this->outputJSON(new TripResource($trip), '', false, 200);
    }

    public function showSchedule($uuid)
    {

        return $this->outputJSON(new TripScheduleResource(TripSchedule::where('uuid', $uuid)->firstOrFail()), '', false, 200);

        // return $this->outputJSON(new TripScheduleResource(TripSchedule::where('uuid', $uuid)->firstOrFail()), '', false, 200);
    }

    public function passengerTypes()
    {
        return $this->outputJSON($this->tripPassengerType->all(), '', false, 200);
    }

    public function additionalPackages($code)
    {
        return $this->outputJSON($this->tripSchedule->where('code', $code)->first()->additionalPackages, '', false, 200);
    }

    public function tripCategeories()
    {
        return $this->outputJSON($this->tripCategory::with('trips')->get(), '', false, 200);
    }

    public function scheduleCategories()
    {
        return $this->outputJSON($this->tripSchedulePeriod->with('tripSchedules')->get(), '', false);
    }

    public function schedulesByCategory($categoryCode)
    {
        $category = $this->tripCategory->where('code', $categoryCode)->with('tripSchedules')->firstOrFail();
        return $this->outputJSON($category, '', false, 200);
    }
}
