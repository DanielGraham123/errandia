<?php
namespace App\Repositories;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ErrandResource;
use App\Http\Resources\ShopResource;
use App\Models\Category;
use App\Models\Errand;
use App\Models\Region;
use App\Models\Street;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class RegionRepository {


    /**
     * get all regions
     */
    public function get()
    {
        # code...
        $regions = Region::orderBy('name')->get()->toArray();
        return $regions;
    }


    /**
     * get a region with the supplied id
     */
    public function getById($id)
    {
        # read the record associated to a given slug
        $region = Region::find($id);
        if($region == null)
            throw new Exception("Region record does not exist");
        return $region;
    }

    /**
     * save a new region record to database
     */
    public function store($data)
    {
        if(Region::where($data)->count() > 0)
            throw new Exception("Region already exist");
        $region = new Region($data);
        $region->save();
        return $region;        
    }

    /**
     * update existing region record in database
     */
    public function update($id, $data)
    {
        $region = Region::find($id);
        if(empty($region))
            throw new Exception("Record to be updated does not exist");

        if(Region::where($data)->where('id', '!=', $id)->count() > 0)
            throw new Exception("Region already exist");
        $region->update($data);
        return $region;        
    }



    /**
     * delete street record from database
     */
    public function delete($id)
    {
        # code...
        $region = Region::find($id);
        if($region == null){
            throw new Exception("Region to be deleted not found");
        }
        $region->delete();
        return true;
    }
}