<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

class Shop extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'category_id', 'user_id', 'slug',
        'status', 'is_branch', 'parent_slug', 'region_id', 'town_id',  'slogan', 'image_path', 'street', 'phone_verified'
    ];

    protected $dates = ['created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($shop) {
            $shop->contactInfo()->delete();
            $shop->subscriptions()->delete();
            $shop->products()->delete();
            $shop->services()->delete();
            $shop->reviews()->delete();
            $shop->categories()->detach();
        });
    }

    public function user(){
        
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

// get the parent based on the parent_id
    public function parent(){
        return $this->belongsTo(Shop::class, 'parent_id');
    }

    public function branches(){
        return $this->hasMany(Shop::class, 'parent_id' );
    }

    // get shops created by the user except the current slug
    public function otherShops(){
        return $this->user->shops()->where('slug', '!=', $this->slug)->paginate(5);
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

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'shop_categories', 'shop_id', 'sub_category_id')??'';
    }

    public function getImage() {
        return $this->image_path && File::exists(public_path($this->image_path)) ? $this->image_path : "";
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

    public function region(){
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function town(){
        return $this->belongsTo(Town::class, 'town_id');
    }

    public function street(){
        return $this->belongsTo(Street::class, 'street_id');
    }
}
