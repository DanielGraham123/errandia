<?php

namespace Modules\Location\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Modules\Street\Entities\Street;

class Town extends Model
{

    protected $fillable = ['name', 'region_id', 'status'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function towns()
    {
        return $this->hasMany(Town::class, 'region_id');
    }

    public function streets()
    {
        return $this->hasMany(Street::class, 'town_id');
    }
}
