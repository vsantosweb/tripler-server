<?php

namespace App\Models\Trip;

use App\Mail\orderApprovedMail;
use App\Notifications\Order\OrderApprovedNotification;
use App\Notifications\Order\OrderPlacedNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class TripOrderTransaction extends Model
{

    use Notifiable;

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
                    'code' => Str::uuid(),
                    'customer_id' => $transaction->order->customer->id,
                    'trip_schedule_id' => $transaction->order->tripOrderItem->trip_schedule_id,
                    'status' => 1,
                    'trip_metadata' => $transaction->order,
                    'start_date' =>  $transaction->order->tripOrderItem->tripSchedule->start_date,
                    'end_date' =>  $transaction->order->tripOrderItem->tripSchedule->end_date,
                ]);

                $transaction->order->trip_order_status_id = 1;
                $transaction->order->save();
                $transaction->order->customer->notify(new OrderApprovedNotification($transaction->order));
                print('ORDER-' . $transaction->order->code . ' Approved' . "\n");
            }
        }
    }
}
