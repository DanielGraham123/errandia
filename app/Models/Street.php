<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    public function town()
    {
        # code...
        return $this->belongsTo(Town::class);
    }

}
