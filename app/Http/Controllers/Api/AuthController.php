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
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
class AuthController extends Controller
{
    public function verifyPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            return response()->json([
                'data' => [
                    'phone' => $request->phone,
                    'name' => $user->name ?? ''
                ],
                'message' => 'Phone number exist']);
        } else {
            return response()->json(['message' => "No account exists with this phone number"], 400);
        }
    }

    public function phoneLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            $token = $user->createToken('token')->accessToken;
            return response()->json(['data' => [
                'token' => $token,
                'user' => new UserResource($user),
            ]]);
        } else {
            return response()->json(['message' => "Invalid phone number"], 400);
        }
    }

    public function emailLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('token')->accessToken;
            return response()->json(['data' => [
                'token' => $token,
                'user' => new UserResource($user),
            ]]);
        } else {
            return response()->json(['message' => "Invalid email or password"], 400);
        }
    }
    
    public function register(Request $request)
    {        
        $rules = [
            'name' => ['required', 'string', 'max:200', 'min:3'],
            'email' => ['nullable', 'string', 'email', 'unique:users,email'],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required','string', 'min:10', 'max:15', 
                Password::min(8)
                ->letters()  // Ensure at least one letter
                ->mixedCase()   // Ensure at least one uppercase and one lowercase letter
                ->numbers()  // Ensure at least one number
                ->symbols("~`!@#$%^&*()_-+={[}]|\:;'<,>.?/")  // Ensure only allowed special characters
                ->uncompromised()
            ],
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        try {
            $user = DB::transaction(function () use ($request) {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email ?? '';
                $user->phone = $request->phone;
                $user->password = Hash::make($request->password);
                $user->address = $request->address ?? '';
                if ($request->street_id) {
                    $user->street_id = $request->street_id;
                }
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
            return response()->json(['error' => $e->getMessage(), 'message' => "Sorry, We encountered an error."], 400);
        }
    }
}
