<?php
namespace App\Repositories;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ErrandResource;
use App\Http\Resources\ShopResource;
use App\Models\Category;
use App\Models\Errand;
use App\Models\Street;
use App\Models\Town;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class TownRepository {


    /**
     * get all towns
     * @param int $region_id: nullable, specify the region_id to get towns for a particular region only
     */
    public function get($region_id = null)
    {
        # code...
        $regions = $region_id == null ?
            Town::orderBy('name')->get()->toArray() :
            Town::where('region_id', $region_id)->orderBy('name')->get()->toArray();
        return $regions;
    }


    /**
     * get a town with the supplied id
     */
    public function getById($id)
    {
        # read the record associated to a given slug
        $town = Town::find($id);
        if($town == null)
            throw new Exception("Town record does not exist");
        return $town;
    }

    /**
     * save a new town record to database
     */
    public function store($data)
    {
        if(Town::where($data)->count() > 0)
            throw new Exception("Town already exist");
        $town = new Town($data);
        $town->save();
        return $town;        
    }

    /**
     * update existing town record in database
     */
    public function update($id, $data)
    {
        $town = Town::find($id);
        if(empty($town))
            throw new Exception("Record to be updated does not exist");

        if(Town::where($data)->where('id', '!=', $id)->count() > 0)
            throw new Exception("Town already exist");
        $town->update($data);
        return $town;        
    }



    /**
     * delete street record from database
     */
    public function delete($id)
    {
        # code...
        $town = Town::find($id);
        if($town == null){
            throw new Exception("Town to be deleted not found");
        }
        $town->delete();
        return true;
    }
}