<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ptype extends Model
{
    protected $fillable = ['name','status'];
    
    public function product() {
        return $this->hasMany(Product::class);
    }
}
