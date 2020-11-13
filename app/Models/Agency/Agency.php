<?php

namespace App\Models\Agency;

use Illuminate\Database\Eloquent\Model;

use App\Models\Trip\TripSchedule;

class Agency extends Model
{
    protected $fillable = [
        'customer_id',
        'company_name',
        'company_email',
        'phone',
        'uid',
        'logo',
        'home_dir',
        'address_1',
        'address_2',
        'city',
        'postcode',
        'state_id',
        'status',
    ];

    public function tripSchedules()
    {
        return $this->hasMany(TripSchedule::class)->with('tax');
    }
    public function customer(){
        return $this->belongsTo(AgencyAuthenticate::class);
    }
}
