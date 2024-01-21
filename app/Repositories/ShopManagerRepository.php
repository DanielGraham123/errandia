<?php
namespace App\Repositories;

use App\Http\Resources\ShopManagerResource;
use App\Models\ShopManager;
use Illuminate\Support\Facades\DB;

class ShopManagerRepository {

    /**
     * get all products
     * @param int $shop_id: nullable, shop id to retrieve managers for
     */
    public function get($shop_id = null)
    {
        # code...
        $shopManagers = $shop_id == null ?
            ShopManager::orderBy('shop_id', 'DESC')->get() : 
            ShopManager::where('shop_id', $shop_id)->get();

        return ShopManagerResource::collection($shopManagers);
    }


    /**
     * get a product or service by slug
     */
    public function getById($id)
    {
        # read the record associated to a given slug
        $shopManager = ShopManager::find($id);
        if($shopManager == null)
            throw new \Exception("Shop manager record does not exist");

        return new ShopManagerResource($shopManager);
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
                $shopManager = new ShopManager($data);
                $shopManager->save();
                return $shopManager;
            });
            return new ShopManagerResource($record);
        } catch (\Throwable $th) {
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
            $record = DB::transaction(function()use($id, $data){
                $shopManager = ShopManager::find($id);
                if($shopManager == null)
                    throw new \Exception("Shop manager record to update does not exist");
                
                $shopManager->update($data);
                return $shopManager;
            });
            return new ShopManagerResource($record);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * update a record in database
     */
    public function delete($id)
    {
        # code...
        // validate data and save to database
        $shopManager = ShopManager::find($id);
        if($shopManager == null)
            throw new \Exception("Shop manager record does not exist");

        $shopManager->delete();
        return true;
    }
}