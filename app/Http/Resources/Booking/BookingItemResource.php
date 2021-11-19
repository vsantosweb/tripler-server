<?php

namespace App\Http\Resources\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'passenger_type' => $this->passengerType->passenger->name,
            'boarding' => $this->boarding->location->name,
            'name' => $this->name,
            'email' => $this->email,
            'document' => $this->document,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'price_fee' => $this->price_fee,
            'total_amount' => $this->total_amount,
        ];
    }
}
