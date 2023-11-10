<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passport_orders extends Model
{
    protected $fillable = ['id', 'name', 'phone', 'email', 'price', 'is_approw'];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
