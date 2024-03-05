<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOTP extends Model
{
    use HasFactory;

    protected $table = 'shop_otps';

    protected $fillable = ['uuid', 'shop_id', 'code', 'expired_date'];

    public function shop()
    {
        return $this->belongsTo(Shop::class)->first();
    }

}