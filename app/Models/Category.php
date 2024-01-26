<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'categories';
    protected $fillable = ['name', 'description', 'image_path', 'slug', 'status', 'category_id'];

    public function sub_categories(){
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function getIcon()
    {
        return $this->image_path ? asset('assets/admin/icons/'. $this->image_path. '.svg') : '';
    }

    public function sliders()
    {
        # code...
        return $this->hasMany(Slider::class, 'category_id');
    }

    public function shops()
    {
        # code...
        return $this->belongsToMany(Shop::class, 'shop_categories', 'shop_id', 'sub_category_id');
    }

    public function items()
    {
        # code...
        return $this->belongsToMany(Shop::class, 'item_categories', 'item_id', 'sub_category_id');
    }
}
