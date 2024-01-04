<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sub_categories';

    public function category()
    {
        # code...
        return $this->belongsTo(Category::class, 'category_id');
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
        return $this->belongsToMany(Product::class, 'item_categories', 'item_id', 'sub_category_id');
    }
}
