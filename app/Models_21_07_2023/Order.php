<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $fillable = ['id', 'place_id', 'location', 'name', 'user_id', 'phone', 'address', 'order_for', 'state', 'city', 'qty', 'sub_total', 'total', 'total_pay', 'status', 'order_status', 'order_date', 'payment_id', 'payment_date', 'passport_code', 'passport_pay', 'type', 'coupon_code', 'coupon_percent', 'coupon_amount', 'pincode'];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
