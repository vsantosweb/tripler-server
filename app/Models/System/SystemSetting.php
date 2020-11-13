<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = ['order_time_expiration'];

    public function get($setting)
    {
        $setting = $setting;
        return $this->$setting;
    }
}
