<?php

namespace App\Http\Controllers\Api\v1\Client\Agency\Auth;

use App\Http\Controllers\Api\v1\Client\Agency\AgencyController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgencyRegisterController extends AgencyController
{
    function register(Request $request){
        $request->request->add(["is_agency" => 1]);
        return $this->customerBackOffice->store($request);
    }
}
