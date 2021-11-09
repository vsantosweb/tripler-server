<?php

namespace App\Http\Controllers\Api\v1\Client\Customer;

use App\Http\Controllers\Controller;
use App\Models\Trip\TripCart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerTripCartController extends CustomerController
{
    public function list()
    {
        return $this->outputJSON($this->tripCart->index(), '', false, 200);
    }

    public function add(Request $request)
    {
        $cart = auth()->user()->cart()->updateOrCreate(
            ['session' => md5(auth()->user()->email . auth()->user()->id)],
            [
                'trip_schedule_id' => $request->trip_schedule_id,
                'tickets' => $request->tickets,
                'boarding' => $request->boarding
            ]
        );

        return $this->outputJSON($cart->session, '', false, 201);
    }

    public function show($session)
    {
        return $this->outputJSON(auth()->user()->cart()->where('session', $session)->firstOrFail(), '', false, 200);
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
