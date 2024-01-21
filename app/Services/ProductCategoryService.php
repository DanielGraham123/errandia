<?php

namespace App\Services;

use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use \Illuminate\Support\Facades\Http;

class ProductCategoryService{

    private $productCategoryRepository;
    private $validationService;
    public function __construct(ProductCategoryRepository $productCategoryRepository, ValidationService $validationService){
        $this->productCategoryRepository = $productCategoryRepository;
        $this->validationService = $validationService;
    }

    public function getAll($product_id)
    {
        # code...
        return $this->productCategoryRepository->get($product_id);
    }

    public function filterByCategoryId($category_id)
    {
        # code...
        return $this->productCategoryRepository->filterByCategoryId($category_id);
    }

    public function save($data)
    {
        # code...
        $validationRules = ['item_id'=>'required', 'sub_category_id'=>'required'];
        $this->validationService->validate($data, $validationRules);
        $this->productCategoryRepository->store($data);
    }

    public function update($id, $data)
    {
        # code...
        $validationRules = ['item_id'=>'numeric|nullable', 'sub_category_id'=>'numeric|nullable'];
        $this->validationService->validate($data, $validationRules);
        $this->productCategoryRepository->update($id, $data);
    }

    public function delete($id, $user_id)
    {
        # code...
        $this->productCategoryRepository->delete($id);
    }

}