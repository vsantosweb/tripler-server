<?php

namespace App\Http\Controllers\Api\v1\Client\Site;

use App\Http\Controllers\Api\v1\BackOffice\Trip\TripController;
use Illuminate\Http\Request;

class SiteTripController extends TripController
{
    public function schedule()
    {
        return $this->outputJSON($this->tripSchedule->get(), '', false, 200);
    }

    public function showSchedule($code)
    {
        return $this->outputJSON($this->tripSchedule->where('code', $code)->firstOrFail(), '', false, 200);
    }

    public function passagerTypes()
    {
        return $this->outputJSON($this->tripPassagerType->all(), '', false, 200);
    }

    public function additionalPackages($code)
    {
        return $this->outputJSON($this->tripSchedule->where('code', $code)->first()->additionalPackages, '', false, 200);
    }
}
