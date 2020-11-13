<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripOrderTransictionHistory extends Model
{
    protected $fillable = [
        'code',
        'amount',
        'tax',
        'ip',
        'geo_location',
        'user_agent',
        'customer_name',
        'customer_cpf',
        'agency_name',
        'agency_uid',
    ];
    protected $table = 'trip_order_transaction_history';

    public function createHistory($tripOrderTranscation){
        try {

            $this->firstOrCreate([
                'code' => 'TRANS-'.rand(),
                'amount' => $tripOrderTranscation->order->amount,
                'tax' => $tripOrderTranscation->tax,
                'ip' => $tripOrderTranscation->ip,
                'geo_location' => $tripOrderTranscation->geo_location ,
                'user_agent' => $tripOrderTranscation->user_agent,
                'customer_name' => $tripOrderTranscation->order->customer->name,
                'customer_cpf' => $tripOrderTranscation->order->customer->cpf,
                'agency_name' => $tripOrderTranscation->order->tripSchedule->trip->agency->company_name,
                'agency_uid' =>  $tripOrderTranscation->order->tripSchedule->trip->agency->uid
            ]);
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
