<?php
namespace App\Repositories;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ErrandResource;
use App\Models\Category;
use App\Models\Errand;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class CategoryRepository {

    /**
     * get all products
     * @param int $size: nullable, specify the number of records to take
     */
    public function get($size = null)
    {
        # code...
        $categories = $size == null ?
            Category::orderBy('name')->get() :
            Category::orderBy('name')->take($size)->get();
        return CategoryResource::collection($categories);
    }


    /**
     * get a product or service by slug
     */
    public function getBySlug($slug)
    {
        # read the record associated to a given slug
        $category = Category::whereSlug($slug)->first();
        if($category == null)
            throw new Exception("Category record does not exist");
        return new CategoryResource($category);
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
                $category = new Category($data);
                $category->save();
                return $category;
            });
            return new CategoryResource($record);
        }catch(Throwable $th){
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
            $record = DB::transaction(function()use($data, $slug){
                $category = Category::whereSlug($slug)->first();
                $category->update($data);
                return $category;
            });
            return new CategoryResource($record);
        } catch (Throwable $th) {
            throw $th;
        }
    }


    /**
     * update a record in database
     */
    public function delete($slug)
    {
        # code...
        $category = Category::whereSlug($slug)->first();
        if($category == null){
            throw new Exception("Errand to be deleted not found");
        }
        $category->delete();
        return true;
    }
}