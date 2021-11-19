<?php

namespace App\Http\Resources\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'code' => $this->code,
            'status' => $this->status->name,
            'type' => $this->tripSchedule->type->name,
            'period' => $this->tripSchedule->period->name,
            'check_in_date' => $this->check_in_date,
            'check_out_date' => $this->check_out_date,
            'booking_date' => $this->booking_date,
            'cancel_date' => $this->cancel_date,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
            'total' => $this->total,
            'amount_paid' => $this->amount_paid,
            'is_refund' => $this->is_refund,
            'refund_paid' => $this->refund_paid,
            'expire_at' => $this->expire_at,
            'created_at' => $this->created_at,
            'accepted_terms' => $this->accepted_terms,
            'passengers' => $this->whenLoaded('items', fn () => $this->items->map(fn ($item) => new BookingItemResource($item))),
        ];
    }
}
