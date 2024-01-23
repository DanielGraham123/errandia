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
        $validationRules = [
            'name'=>'required', 'description'=>'required', 'user_id'=>'required',
            'slug'=>'required', 'image'=>'file|mimes:image/*|nullable', 
            'status'=>'nullable', 'is_branch'=>'nullable', 'parent_slug'=>'nullable'
        ];
        $this->validationService->validate($data, $validationRules);
        if(($file = $data['image']) != null){
            $path = public_path('uploads/logos/');
            $fname = 'logo_'.time().'_'.random_int(1000, 9999).'.'.$file->getClientOriginalExtension();
            $file->move($path, $fname);
            $data['image_path'] = asset('uploads/logos/'.$fname);
        }
        return $this->shopRepository->store($data);
    }

    public function update($slug, $data)
    {
        # code...
        $validationRules = [];
        $this->validationService->validate($data, $validationRules);
        if(empty($data))
            throw new \Exception("No data provided for update");
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