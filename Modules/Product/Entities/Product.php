<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\ProductCategory\Entities\SubCategory;
use Modules\Shop\Entities\Shop;
use Modules\User\Entities\User;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'summary', 'discount', 'sub_category_id', 'currency_id', 'slug', 'status', 'quantity', 'unit_price', 'featured_image_path', 'shop_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getTableName()
    {
        return "products";
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }
}
