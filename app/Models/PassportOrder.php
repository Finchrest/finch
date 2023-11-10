<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PassportOrder extends Model
{
    protected $fillable = ['id', 'passport_id', 'name', 'user_id', 'phone', 'email', 'price', 'status', 'payment_id', 'payment_date', 'order_date'];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
