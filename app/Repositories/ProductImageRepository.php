<?php
namespace App\Repositories;

use App\Http\Resources\ProductImageResource;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductImageRepository {

    /**
     * get all product images
     * @param int $item_id: nullable, id of the item(product/service) to get images for
     */
    public function get($item_id = null)
    {
        # code...
        if($item_id != null){
            $images = ProductImage::where('item_id', $item_id)->orderBy('id', 'DESC')->get();
            return ProductImageResource::collection($images);
        }
    }


    /**
     * get a product or service by slug
     */
    public function getById($id)
    {
        # read the record associated to a given slug
        $image = ProductImage::find($id);
        return new ProductImageResource($image);
    }


    /**
     * save a record to database
     */
    public function store($data)
    {
        # code...
        try {
            //code...
            $record = DB::transaction(function()use($data){
                $productImage = new ProductImage($data);
                $productImage->save();
                return $productImage;
            });
            return new ProductImageResource($record);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * update a record in database
     */
    public function update($data)
    {
        # code...
        // validate data and save to database
    }


    /**
     * update a record in database
     */
    public function delete($id)
    {
        # code...
        // validate data and save to database
        $productImage = ProductImage::find($id);
        if($productImage == null){
            throw new \Exception("Image to be deleted does not exist");
        }
        $productImage->delete();
        return true;
    }
}