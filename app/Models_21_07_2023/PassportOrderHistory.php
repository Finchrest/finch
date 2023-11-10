<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class PassportOrderHistory extends Model
{
    protected $fillable = ['id', 'passport_order_id', 'passport_id', 'name', 'user_id', 'phone', 'email', 'price', 'status', 'payment_id', 'payment_date', 'order_date'];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
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
