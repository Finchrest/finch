<?php

namespace App\Models;
use App\Models\Category;
use App\Models\Ptype;
use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    protected $fillable = ['id', 'attr_id', 'is_delete', 'option_name', 'created_at', 'updated_at'];
    
}
