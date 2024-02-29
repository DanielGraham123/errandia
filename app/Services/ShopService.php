<?php

namespace App\Services;

use App\Models\Shop;
use App\Models\ShopContactInfo;
use App\Repositories\ShopManagerRepository;
use App\Repositories\ShopRepository;
use Illuminate\Support\Facades\File;

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

    public function getUserShops($user)
    {
        return $this->shopRepository->getUserShops($user);

    }

    public function getBySlug($slug)
    {
        $shop =  $this->shopRepository->getBySlug($slug);
        if ($shop == null) {
            throw new \Exception("business not found with slug " . $slug);
        }
        return $shop;
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
            if(!file_exists($path))
                mkdir($path, 0777, true);
            $fName = 'logo_'.time().'_'.random_int(1000, 9999).'.'.$file->getClientOriginalExtension();

            $file->move($path, $fName);

            $data['image_path'] = 'uploads/logos/'.$fName;

            logger()->info('Image uploaded for shop: ' . $data['image_path']);
        } else {
            logger()->info('No image provided for shop. Using default image');
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

    public function delete($slug)
    {
        return $this->shopRepository->delete($slug);
    }

    /**
     * @throws \Exception
     */
    public function deleteFeaturedImage($shop)
    {
        if(empty($shop->image_path)) {
            logger()->info("shop info: " . json_encode($shop));
            throw new \Exception('No image to delete');
        }

        MediaService::delete_media($shop->image_path);

        $shop->image_path = null;
        $shop->save();

        return $shop;
    }

    public function load_featured_businesses($size = 10)
    {
        return Shop::orderBy('created_at', 'desc')->take($size)->get();
    }

    public function update_shop($request, $shop)
    {
        $data = $request->except(['image']);
        foreach ($data as $key => $value) {
            if ($request->has($key)) {
                $shop->$key = $value;
            }
        }

        // If the shop already has an image, delete it
        if ($request->hasFile('image')) {
            if(!empty($shop->image_path)) {
                MediaService::delete_media($shop->image_path);
            }
            $shop->image_path = MediaService::upload_media($request, 'image', 'logos');
            $data['image_path'] = $shop->image_path;
        }

        // update shop info
        $shop_info = ShopContactInfo::firstOrNew([
            'shop_id' => $shop->id
        ]);
        $shop_info->phone = $data['phone'] ?? '';
        $shop_info->whatsapp = $data['whatsapp'] ?? '';
        $shop_info->address = $data['address'] ?? '';
        $shop_info->facebook = $data['facebook'] ?? '';
        $shop_info->instagram = $data['instagram'] ?? '';
        $shop_info->website = $data['website'] ?? '';
        $shop_info->email = $data['email'] ?? '';
        $shop_info->save();

        $shop->update($data);
        $shop->refresh();
        return $shop;
    }

}