<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopSubscriber extends Model
{
    use HasFactory;

    protected $table = 'shop_subscribers';
    protected $fillable = ['shop_id', 'user_id'];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
