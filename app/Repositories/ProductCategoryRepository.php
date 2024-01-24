<?php
namespace App\Repositories;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ErrandResource;
use App\Http\Resources\productCategoryResource;
use App\Models\Category;
use App\Models\Errand;
use App\Models\Product;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductCategoryRepository {

    /**
     * get all products
     * @param int $size: nullable, specify the number of records to take
     * @param string $category_slug: nullable, category slug to query products per category
     */
    public function get($product_id)
    {
        # code...
        $product = Product::find($product_id);
        if($product == null)
            throw new Exception("Product to get categories for does not exist");

        $productCategories = ProductCategory::where('item_id', $product_id)->get();
        return ProductCategoryResource::collection($productCategories);
    }

    public function filterByCategoryId($category_id)
    {
        # code...
        $productCategories = ProductCategory::where('sub_category_id', $category_id)->get();
        return productCategoryResource::collection($productCategories);
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
                $productCategory = new ProductCategory($data);
                $productCategory->save();
                return $productCategory;
            });
            return new productCategoryResource($record);
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
                $productCategory = ProductCategory::find($id)->first();
                $productCategory->update($data);
                return $productCategory;
            });
            return new productCategoryResource($record);
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
        $productCategory = ProductCategory::find($id);
        if($productCategory == null){
            throw new Exception("Product category to be deleted not found");
        }
        $productCategory->delete();
        return true;
    }
}