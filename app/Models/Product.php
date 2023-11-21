<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    const SORT_HIGH_PRICE = 1;
    const SORT_LOW_PRICE = 2;

    protected $table = 'items';

    protected $fillable = ['name', 'shop_id', 'unit_price', 'description', 'slug', 'status', 'featured_image', 'quantity', 'views', 'service', 'search_index'];

    public function category()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'item_id');
    }

    public function getFeaturedImage()
    {
        return $this->featured_image ? asset('storage/'. $this->featured_image) : '';
    }

    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'item_categories', 'item_id', 'sub_category_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'item_id');
    }
}
