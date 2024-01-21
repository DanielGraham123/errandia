<?php
namespace App\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\facades\DB;
use Exception;

class ProductRepository {

    /**
     * get all products
     * @param bool $service: nullable, if true|1, returns services only. if false|0, returns products only. otherwise return both
     * @param int $size: nullable, specify the number of records to take
     * @param string $category_id: nullable, category id to query products per category
     */
    public function get($size = null, $category_id = null, $service = null)
    {
        # code...
        $items = [];
        if($category_id != null){
            $category = Category::find($category_id);
            
            $builder = $service == null ? 
                $category->items()->orderBy('id', 'DESC') : 
                $category->items()->orderBy('id', 'DESC')->where('service', $service); 
        }else{
            $builder = $service == null ? 
                Product::orderBy('id', 'DESC') : 
                Product::orderBy('id', 'DESC')->where('service', $service);
        }

        $items = $size ==  null ?
            $builder->get() : 
            $builder->take($size)->get();

        return ProductResource::collection($items);

        
    }


    /**
     * get a product or service by slug
     * @param string $slug: unique slug of item to read
     */
    public function getBySlug($slug)
    {
        # read the record associated to a given slug
        $item = Product::whereSlug($slug)->first();
        if($item == null){
            throw new Exception("Item does not exist");
        }
        return new ProductResource($item);
    }


    /**
     * save a record to database
     */
    public function store($data)
    {
        # code...
        // validate data and save to database
        try {
            $record = DB::transaction(function()use($data){
                $item = new Product($data);
                $item->save();
                return $item;
            });
            return new ProductResource($record);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * update a record in database
     */
    public function update( $slug, $data)
    {
        # code...
        // validate data and save to database
        try {
            //code...
            $record = DB::transaction(function()use($slug, $data){
                $item = Product::whereSlug($slug)->first();
                if($item ==  null){
                    throw new Exception("Item to be updated does not exist");
                }
                $item->update($data);
                return $item;
            });
            return new ProductResource($record);
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
        $item  = Product::whereSlug($slug)->first();
        if($item ==  null){
            throw new Exception("Item to be deleted does not exist");
        }
        $item->delete();
        return true;
    }
}