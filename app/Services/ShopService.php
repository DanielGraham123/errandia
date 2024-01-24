<?php

namespace App\Services;

use App\Repositories\ShopRepository;
use \Illuminate\Support\Facades\Http;

class ShopService{

    private $shopRepository;
    private $validationService;

    public function __construct(ShopRepository $shopRepository, ValidationService $validationService){
        $this->shopRepository = $shopRepository;
        $this->validationService = $validationService;
    }

    public function getAll($size = null, $category_id = null)
    {
        # code...
        return $this->shopRepository->get($size, $category_id);
    }

    public function getBySlug($slug)
    {
        # code...
        return $this->shopRepository->getBySlug($slug);
    }

    public function save($data)
    {
        # code...
        $validationRules = [];
        $this->validationService->validate($data, $validationRules);
        return $this->shopRepository->store($data);
    }

    public function update($slug, $data)
    {
        # code...
        $validationRules = [];
        $this->validationService->validate($data, $validationRules);
    }

    public function delete($slug, $user_id)
    {
        # code...
        $shop = $this->shopRepository->getBySlug($slug);
        if($user_id != $shop->user_id)
            throw new \Exception("Permission denied. shop can only be deleted by the owner");

        $this->shopRepository->delete($slug);
    }

}