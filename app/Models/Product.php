<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;


class Product extends Model
{
    use HasFactory, SoftDeletes;

    const SORT_HIGH_PRICE = 1;
    const SORT_LOW_PRICE = 2;

    protected $table = 'items';

    protected $fillable = [
        'name',
        'shop_id',
        'unit_price',
        'description',
        'slug',
        'status',
        'featured_image',
        'quantity',
        'views',
        'service',
        'search_index',
        'tags',
        'category_id',
        'images',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function otherItems($service = null)
    {
        $query = $this->user->items()->where('slug', '!=', $this->slug);

        if ($service !== null) {
            $query->where('service', $service);
        }

        return $query->paginate(5);
    }

    public function category()
    {
        return $this->belongsTo(SubCategory::class, 'category_id');
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
        return $this->featured_image && File::exists(public_path($this->featured_image)) ? $this->featured_image : "";
    }

    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'item_categories', 'item_id', 'sub_category_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'item_id');
    }

    public function items()
    {
        return $this->hasMany(Product::class, 'item_id');
    }

    public function errand_items()
    {
        return $this->hasMany(ErrandItem::class, 'item_id');
    }
}
