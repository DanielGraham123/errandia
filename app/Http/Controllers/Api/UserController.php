<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected 
        $userService;

    public function __construct(UserService $userService)
    {
        # code...
        $this->userService = $userService;
    }

    //
    public function update(Request $request)
    {
        # code...
        $user = $request->user('api');
        // $user = User::find($request->user_id);
        $data = $request->all();
        $update = $this->userService->update($user->id, $data);
        return response(['status'=>"SUCCESS", 'message'=>'DONE', 'data'=>$update]);
    }

    public function updateProfileImage(Request $request)
    {
        # code...
        try {
            $user = $request->user('api');
            // $user = User::find($request->user_id);
            $file = $request->file('image');
            $photo = $this->userService->updateProfileImage($user->id, $file);
            return response(['url'=>$photo]);
        } catch (\Throwable $th) {
            return response(['message'=>$th->getMessage()], 500);
        }
    }
}
