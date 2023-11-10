<?php

namespace App\Models;

use App\Models\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['name', 'category_id', 'status'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->add_by_id = Auth::id();
            $model->add_by = Auth::user()->host_name;
        });

        static::updating(function ($model) {
            $model->updated_by_id = Auth::id();
            $model->updated_by = Auth::user()->host_name;
        });
    }
}
