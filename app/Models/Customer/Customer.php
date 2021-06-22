<?php

namespace App\Models\Customer;

use App\Models\Agency\Agency;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

use App\Models\Trip\Trip;
use App\Models\Region\Address;
use App\Models\Trip\TripCart;
use Illuminate\Support\Str;

class Customer extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'rg',
        'cpf',
        'birthday',
        'gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
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

    public function cards()
    {
        return $this->hasMany(CustomerCards::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class)->with('tripSchedule');
    }

    public function address()
    {
        return $this->hasOne(Address::class)->with('state');
    }

    public function agencyOwner()
    {
        return $this->hasOne(Agency::class);
    }

    public function cart()
    {
        return $this->hasMany(TripCart::class);
    }
}
