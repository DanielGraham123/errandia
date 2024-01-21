<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;

class ShopContactInfo extends Model
{
    use HasFactory;

    protected $table = 'shop_contact_info';

    protected $fillable = ['shop_id', 'street_id', 'phone', 'whatsapp', 'address', 'facebook', 'instagram', 'website', 'email'];

    public function shop()
    {
        # code...
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function street()
    {
        # code...
        return $this->belongsTo(Street::class, 'street_id');
    }

    public function location()
    {
        # code...
        if (($street = $this->street) != null) {
            # code...
            return ($street->name??null).', '
                .($street->town->name??null).', '
                .($street->town->region->name??null).', '
                .($street->town->region->country->name??null);
        }else{ return null;}
    }
}
