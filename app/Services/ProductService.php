<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use \Illuminate\Support\Facades\Http;

class ProductService{

    private $productRepository;
    private $validationService;
    public function __construct(ProductRepository $productRepository, ValidationService $validationService){
        $this->productRepository = $productRepository;
        $this->validationService = $validationService;
    }

    public function getAll($size = null, $category_id = null, $service = null)
    {
        # code...
        return $this->productRepository->get($size, $category_id, $service);
    }

    public function getAllPaginate($page_size, $current_page, $category_id = null, $service = null)
    {
        # code...
        $products = $this->productRepository->get($page_size, $category_id, $service);
        $items = array_slice($products->resolve(), ($current_page-1)*$page_size, $page_size);
        $pagination = new LengthAwarePaginator($items, $products->count(), $page_size, $current_page);
        return $pagination;
    }

    public function getOne($slug)
    {
        # code...
        return $this->productRepository->getBySlug($slug);
    }

    public function save($data)
    {
        # code...
        $validationRules = [
            'name'=>'required', 'shop_id'=>'required', 
            'unit_price'=>'nullable|numeric', 'description'=>'nullable|string', 
            'slug'=>'required', 'status'=>'nullable', 
            'featured_image'=>'nullable|file|mimes:image/*', 
            'quantity'=>'nullable|numeric', 'views'=>'nullable|numeric', 
            'service'=>'nullable', 'search_index'=>'required', 'tags'=>'nullable'
        ];
        $this->validationService->validate($data, $validationRules);
        return $this->productRepository->store($data);
    }

    public function update($slug, $data)
    {
        # code...
        $validationRules = [];
        $this->validationService->validate($data, $validationRules);
        if(empty($data))
            throw new \Exception("No data provided for update");
        return $this->productRepository->update($slug, $data);
    }

    public function delete($slug, $user_id)
    {
        # code...
        return $this->productRepository->delete($slug);
    }

}