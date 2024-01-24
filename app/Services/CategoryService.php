<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ShopCategoryRepository;
use \Illuminate\Support\Facades\Http;
use phpseclib3\Exception\UnsupportedOperationException;

class CategoryService{

    private $categoryRepository;
    private $validationService;
    private $shopCategoryRepository;
    private $productCategoryRepository;
    public function __construct(CategoryRepository $categoryRepository, ValidationService $validationService, ProductCategoryRepository $productCategoryRepository, ShopCategoryRepository $shopCategoryRepository){
        $this->categoryRepository = $categoryRepository;
        $this->validationService = $validationService;
        $this->productCategoryRepository = $productCategoryRepository;
        $this->shopCategoryRepository = $shopCategoryRepository;
    }

    public function getAll($size = null)
    {
        # code...
        return $this->categoryRepository->get($size);
    }

    public function paginatedGet($size)
    {
        # code...
        throw new UnsupportedOperationException("This feature is not supported");
    }

    public function getOne($slug)
    {
        # code...
        return $this->categoryRepository->getBySlug($slug);
    }

    public function save($data)
    {
        # code...
        // validate and save a category
        $validationRules = [];
        $this->validationService->validate($data, $validationRules);
        return $this->categoryRepository->store($data);
    }

    public function update($slug, $data)
    {
        # code...
        // validate and save a category
        $validationRules = [];
        $this->validationService->validate($data, $validationRules);
        return $this->categoryRepository->update($slug, $data);
    }

    public function delete($slug)
    {
        # code...
        // check if this category already has assigned products and/or businesses
        $category = $this->categoryRepository->getBySlug($slug);
        $shopCatoegories = $this->shopCategoryRepository->filterByCategoryId($category->id);
        $productCatoegories = $this->productCategoryRepository->filterByCategoryId($category->id);
        if(empty($shopCatoegories))
            throw new \Exception("This category already has shops.");
        if(empty($productCatoegories))
            throw new \Exception("This category already has products or services.");
        return $this->categoryRepository->delete($slug);
    }

}