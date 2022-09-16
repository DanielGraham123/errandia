<?php

namespace Modules\ProductCategory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Entities\Product;
use Modules\Shop\Entities\Shop;

class ProductCategory extends Model
{


    protected $fillable = ['name', 'description', 'image_path', 'slug', 'status'];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function shops()
    {
        return $this->hasMany(Shop::class, 'category_id');
    }
}
