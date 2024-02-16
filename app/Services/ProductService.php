<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
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
//            'status'=>'nullable',
//            'featured_image'=>'nullable|file|mimes:image/*',
            'quantity'=>'nullable|numeric',
//            'views'=>'nullable|numeric',
            'service'=>'boolean|nullable',
//            'search_index'=>'required',
            'tags'=>'nullable',
            'category_id'=>'required'
        ];

        if (isset($data['featured_image']) && ($file = $data['featured_image']) != null) {
            $data['featured_image'] = $this->uploadImage($file, 'products');
        }

        // Handle multiple image uploads
        if (isset($data['images']) && is_array($data['images'])) {
            $images = [];
            foreach ($data['images'] as $image) {
                $imagePath = $this->uploadImage($image, 'products');
                $productImage = new ProductImage(['image' => $imagePath]);
                $images[] = $productImage;
            }
            $data['productImages'] = $images; // Use a different key to store images
        }

        $this->validationService->validate($data, $validationRules);
        return $this->productRepository->store($data);
    }

    private function uploadImage($file, $folder)
    {
        $path = public_path("uploads/$folder/");
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $fName = $folder . '_' . time() . '_' . random_int(1000, 9999) . '.' . $file->getClientOriginalExtension();
        $file->move($path, $fName);

        return "uploads/$folder/$fName";
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