<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopSubscription extends Model
{
    use HasFactory;

    
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
