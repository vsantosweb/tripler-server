<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripScheduleCancellationModel extends Model
{
    protected $fillable = [
        'name',
        'rules',
        'default'
    ];

    protected $casts = ['rules' => 'object'];

    public function tripSchedule()
    {
        return $this->hasMany(TripSchedule::class);
    }
}
