<?php

namespace App\Models;
use App\Models\Offer;
use App\Models\Place;
use App\Models\Location;
use App\Models\Passport;
use Illuminate\Database\Eloquent\Model;


class UploadImage extends Model
{
    protected $fillable = ['file'];

    public function offer() {
        return $this->hasMany(Offer::class);
    }

    public function location() {
        return $this->hasMany(Location::class);
    }

    public function place() {
        return $this->hasMany(Place::class);
    }


    public function passport() {
        return $this->hasMany(Passport::class);
    }
  
}

