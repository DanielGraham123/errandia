<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductQuoteImage extends Model
{
    protected $table = "product_quote_images";

    protected $fillable = ['quote_id', 'image_path'];

    public function enquiry()
    {
        $this->belongsTo(Quote::class);
    }
}
