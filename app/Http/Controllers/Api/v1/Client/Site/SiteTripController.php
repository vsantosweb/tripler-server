<?php

namespace App\Http\Controllers\Api\v1\Client\Site;

use App\Http\Controllers\Api\v1\BackOffice\Trip\TripController;
use App\Models\Trip\TripSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiteTripController extends TripController
{
    public function schedules()
    {
        return $this->outputJSON($this->tripSchedule->get(), '', false, 200);
    }

    public function showSchedule($uuid)
    {
        return $this->outputJSON($this->tripSchedule->where('uuid', $uuid)->firstOrFail(), '', false, 200);
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
