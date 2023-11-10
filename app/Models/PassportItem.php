<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PassportItem extends Model
{
    protected $fillable = ['id', 'user_id', 'passport_code', 'product_id', 'qty', 'price','sub_total','order_id'];
    
	
}
