<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;

class ProductReview extends Model
{

    protected $table = "product_reviews";
    protected $fillable = ['rating', 'review', 'image_path', 'product_id', 'buyer_id','status'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function images()
    {
        return $this->hasMany(ProductReviewImage::class, 'review_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
