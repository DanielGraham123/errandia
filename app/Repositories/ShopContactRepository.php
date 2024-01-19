<?php
namespace App\Repositories;

use App\Http\Resources\ShopContactInfoResource;
use App\Models\ShopContactInfo;
use Illuminate\Support\Facades\DB;

class ShopContactRepository {

    /**
     * get all products
     * @param int $shop_id: nullable, id of the shop to get contact information for
     */
    public function get($shop_id = null)
    {
        # code...
        $contacts = $shop_id == null ? 
            ShopContactInfo::orderBy('id', "desc")->get() :
            ShopContactInfo::where('shop_id', $shop_id)->orderBy('id', "desc")->get();
            
        return ShopContactInfoResource::collection($contacts);
    }

    public function getById($id)
    {
        # code...
        $contact = ShopContactInfo::find($id);
        if($contact == null)
            throw new \Exception("Contact record does not exist");
        
        return new ShopContactInfoResource($contact);
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
                $contact = new ShopContactInfo($data);
                $contact->save();
                return $contact;
            });
            return new ShopContactInfoResource($record);
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
                $contact = ShopContactInfo::find($id);
                if($contact == null)
                    throw new \Exception("Contact record to be updated does not exist");

                $contact->update($data);
                return $contact;
            });
            return new ShopContactInfoResource($record);
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
        $contact = ShopContactInfo::find($id);
        if($contact == null)
            throw new \Exception("Contact record to be deleted does not exist");

        $contact->delete();
        return true;
    }
}