<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopRegistrationInfo extends Model
{
    use HasFactory;

    protected $table = 'shop_registration_info';

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}
