<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['id', 'user_id', 'order_id', 'product_id', 'attr_id', 'attr_name', 'option_id', 'option_name', 'qty', 'price','sub_total', 'is_cancelled'];
    
	
}
