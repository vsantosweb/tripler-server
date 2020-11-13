<?php

namespace App\Http\Controllers\Api\v1\BackOffice\Trip;

use Illuminate\Http\Request;

class TripCartController extends TripController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->tripCart->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            return $this->tripCart->firstOrCreate([
                'code' => sha1(microtime()),
                'session_id' => sha1(date('Y').uniqid()),
                'cart_data' => str_replace(array("\r", "\n", " "), "", $request->all())
            ])->session_id;

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($session_id)
    {
        try {

             $tripCart = $this->tripCart->where('session_id', $session_id)->firstOrFail();
             return  $tripCart;

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $session_id)
    {
        try {

            $tripCart = $this->tripCart->where('session_id', $session_id)->firstOrFail();

            $tripCart->update([
                'cart_data' => str_replace(array("\r", "\n", " "), "", $request->all())
            ]);

            return $tripCart;

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        try {

            $tripCart = $this->tripCart->where('code', $code)->delete();

            return $tripCart;

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function calculate($code)
    {
        $tripCart = $this->tripCart->where('code', $code)->firstOrfail();

        return $tripCart->getTotalCart();
    }
}
