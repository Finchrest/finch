<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class PassportFreeItem extends Model
{
    protected $fillable = ['id', 'title', 'location', 'short_description', 'description', 'category', 'sub_category', 'type', 'file_id', 'badge_file', 'total_price', 'hops', 'malt', 'quantity', 'percentage', 'color', 'orignal_gravity', 'style', 'status', 'sub_title', 'place', 'stock', 'is_product_attr', 'attribute_id', 'option_id', 'is_home', 'is_veg'];
    protected $table = "passport_free_item";

    public function FileId()
    {
        return $this->belongsTo(UploadImage::class, 'file_id');
    }

    public function BadgeFileId()
    {
        return $this->belongsTo(UploadImage::class, 'badge_file');
    }

   
}
