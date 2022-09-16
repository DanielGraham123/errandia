<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductReviewImage extends Model
{
    protected $table = "product_review_images";

    protected $fillable = ['review_id', 'image_path'];

    public function review()
    {
        $this->belongsTo(Enquiry::class);
    }
}
