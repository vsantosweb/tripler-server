<?php

namespace App\Http\Controllers\Api\v1\Client\Customer\Auth;

use App\Http\Controllers\Api\v1\Client\Customer\CustomerController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerRegisterController extends CustomerController
{


    function register(Request $request){
        return $this->customer->store($request);
    }
}
