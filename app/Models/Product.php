<?php

namespace App\Models;

use GodJay\ScoutElasticsearch\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory, SoftDeletes, Searchable;

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

    public function searchableAs()
    {
        return 'products';
    }

    public function getElasticMapping()
    {
        return [
            'name' => [
                'type' => 'text',
                'analyzer' => 'standard'
            ],
            'description' => [
                'type' => 'text',
                'analyzer' => 'standard'
            ],
            'status' => [
                'type' => 'boolean'
            ]
        ];
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->attributes['name'],
            'description' => $this->attributes['description'],
            'status' => $this->attributes['status']
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
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
        return $this->featured_image ? $this->featured_image : '';
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
}
