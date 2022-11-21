<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Model;

class ShopQuote extends Model
{

    protected $table = "shop_quotes";

    protected $fillable = ['shop_id', 'product_quote_id'];
}
