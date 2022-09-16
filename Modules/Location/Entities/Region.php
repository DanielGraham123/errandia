<?php

namespace Modules\Location\Entities;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name', 'status','country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
