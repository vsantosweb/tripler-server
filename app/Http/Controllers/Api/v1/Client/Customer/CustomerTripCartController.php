<?php

namespace App\Http\Controllers\Api\v1\Client\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerTripCartController extends CustomerController
{
    public function list()
    {
        return $this->outputJSON($this->tripCart->index(), '', false, 200);
    }

    public function add(Request $request)
    {
        return $this->outputJSON($this->tripCart->store($request), '', false, 201);
    }

    public function show($code)
    {
        return $this->outputJSON($this->tripCart->show($code), '', false, 200);
    }

    public function change(Request $request, $code)
    {
        return $this->outputJSON($this->tripCart->update($request, $code), '', false, 200);
    }

    public function delete($code)
    {
        return $this->outputJSON($this->tripCart->destroy($code), '', false, 200);

    }

    public function calculate($code)
    {
        return $this->outputJSON($this->tripCart->calculate($code), '', false, 200);
    }
}
