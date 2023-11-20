<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function images()
    {
        return $this->hasMany(ReviewImage::class, 'review_id');
    }
}
