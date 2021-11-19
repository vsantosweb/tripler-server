<?php

namespace App\Models\Agency;

use Illuminate\Database\Eloquent\Model;

class AgencyType extends Model
{
    protected $fillable = ['name', 'percent_tax'];

    public function agency()
    {
        return $this->hasMany(Agency::class);
    }
}
