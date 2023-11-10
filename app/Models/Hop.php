<?php

namespace App\Models;


use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Hop extends Model
{
    protected $fillable = ['name', 'status'];

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
