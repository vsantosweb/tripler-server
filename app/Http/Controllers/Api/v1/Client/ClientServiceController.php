<?php

namespace App\Http\Controllers\Api\v1\Client;

use App\Http\Controllers\Controller;
use App\Models\Trip\TripSchedule;
use Illuminate\Http\Request;

class ClientServiceController extends Controller
{
    public function __construct(
        TripSchedule $tripSchedule
    )
    {
        $this->tripSchedule = $tripSchedule;
    }
}
