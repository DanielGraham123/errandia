<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'rating', 'review', 'buyer_id', 'status'];

    public function images(){
        return $this->hasMany('review_images', 'review_id');
    }
}
