<?php
namespace App\Repositories;

use App\Http\Resources\ErrandResource;
use App\Models\Category;
use App\Models\Errand;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class ErrandRepository {

    /**
     * get all products
     * @param int $size: nullable, specify the number of records to take
     * @param string $category_slug: nullable, category slug to query products per category
     */
    public function get($size = null)
    {
        # code...
        $errands = null;
        if($size != null){
            $errands = Errand::orderBy('id', 'DESC')->take($size)->get();
        }else{
            $errands = Errand::orderBy('id', 'DESC')->get();
        }
        return ErrandResource::collection($errands);
    }


    /**
     * get a product or service by slug
     */
    public function getBySlug($slug)
    {
        # read the record associated to a given slug
        $errand = Errand::whereSlug($slug)->first();
        return new ErrandResource($errand);
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
                $errand = new Errand($data);
                $errand->save();
                return $errand;
            });
            return new ErrandResource($record);
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
                $errand = Errand::whereSlug($slug)->first();
                $errand->update($data);
                return $errand;
            });
            return new ErrandResource($record);
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
        $errand = Errand::whereSlug($slug)->first();
        if($errand == null){
            throw new Exception("Errand to be deleted not found");
        }
        $errand->delete();
        return true;
    }
}