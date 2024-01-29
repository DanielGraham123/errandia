<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = ['street_id', 'user_id', 'image_path'];

    public function street()
    {
        return $this->belongsTo(Street::class, 'street_id');
    }
}
