<?php
namespace App\Repositories;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ErrandResource;
use App\Http\Resources\ShopCategoryResource;
use App\Models\Category;
use App\Models\Errand;
use App\Models\Shop;
use App\Models\ShopCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class ShopCategoryRepository {

    /**
     * get all products
     * @param int $shop_id: id of shop to query categories for
     */
    public function get($shop_id)
    {
        # code...
        $shop = Shop::find($shop_id);
        if($shop == null)
            throw new Exception("Shop to get categories for does not exist");

        $shopCategories = ShopCategory::where('shop_id', $shop_id)->get();
        return ShopCategoryResource::collection($shopCategories);
    }

    public function getById($id)
    {
        # code...
        $shopCategory = ShopCategory::find($id);
        if($shopCategory == null)
            throw new Exception("Shop Category record does not exist");

        return new ShopCategoryResource($shopCategory);
    }
    
    public function filterByCategoryId($category_id)
    {
        # code...
        $shopCategories = ShopCategory::where('sub_category_id', $category_id)->get();
        return ShopCategoryResource::collection($shopCategories);
    }

    /**
     * save a record to database
     * @param array $data associative array of 
     */
    public function store($data)
    {
        # code...
        // validate data and save to database
        try{
            $record = DB::transaction(function()use($data){
                $shopcategory = new ShopCategory($data);
                $shopcategory->save();
                return $shopcategory;
            });
            return new ShopCategoryResource($record);
        }catch(Throwable $th){
            throw $th;
        }
    }


    /**
     * update a record in database
     */
    public function update($id, $data)
    {
        # code...
        // validate data and save to database
        try {
            $record = DB::transaction(function()use($data, $id){
                $shopCategory = ShopCategory::find($id);
                $shopCategory->update($data);
                return $shopCategory;
            });
            return new ShopCategoryResource($record);
        } catch (Throwable $th) {
            throw $th;
        }
    }


    /**
     * update a record in database
     */
    public function delete($id)
    {
        # code...
        $shopCategory = ShopCategory::find($id);
        if($shopCategory == null){
            throw new Exception("Shop category to be deleted not found");
        }
        $shopCategory->delete();
        return true;
    }
}