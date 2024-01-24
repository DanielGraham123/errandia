<?php

namespace App\Services;

use App\Repositories\ShopCategoryRepository;
use \Illuminate\Support\Facades\Http;

class ShopCategoryService{

    private $shopCategoryRepository;
    private $validationService;

    public function __construct(ShopCategoryRepository $shopCategoryRepository, ValidationService $validationService){
        $this->shopCategoryRepository = $shopCategoryRepository;
        $this->validationService = $validationService;
    }

    public function getAll($shop_id)
    {
        # code...
        return $this->shopCategoryRepository->get($shop_id);
    }

    public function save($data)
    {
        # code...
        $valildationRules = ['shop_id'=>'required', 'sub_category_id'=>'required'];
        $this->validationService->validate($data, $valildationRules);
        return $this->shopCategoryRepository->store($data);
    }

    public function delete($id, $user_id)
    {
        # code...
        // can only be deleted by the creator of the shop
        $shop = $this->shopCategoryRepository->getById($id)->shop;
        if($user_id != $shop->user_id)
            throw new \Exception("Permission denied. This operation can only be performed by the owner of the shop");

        $this->shopCategoryRepository->delete($id);
    }

}