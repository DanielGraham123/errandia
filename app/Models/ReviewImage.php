<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewImage extends Model
{
    use HasFactory;

    protected $table = 'review_images';
    protected $fillable = ['review_id', 'image'];
    
    public function getImage()
    {
        return $this->image ? asset('storage/'. $this->image) : '';
    }

    public function review()
    {
        # code...
        return $this->belongsTo(Review::class, 'review');
    }
}
