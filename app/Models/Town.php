<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Town extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'region_id'];

    public function region()
    {
        # code...
        return $this->belongsTo(Region::class);
    }

    public function streets()
    {
        # code...
        return $this->hasMany(Street::class);
    }

}
