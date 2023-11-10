<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubPublicNotification extends Model
{
    protected $fillable = ['public_notifictions_id', 'user_id', 'is_read', 'is_send'];	
}
