<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopRegistrationInfo extends Model
{
    protected $fillable = ['shop_id', 'tax_number', 'registration_date','tax_payer_doc_path','years_existence','registration_number'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
