<?php
namespace App\Repositories;

use App\Http\Resources\SubscriptionPlanResource;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;

class SubscriptionPlanRepository {

    /**
     * get all subscription plans
     */
    public function get()
    {
        # code....
        $plans = Subscription::orderBy('name')->get();
        return SubscriptionPlanResource::collection($plans);
    }


    /**
     * get a product or service by slug
     */
    public function getById($id)
    {
        # read the record associated to a given slug
        $plan  = Subscription::find($id);
        if($plan == null)
            throw new \Exception("Subscription plan record does not exist");

        return new SubscriptionPlanResource($plan);
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
                $plan = new Subscription($data);
                $plan->save();
                return $plan;
            });
            return new SubscriptionPlanResource($record);
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
                $plan  = Subscription::find($id);
                if($plan == null)
                    throw new \Exception("Subcription Plan record does not exist");

                $plan->update($data);
                return $plan;
            });
            return new SubscriptionPlanResource($record);
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
        $plan = Subscription::find($id);
        if($plan == null)
            throw new \Exception("Record to be deleted does not exist");

        $plan->delete();
        return true;
    }
}