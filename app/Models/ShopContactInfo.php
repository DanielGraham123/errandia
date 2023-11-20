<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;

class ShopContactInfo extends Model
{
    use HasFactory;

    protected $fillable = ['shop_id'];

    protected $table = 'shop_contact_info';

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function street()
    {
        return $this->belongsTo(Street::class, 'street_id');
    }
}
