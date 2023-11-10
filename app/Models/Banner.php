<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['name', 'file_id', 'status'];

    public function FileId()
    {
        return $this->belongsTo(UploadImage::class, 'file_id');
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
