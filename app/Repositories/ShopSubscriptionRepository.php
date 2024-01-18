<?php
namespace App\Repositories;

use App\Http\Resources\ShopSubscriptionResource;
use App\Models\ShopSubscription;
use Illuminate\Support\Facades\DB;

class ShopSubscriptionRepository {

    /**
     * get all products
     * @param int $size: nullable, specify the number of records to take
     * @param string $shop_id: nullable, id of the shop to get subscription records for
     */
    public function get($size = null, $shop_id = null)
    {
        # code...
        $builder = $shop_id == null ? 
            ShopSubscription::orderBy('id', 'desc') :
            ShopSubscription::where('shop_id', $shop_id)->orderBy('id', 'DESC');

        $subscriptions = $size == null ?
            $builder->get() :
            $builder->take($size)->get();

        return ShopSubscriptionResource::collection($subscriptions);
    }


    /**
     * get a product or service by slug
     */
    public function getBySlug($id)
    {
        # read the record associated to a given slug
        $shopSubscription = ShopSubscription::find($id);
        if($shopSubscription == null)
            throw new \Exception("Shop subscription record does not exist");

        return new ShopSubscriptionResource($shopSubscription);
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
                $shopSubscription = new ShopSubscription($data);
                $shopSubscription->save();
                return $shopSubscription;
            });
            return new ShopSubscriptionResource($record);
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
                $shopSubscrion = ShopSubscription::find($id);
                if($shopSubscrion == null)
                    throw new \Exception("Shop subscription to be updated does not exist");

                $shopSubscrion->update($data);
                return $shopSubscrion;
            });
            return new ShopSubscriptionResource($record);
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
        $shopSubscription = ShopSubscription::find($id);
        if($shopSubscription == null)
            throw new \Exception("Shop subscription record deos not exist");

        $shopSubscription->delete();
        return true;
    }
}