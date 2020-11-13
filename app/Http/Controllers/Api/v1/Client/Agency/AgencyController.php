<?php

namespace App\Http\Controllers\Api\v1\Client\Agency;

use App\Http\Controllers\Api\v1\BackOffice\Agency\AgencyBackOfficeController;
use App\Http\Controllers\Api\v1\BackOffice\Customer\CustomerBackOfficeController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    function __construct(CustomerBackOfficeController $customerBackOffice)
    {
        $this->customerBackOffice = $customerBackOffice;
    }
}
