<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicNotification extends Model
{
    protected $fillable = ['title', 'msg'];	

    public function Notifications()
    {
        return $this->hasMany(SubPublicNotifiction::class);
    }

}
