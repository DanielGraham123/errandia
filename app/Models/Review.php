<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['buyer_id', 'item_id', 'rating', 'review', 'status'];

    protected $dates = ['created_at', 'created_at'];

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

    public function reports()
    {
        return $this->hasMany(ReviewReport::class, 'review_id');
    }
}
