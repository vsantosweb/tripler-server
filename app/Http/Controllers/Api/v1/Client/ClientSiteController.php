<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Api\v1\BackOffice\Trip\TripCategoryController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientSiteController extends ClientServiceController
{
    public function __construct(TripCategoryController $tripCategory) {

        $this->tripCategory = $tripCategory;

    }
    public function tripScheduleList()
    {
        return $this->tripCategory->getCategories();
        return $this->outputJSON($this->tripSchedule->with('trips')->get(), 'true', 200);
    }
}
