<?php
namespace App\Repositories;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;

class UserRepository {

    /**
     * get all products
     * @param int $size: nullable, specify the number of records to take
     */
    public function get($size = null)
    {
        # code...
        $users = $size == null ?
            User::orderBy('name')->get() :
            User::orderBy('name')->take($size)->get();

        return UserResource::collection($users);
    }


    /**
     * get a product or service by slug
     */
    public function getById($id)
    {
        # read the record associated to a given slug
        $user  = User::find($id);
        if($user == null)
            throw new \Exception("User record does not exist");

        return new UserResource($user);
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
                $user = new User($data);
                $user->save();
                return $user;
            });
            return new UserResource($record);
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
                $user = User::find($id);
                if($user ==  null)
                    throw new \Exception("User record to update does not exist");

                $user->update($data);
                return $user;
            });
            return new UserResource($record);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateProfile($user_id, $data)
    {
        # code...
        if(empty($data)){
            throw new \Exception("Empty profile update data");
        }
        $userProfile = UserProfile::where('user_id', $user_id)->first();
        if($userProfile == null){
            $data['user_id'] = $user_id;
            $userProfile = new UserProfile($data);
            $userProfile->save();
        }else{
            $userProfile->update($data);
        }
        return $userProfile;
    }


    /**
     * update a record in database
     */
    public function delete($id)
    {
        # code...
        // validate data and save to database
        $user = User::find($id);
        if($user == null)
            throw new \Exception("User record does not exist");

        $user->delete();
        return true;
    }
}