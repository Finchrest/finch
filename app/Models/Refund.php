<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable = ['id','order_id','payment_id', 'total_amount', 'refund_amount', 'product_id', 'status', 'comment', 'user_id', 'updated_by', 'created_at', 'updated_at'];
    
	public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
