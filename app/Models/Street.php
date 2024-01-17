<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Street extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'town_id'];

    public function town()
    {
        # code...
        return $this->belongsTo(Town::class);
    }

    public function errands()
    {
        return $this->hasMany(Errand::class);
    }
}
