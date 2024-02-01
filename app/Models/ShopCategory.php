<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    use HasFactory;

    protected $table = 'shop_categories';

    protected $fillable = ['shop_id', 'category_id'];

    public function shop()
    {
        # code...
        return $this->belongsTo(Shop::class);
    }

    public function category()
    {
        # code...
        return $this->belongsTo(Category::class);
    }
}
