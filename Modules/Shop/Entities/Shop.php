<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductQuote;
use Modules\ProductCategory\Entities\SubCategory;
use Modules\User\Entities\User;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'status', 'user_id', 'description', 'category_id', 'image_path'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function shopRegistrationInfo()
    {
        return $this->hasOne(ShopRegistrationInfo::class);
    }

    public function shopContactInfo()
    {
        return $this->hasOne(ShopContactInfo::class);
    }

    public function shopBusinessProfile()
    {
        return true;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function subscribers()
    {
        return $this->hasMany(ShopSubscriber::class);
    }
    public function quotes()
    {
        return $this->belongsToMany(ProductQuote::class ,'shop_quotes');
    }
    public function categories()
    {
        return $this->belongsToMany(SubCategory::class ,'shop_categories','shop_id','product_sub_category_id');
    }
}
