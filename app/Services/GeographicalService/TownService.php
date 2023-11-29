<?php


namespace App\Services\GeographicalService;


use App\Models\Town;

class TownService
{
    public function getTownsByRegion($regionId)
    {
        return Town::where('region_id', $regionId)->get()->toArray();
    }
}