<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripOrderHistory extends Model
{
    protected $fillable =[
        'code',
        'customer_uid',
        'trip_schedule_uid',
        'trip_order_status',
        'customer_name',
        'customer_cpf',
        'customer_email',
        'customer_phone',
        'agency_name',
        'agency_uid',
        'agency_email',
    ];
}
