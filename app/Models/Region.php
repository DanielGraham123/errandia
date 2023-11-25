<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    public function towns(){
        return $this->hasMany(Town::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'region_id');
    }
}
