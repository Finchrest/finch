<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Ptype;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Attribute extends Model
{
    protected $fillable = ['id', 'name', 'status', 'is_delete', 'created_at', 'updated_at'];

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
