<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home_address extends Model
{
    protected $fillable = ['title', 'user_id','city', 'phone','state','pincode','address','status'];
    
}

