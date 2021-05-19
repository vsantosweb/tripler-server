<?php

namespace App\Http\Controllers\Api\v1\Client\Customer;

use App\Http\Controllers\Api\v1\BackOffice\Customer\CustomerBackOfficeController;
use App\Http\Controllers\Api\v1\BackOffice\Trip\TripCartController;
use App\Http\Controllers\Api\v1\BackOffice\Trip\TripOrderController;
use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(

        TripOrderController $tripOrder,
        CustomerBackOfficeController $customer,
        TripCartController $tripCart
        
    ) {
        $this->tripOrder = $tripOrder;
        $this->customer = $customer;
        $this->tripCart = $tripCart;
    }
}
