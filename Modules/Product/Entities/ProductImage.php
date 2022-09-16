<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    protected $table = "product_images";

    protected $fillable = ['product_id', 'image_path'];

    public function product()
    {
        $this->belongsTo(Product::class);
    }
}
