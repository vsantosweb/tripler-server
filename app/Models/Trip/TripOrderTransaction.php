<?php

namespace App\Models\Trip;

use App\Mail\orderApprovedMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class TripOrderTransaction extends Model
{
    protected $fillable = [
        'code',
        'status',
        'trip_order_id',
        'ip',
        'geo_location',
        'user_agent',
        'metadata',
    ];

    protected $casts = ['metadata' => 'Object'];

    public function order()
    {
        return $this->belongsTo(TripOrder::class, 'trip_order_id');
    }

    public function checkPaid()
    {
        $paidTransactions = $this->where('status', 'paid')->get();
        $tripProcess = new TripProcess();

        foreach ($paidTransactions as $transaction) {
            if ($transaction->order->status->id === 2) {

                $tripProcess->firstOrCreate([
                    'code' => strtoupper(uniqid() . uniqid()),
                    'customer_id' => $transaction->order->customer->id,
                    'trip_schedule_id' => $transaction->order->tripOrderItem->trip_schedule_id,
                    'status' => 1,
                    'trip_metadata' => $transaction->order,
                    'start_date'=>  $transaction->order->tripOrderItem->tripSchedule->start_date,
                    'end_date'=>  $transaction->order->tripOrderItem->tripSchedule->end_date,
                ]);

                Mail::to($transaction->order->customer->email)->send(new orderApprovedMail($transaction->order));
                $transaction->order->trip_order_status_id = 1;
                $transaction->order->save();
            }
        }
    }
}
