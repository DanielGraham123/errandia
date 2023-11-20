<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'category_id', 'user_id', 'slug', 
        'image_path', 'status', 'is_branch', 'parent_slug'
    ];

    public function user(){
        
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function parent(){
        return $this->belongsTo(Shop::class, 'parent_slug', 'slug');
    }

    public function branches(){
        return $this->hasMany(Shop::class, 'parent_slug', 'slug');
    }

    public function contactInfo(){
        return $this->hasOne(ShopContactInfo::class, 'shop_id');
    }

    public function location(){
        return $this->contactInfo->location() ?? null;
    }

    public function products(){
        return $this->hasMany(Product::class, 'shop_id');
    }

    public function managers(){
        return $this->belongsToMany(User::class, 'shop_managers', 'shop_id', 'user_id');
    }

    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'shop_categories', 'shop_id', 'sub_category_id');
    }

    public function getImage()
    {
        return $this->image_path ? asset('storage/'. $this->image_path) : '';
    }

    public function info()
    {
        return $this->hasOne(ShopContactInfo::class, 'shop_id');
    }

    public function registration()
    {
        return $this->hasOne(ShopRegistrationInfo::class, 'shop_id');
    }
}
