<?php

namespace App\Services;

use App\Models\Shop;
use App\Repositories\ShopManagerRepository;
use App\Repositories\ShopRepository;
use \Illuminate\Support\Facades\Http;
use PhpParser\Node\Scalar\String_;

class ShopService{

    private 
        $shopRepository,
        $validationService,
        $shopManagerRepository;

    public function __construct(
            ShopRepository $shopRepository, 
            ValidationService $validationService,
            ShopManagerRepository $shopManagerRepository
        ){
        $this->shopRepository = $shopRepository;
        $this->validationService = $validationService;
        $this->shopManagerRepository = $shopManagerRepository;
    }

    public function getAll($size = null, $category_id = null)
    {
        # code...
        return $this->shopRepository->get($size, $category_id);
    }

    public function getUserShops($user_id)
    {
//        $shops = Shop::join('shop_managers', 'shop_managers.shop_id', '=', 'shops.id')
//            ->where('shop_managers.user_id', $user_id)
//            ->select('shops.*')->get();
//        return $shops;
        return Shop::where('user_id', $user_id)->orderBy('name')->get();
    }

    public function getBySlug($slug)
    {
        # code...
        return $this->shopRepository->getBySlug($slug);
    }

    public function getManagers($shop_id)
    {
        # code...
        return $this->shopManagerRepository->get($shop_id);
    }

    public function save($data)
    {
        if(isset($data['image']) && ($file = $data['image']) != null){
            $path = public_path('uploads/logos/');
            $fName = 'logo_'.time().'_'.random_int(1000, 9999).'.'.$file->getClientOriginalExtension();
            $file->move($path, $fName);
            $data['image_path'] = asset('uploads/logos/'.$fName);
        } else {
            $data['image_path'] = asset('assets/images/logo-default.png');
        }

        return $this->shopRepository->store($data);
    }

    public function saveManager($data)
    {
        # code...
        $validationRules = ['shop_id'=>'required', 'user_id'=>'required'];
        $this->validationService->validate($data, $validationRules);
        return $this->shopManagerRepository->store($data);
    }

    public function updateManager($id, $data)
    {
        # code...
        $validationRules = [];
        $this->validationService->validate($data, $validationRules);
        return $this->shopManagerRepository->update($id, $data);
    }

    public function update($slug, $data)
    {
        # code...
        $validationRules = [];
        $this->validationService->validate($data, $validationRules);
        if(empty($data))
            throw new \Exception("No data provided for update");
        return $this->shopRepository->update($slug, $data);
    }

    public function updateContactInfo($shop_id, $contact_data)
    {
        # code...
    }

    public function updateManagers($shop_id, $manager_data)
    {
        # code...
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