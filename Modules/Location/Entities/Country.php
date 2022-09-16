<?php

namespace Modules\Location\Entities;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'status'];

    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}
