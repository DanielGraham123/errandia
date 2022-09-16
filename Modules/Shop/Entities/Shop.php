<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\ProductCategory\Entities\SubCategory;
use Modules\User\Entities\User;

class Shop extends Model
{

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
}
