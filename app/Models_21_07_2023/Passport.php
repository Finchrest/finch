<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Passport extends Model
{
    protected $fillable = ['slug', 'name', 'sub_description', 'description', 'location', 'status', 'file_id', 'price', 'volume', 'per_day_use'];

    public function FileId()
    {
        return $this->belongsTo(UploadImage::class, 'file_id');
    }

    public function Location()
    {
        return $this->belongsTo(Location::class, 'location');
    }


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
