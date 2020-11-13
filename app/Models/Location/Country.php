<?php

namespace App\Models\Region;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'iso_code_2',
        'iso_code_3',
    ];

    public function state()
    {
        return $this->hasMany(State::class);
    }
}
