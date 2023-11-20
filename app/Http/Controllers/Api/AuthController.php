<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['data' => [
                'message' => $validator->errors()->first()
            ]], 401);
        }

        $user = User::where(['phone' => $request->phone, 'password' => Hash::make($request->password)])->first();
        if(!$user) {
            return response()->json(['data' => [
                'message' => "Invalid credentials"
            ]], 401);
        }
        $token = $user->createToken('token')->accessToken;
        return response()->json(['data' => [
            'token' => $token,
            'user' => new UserResource($user),
        ]]);
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'email' => 'nullable|string|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|string|min:6'
        ]);

        $validator->after(function ($validator) use ($request) {
            if (empty($request->street_id)) {
                $validator->errors()->add(
                    'street_id', 'Please select a street'
                );
            }
        });

        if($validator->fails()) {
            return response()->json(['data' => [
                'message' => $validator->errors()->first()
            ]], 401);
        }

        try {
            $user = DB::transaction(function () use ($request) {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->password = Hash::make($request->password);
                $user->address = $request->address ?? '';
                $user->street_id = $request->street_id;
                if ($request->file('profile')) {
                    $user->photo = $request->file('profile')->store('users');
                } 
                $user->save();
                return $user;
            });
            $token = $user->createToken('token')->accessToken;
            return response()->json(['data' => [
                'token' => $token,
                'user' => new UserResource($user),
            ]]);
        } catch(\Exception $e) {
            return response()->json(['data' => [
                'message' => $e->getMessage()
            ]], 500);
        }
    }
}
