<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PassportUsedOrder extends Model
{
    protected $fillable = ['passport_code', 'user_id', 'amount', 'order_date', 'order_type', 'order_id','created_at','updated_at'];
    
	public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
