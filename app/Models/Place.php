<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class Place extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['slug', 'name', 'sub_description', 'description', 'location', 'status', 'file_id', 'icon_id', 'file_ids', 'email', 'password', 'slogan_1', 'slogan_2', 'address', 'phone_1', 'phone_2'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function FileId()
    {
        return $this->belongsTo(UploadImage::class, 'file_id');
    }

    public function IconId()
    {
        return $this->belongsTo(UploadImage::class, 'icon_id');
    }
    public function LogoId()
    {
        return $this->belongsTo(UploadImage::class, 'file_id_logo');
    }


    public function Location()
    {
        return $this->belongsTo(Location::class, 'location');
    }

    public function product()
    {
        return $this->hasMany(Product::class);
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
