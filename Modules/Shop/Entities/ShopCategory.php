<?php

namespace Modules\Shop\Entities;
use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    protected $table = "shop_categories";

    protected $fillable = ['shop_id', 'product_sub_category_id'];
}
