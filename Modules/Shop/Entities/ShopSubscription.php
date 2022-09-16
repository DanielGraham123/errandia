<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopSubscription extends Model
{

    protected $table = "shop_subscriptions";
    protected $fillable = ['shop_id', 'subscription_id', 'start_date', 'end_date'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
