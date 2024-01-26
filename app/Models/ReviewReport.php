<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewReport extends Model
{
    use HasFactory;

    protected $fillable = ['review_id', 'reason'];

    public function review()
    {
        # code...
        return $this->belongsTo(Review::class, 'review_id');
    }
}
