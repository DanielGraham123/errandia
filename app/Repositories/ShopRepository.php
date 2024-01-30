<?php
namespace App\Repositories;

use App\Http\Resources\ShopResource;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ShopRepository {

    /**
     * get all products
     * @param int $size: nullable, specify the number of records to take
     * @param string $category_id: nullable, category id to query products per category
     */
    public function get($size = null, $category_id = null)
    {
        # code...
        $builder = $category_id == null ?
            Shop::orderBy('id', 'desc') : 
            Category::find($category_id)->shops()->orderBy('id', 'desc') ?? null;

        if($builder == null)
            throw new \Exception("Category does not exist");

        $shops = $size == null ?
            $builder->get() :
            $builder->take($size)->get();

        return ShopResource::collection($shops);
    }


    /**
     * get shop owners
     * @param int $size: nullable, number of records to get from the database
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
        if($shop == null)
            throw new \Exception("Shop record with record ".$slug." does not exist");
        return new ShopResource($shop);
    }


    public function myShops($user_id)
    {
        # code...
        $shops = Shop::join('shop_managers', 'shop_managers.shop_id', '=', 'shops.id')->where('shop_managers.user_id', $user_id)->select('shops.*')->get();
        return ShopResource::collection($shops);
    }

    public function getBranches($slug)
    {
        # code...
        // get branches of business with this slug
        $shops = Shop::where('slug', $slug)->orWhere('parent_slug', $slug)->get();
        return ShopResource::collection($shops);
    }

    /**
     * save a record to database
     */
    public function store($data)
    {
        # code...
        // validate data and save to database
        try {
            if(Shop::where('name', $data['name'])->count() > 0){
                throw new \Exception('A business already exist with same name');
            }
            $record = DB::transaction(function()use($data){
                $shop = new Shop($data);
                $shop->save();
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
    public function update($slug, $data)
    {
        # code...
        // validate data and save to database
        try {
            $record = DB::transaction(function()use($slug, $data){
                $shop = Shop::whereSlug($slug)->first();
                if($shop == null)
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
        # code...
        // validate data and save to database
        $shop = Shop::whereSlug($slug)->first();
        if($shop == null)
            throw new \Exception("shop record to be deleted does not exist");

        $shop->delete();
        return true;
    }
}