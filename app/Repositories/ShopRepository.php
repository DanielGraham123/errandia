<?php

namespace App\Repositories;

use App\Http\Resources\ShopResource;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Region;
use App\Models\Shop;
use App\Models\ShopContactInfo;
use App\Models\Town;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ShopRepository
{

    /**
     * get all products
     * @param int $size : nullable, specify the number of records to take
     * @param string $category_id : nullable, category id to query products per category
     */
    public function get($size = null, $category_id = null)
    {
        # code...
        $builder = $category_id == null ?
            Shop::orderBy('id', 'desc') :
            Category::find($category_id)->shops()->orderBy('id', 'desc') ?? null;

        if ($builder == null)
            throw new \Exception("Category does not exist");

        $shops = $size == null ?
            $builder->get() :
            $builder->take($size)->get();

        return ShopResource::collection($shops);
    }


    /**
     * get shop owners
     * @param int $size : nullable, number of records to get from the database
     */
    public function shopOwners($size = null)
    {
        # code...
        $builder = User::join('shops', 'shops.user_id', '=', 'user.id')->select('users.*', 'shops.id as shop_id');
        $shopOwners = $size == null ? $builder->get() : $builder->take($size)->get();
        return UserResource::collection($shopOwners);
    }


    /**
     * get a product or service by slug
     */
    public function getBySlug($slug)
    {
        # read the record associated to a given slug
        $shop = Shop::whereSlug($slug)->first();
        if ($shop == null)
            throw new \Exception("Shop record with record " . $slug . " does not exist");
        return new ShopResource($shop);
    }


    /**
     * save a record to database
     * @throws \Exception
     */
    public function store($data)
    {
        // validate data and save to database
        if (Shop::where('name', $data['name'])->count() > 0) {
            throw new \Exception('A business already exist with same name');
        }

        $record = DB::transaction(function () use ($data) {
            $user = $data['user'];

            $shop = new Shop();
            $shop->name = $data['name'];
            $shop->description = $data['description'];
            $shop->user_id = $user->id;

            // check if category_id exists
            if (!isset($data['category_id'])) {
                throw new \Exception('You must choose a category for your business');
            } else {
                if (!Category::find($data['category_id'])) {
                    throw new \Exception('Category does not exist');
                }
            }

            $shop->category_id = $data['category_id'];
            $shop->status = $data['status'] ?? true;

            $shop->is_branch = $data['is_branch'] ?? false;
            $shop->parent_slug = $data['parent_slug'] ?? '';
            $shop->slug = Str::slug($data['name']) . '-' . time();
            $shop->slogan = $data['slogan'] ?? '';
            $shop->image_path = $data['image_path'];

            // check if the region_id is present in the data
            if (isset($data['region_id'])) {
                // check if region exists
                if (!Region::find($data['region_id'])) {
                    throw new \Exception('Region does not exist');
                }
                $shop->region_id = $data['region_id'] ?? "";
            }

            // check if the town_id is present in the data
            if (isset($data['town_id'])) {
                // check if town exists
                if (!Town::find($data['town_id'])) {
                    throw new \Exception('Town does not exist');
                }
                $shop->town_id = $data['town_id'] ?? "";

            }

//            $shop->street_id = $data['street_id'] ?? "";
            $shop->street = $data['street'] ?? "";

            if (isset($data['is_branch']) && $data['is_branch'] && isset($data['parent_id'])) {
                $shop->parent_id = $data['parent_id'];
            } else {
                $shop->parent_id = null; // or simply don't set it as it's nullable
            }

            $shop->save();

            $shop_info = ShopContactInfo::firstOrNew([
                'shop_id' => $shop->id
            ]);
//            $shop_info->street_id = $data['street_id'];
            $shop_info->phone = $data['phone'] ?? '';
            $shop_info->whatsapp = $data['whatsapp'] ?? '';
            $shop_info->address = $data['address'] ?? '';
            $shop_info->facebook = $data['facebook'] ?? '';
            $shop_info->instagram = $data['instagram'] ?? '';
            $shop_info->website = $data['website'] ?? '';
            $shop_info->email = $data['email'] ?? '';
            $shop_info->save();

            return $shop;
        });

        logger()->info('Shop saved: ' . json_encode($record));

        return new ShopResource($record);
    }

    /**
     * get user shops
     */
    public function getUserShops($user) {
        return Shop::orderBy('created_at', 'desc')->where('user_id', $user->id)->paginate(15);
    }

    /**
     * update a record in database
     */
    public function update($slug, $data)
    {
        try {
            $record = DB::transaction(function () use ($slug, $data) {
                $shop = Shop::whereSlug($slug)->first();
                if ($shop == null)
                    throw new \Exception("Shop to be updated does not exist");

                $shop->update($data);
                return $shop;
            });
            return new ShopResource($record);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * update a record in database
     */
    public function delete($slug)
    {
        $shop = Shop::whereSlug($slug)->first();
        if ($shop == null)
            throw new \Exception("shop record to be deleted does not exist");
        $shop->delete();
        return true;
    }
}