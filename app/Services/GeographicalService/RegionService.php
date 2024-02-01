<?php


namespace App\Services\GeographicalService;


use App\Models\Region;
use App\Repositories\RegionRepository;

class RegionService
{

    private $regionRepository;

    public function __construct(RegionRepository $regionRepository)
    {
        # code...
        $this->regionRepository = $regionRepository;
    }

    public function getAllRegions()
    {
        return $this->regionRepository->get();
    }

    public function getById($id)
    {
        # code...
        return $this->regionRepository->getById($id);
    }
}