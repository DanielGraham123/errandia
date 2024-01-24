<?php

namespace App\Services;

use App\Repositories\ProductImageRepository;
use \Illuminate\Support\Facades\Http;

class ProductImageService{

    private $validationService;
    private $productImageRepository;
    public function __construct(ProductImageRepository $productImageRepository, ValidationService $validationService){
        $this->productImageRepository = $productImageRepository;
        $this->validationService = $validationService;
    }

    public function getAll($product_id)
    {
        # code...
        return $this->productImageRepository->get($product_id);
    }

    public function getOne($id)
    {
        # code...
        return $this->productImageRepository->getById($id);
    }

    public function save($data)
    {
        # code...
        $validationRules = ['item_id'=>'required', 'image'=>'required'];
        $this->validationService->validate($data, $validationRules);
        $this->productImageRepository->store($data);
    }

    public function delete($id, $user_id)
    {
        # code...
        return $this->productImageRepository->delete($id);
    }

}