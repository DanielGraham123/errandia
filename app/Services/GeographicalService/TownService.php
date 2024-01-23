<?php


namespace App\Services\GeographicalService;


use App\Models\Town;
use App\Repositories\TownRepository;

class TownService
{

    private $townRepository;

    public function __construct(TownRepository $townRepository)
    {
        # code...
        $this->townRepository = $townRepository;
    }

    public function get()
    {
        return $this->townRepository->get();
    }

    public function getTownsByRegion($regionId)
    {
        return $this->townRepository->get($regionId);
    }

    public function getById($id)
    {
        # code...
        return $this->townRepository->getById($id);
    }
}