<?php

namespace Modules\User\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Product\Entities\ProductReview;
use Modules\Shop\Entities\Shop;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tel', 'user_type',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function products()
    {
        return $this->hasMany("App\Models\Product");
    }

    public function shop()
    {
        return $this->hasOne(Shop::class, 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'buyer_id');
    }

}
