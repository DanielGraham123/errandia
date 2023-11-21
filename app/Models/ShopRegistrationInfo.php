<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopRegistrationInfo extends Model
{
    use HasFactory;

    protected $fillable = ['shop_id', 'registration_date', 'registration_number', 'tax_payer_number', 'tax_payer_doc_path', 'years_of_existence'];
}
