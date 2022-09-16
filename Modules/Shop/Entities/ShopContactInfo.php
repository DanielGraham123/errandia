<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Street\Entities\Street;


class ShopContactInfo extends Model
{
    protected $table = "shop_contact_info";
    protected $fillable = ['street_id', 'tel', 'address', 'website_link', 'facebook_link', 'instagram_link','whatsapp_number'];

    public static function getTableName()
    {
        return "shop_contact_info";
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }
}
