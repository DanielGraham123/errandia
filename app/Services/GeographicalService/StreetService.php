<?php


namespace App\Services\GeographicalService;


use App\Models\Street;
use App\Repositories\StreetRepository;

class StreetService
{

    private $streetRepository;
    public function __construct(StreetRepository $streetRepository)
    {
        # code...
        $this->streetRepository = $streetRepository;
    }

    public function get()
    {
        return $this->streetRepository->get();
    }

    public function getStreetsByTown($townId = null)
    {
        return $this->streetRepository->get($townId);
    }

    public function getById($id)
    {
        # code...
        return $this->streetRepository->getById($id);
    }
}