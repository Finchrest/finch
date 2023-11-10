<?php

namespace App\Models;


use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name', 'file_id', 'allow_pincode', 'status'];

    public function FileId()
    {
        return $this->belongsTo(UploadImage::class, 'file_id');
    }

    public function place()
    {
        return $this->hasMany(Place::class);
    }

    public function LogoId()
    {
        return $this->belongsTo(UploadImage::class, 'file_id_logo');
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
