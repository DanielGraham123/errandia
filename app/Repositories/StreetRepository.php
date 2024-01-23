<?php
namespace App\Repositories;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ErrandResource;
use App\Http\Resources\ShopResource;
use App\Models\Category;
use App\Models\Errand;
use App\Models\Street;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class StreetRepository {


    /**
     * get all streets
     * @param int $town_id: nullable, specify the town_id to get streets for a particular town only
     */
    public function get($town_id = null)
    {
        # code...
        $streets = $town_id == null ?
            Street::orderBy('name')->get()->toArray() :
            Street::where('town_id', $town_id)->orderBy('name')->get()->toArray();
        return $streets;
    }


    /**
     * get a street with the supplied id
     */
    public function getById($id)
    {
        # read the record associated to a given slug
        $street = Street::find($id);
        if($street == null)
            throw new Exception("street record does not exist");
        return $street;
    }

    /**
     * save a new street record to database
     */
    public function store($data)
    {
        if(Street::where($data)->count() > 0)
            throw new Exception("Street already exist");
        $street = new Street($data);
        $street->save();
        return $street;        
    }

    /**
     * update existing street record in database
     */
    public function update($id, $data)
    {
        $street = Street::find($id);
        if(empty($street))
            throw new Exception("Record to be updated does not exist");

        if(Street::where($data)->where('id', '!=', $id)->count() > 0)
            throw new Exception("Street already exist");
        $street->update($data);
        return $street;        
    }



    /**
     * delete street record from database
     */
    public function delete($id)
    {
        # code...
        $street = Street::find($id);
        if($street == null){
            throw new Exception("Street to be deleted not found");
        }
        $street->delete();
        return true;
    }
}