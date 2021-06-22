<?php

namespace App\Models\Agency;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Trip\TripSchedule;

class Agency extends Authenticatable implements JWTSubject
{
    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'password',
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
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function tripSchedules()
    {
        return $this->hasMany(TripSchedule::class)->with('tax');
    }

    public function customer()
    {
        return $this->belongsTo(AgencyAuthenticate::class);
    }
}
