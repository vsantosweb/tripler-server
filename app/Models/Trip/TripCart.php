<?php

namespace App\Models\Trip;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripCart extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['customer_id','trip_schedule_id', 'uuid', 'tickets', 'session', 'boarding', 'package'];

    protected $casts = [
        'tickets' => 'array',
        'boarding' => 'object',
        'package' => 'object',
        'optionals' => 'object'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function tripSchedule()
    {
        return $this->belongsTo(TripSchedule::class)->with('optionalPackages','period','trip');
    }
}
