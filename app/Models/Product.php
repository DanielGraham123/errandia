<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "items";

    protected $fillable = ['name', 'shop_id', 'description', 'unit_price', 'quantity', 'status', 'slug', 'featured_image'];

    public function categories()
    {
        return $this->belongsToMany(SubCategory::class, 'item_categories', 'item_id', 'category_id');
    }

    public function images()
    {
        return $this->hasMany('item_images');
    }

    public function quotes()
    {
        return $this->hasMany(Errand::class, 'item_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'item_id');
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class, 'item_id');
    }
}
