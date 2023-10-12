<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;

    public function region()
    {
        # code...
        return $this->belongsTo(Region::class);
    }
}
