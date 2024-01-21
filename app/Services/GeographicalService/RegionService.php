<?php


namespace App\Services\GeographicalService;


use App\Models\Region;

class RegionService
{
    public function getAllRegions()
    {
        return Region::all();
    }
}