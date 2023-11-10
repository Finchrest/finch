<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GeneralSetting extends Model
{
    protected $fillable = ['label', 'meta_key', 'meta_value', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->add_by_id = Auth::id();
            $model->add_by = Auth::user()->host_name;
        });
        static::updating(function ($model) {
            $model->updated_by_id = Auth::id();
            $model->updated_by = Auth::user()->host_name;
        });
    }
}
