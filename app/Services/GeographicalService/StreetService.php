<?php


namespace App\Services\GeographicalService;


use App\Models\Street;

class StreetService
{
    public function getStreetsByTown($townId)
    {
        return Street::where('town_id', $townId)->get()->toArray();
    }
}