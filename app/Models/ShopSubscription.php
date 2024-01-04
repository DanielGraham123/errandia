<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopSubscription extends Model
{
    use HasFactory;

    protected $table = "shops_subscriptions";

    protected $fillable = ['shop_id', 'subscription_id', 'subscription_date', 'expiration_date', 'status', 'payment_id'];

    protected $dates = ['subscription_date', 'expiration_date'];
    
    public function plan()
    {
        # code...
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function shop()
    {
        # code...
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}
