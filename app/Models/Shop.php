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

    protected $dates = ['created_at', 'updated_at'];

    public function user(){
        
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(){
        return $this->belongsTo(SubCategory::class,'category_id');
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
        if(($cntct = $this->contactInfo) != null){
            return $this->contactInfo->location() ?? null;
        }return '';
    }

    public function items(){
        return $this->hasMany(Product::class, 'shop_id')->inRandomOrder();
    }

    public function products(){
        return $this->hasMany(Product::class, 'shop_id')->where('service', 0);
    }

    public function services(){
        return $this->hasMany(Product::class, 'shop_id')->where('service', 1);
    }

    public function managers(){
        return $this->belongsToMany(User::class, 'shop_managers', 'shop_id', 'user_id');
    }

    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'shop_categories', 'shop_id', 'sub_category_id')??'';
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

    public function reviews()
    {
        # code...
        return $this->hasManyThrough(Review::class, Product::class, 'id', 'item_id');
    }

    public function subscriptions()
    {
        # code...
        return $this->hasMany(ShopSubscription::class);
    }

    public function subscribersR()
    {
        return $this->hasMany(ShopSubscriber::class, 'shop_id');
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class, ShopSubscriber::class, 'shop_id');
    }
}
