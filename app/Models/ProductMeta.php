<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    protected $fillable = ['id', 'product_id', 'attribute_id', 'option_id', 'regular_price', 'tax', 'created_at', 'updated_at'];
    
}
