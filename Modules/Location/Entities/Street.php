<?php

namespace Modules\Location\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Street extends Model
{
    use HasFactory;

    protected $fillable = ['name','town_id', 'status'];
    
    protected static function newFactory()
    {
        return \Modules\Location\Database\factories\StreetFactory::new();
    }
}
