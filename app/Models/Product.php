<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Ptype;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $fillable = ['id', 'title', 'location', 'short_description', 'description', 'category', 'sub_category', 'type', 'file_id', 'badge_file', 'total_price', 'hops', 'malt', 'quantity', 'percentage', 'color', 'orignal_gravity', 'style', 'status', 'sub_title', 'place', 'stock', 'is_product_attr', 'attribute_id', 'option_id', 'is_home', 'is_veg', 'for_passport'];

    public function FileId()
    {
        return $this->belongsTo(UploadImage::class, 'file_id');
    }

    public function BadgeFileId()
    {
        return $this->belongsTo(UploadImage::class, 'badge_file');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category');
    }

    public function SubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category');
    }

    public function Type()
    {
        return $this->belongsTo(Ptype::class, 'type');
    }

    public function Place()
    {
        return $this->belongsTo(Place::class, 'place');
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
