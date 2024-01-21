<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{

    protected $userService;

    public function __construct(UserService  $userService)
    {
        $this->userService = $userService;
    }

    public function verifyPhone(Request $request)
    {
        $this->validate($request->all(), [
            'phone' => 'required',
        ]);

        if(!empty($this->validations_errors)) {
            return $this->build_response(response(), 'Error found when verifying the phone number', 400);
        }

        $user = $this->userService->findAndSendOTP($request->phone);
        if ($user) {
            return $this->build_response(
                response(), 'A token has been sent to your phone number', 200,
                [
                    'uuid' => $user->uuid
                ]
            );

        } else {
            return $this->build_response(response(), "we can not identify", 400);
        }
    }

    public function phoneLogin(Request $request)
    {
        $this->validate($request->all(), [
            'phone' => 'required',
        ]);

        if(!empty($this->validations_errors)) {
            return $this->build_response(response(), 'Invalid phone number', 400);
        }

        $user = User::where('phone', $request->phone)->first();

        if ($user) {
            return $this->build_response(
                response(), 'user found', 200,
                [
                    'token' => $user->createToken('token')->accessToken,
                    'user' => new UserResource($user),
                ]
            );

        } else {
            return $this->build_response(response(), "Invalid phone number", 400);
        }
    }

    public function verifyLoginOTP(Request $request)
    {
        $this->validate($request->all(), [
            'otp_code' => 'required',
            'uuid' => 'required',
        ]);

        if(!empty($this->validations_errors)) {
            return $this->build_response(response(), 'code is not correct', 400);
        }
    }

    public function emailLogin(Request $request)
    {
        $this->validate($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if(!empty($this->validations_errors)) {
            return $this->build_response(response(), "Invalid email or password", 400);
        }

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return $this->build_response(
                response(), 'user found', 200,
                [
                    'token' => $user->createToken('token')->accessToken,
                    'user' => new UserResource($user),
                ]
            );


        } else {
            return $this->build_response(response(), "Invalid email or password", 400);
        }
    }
    
    public function register(Request $request)
    {        
        $rules = [
            'name' => ['required', 'string', 'max:200', 'min:3'],
            'email' => ['nullable', 'string', 'email', 'unique:users,email'],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required','string', 'same:confirm_password', 'min:10', 'max:15',
                Password::min(8)
                ->letters()  // Ensure at least one letter
                ->mixedCase()   // Ensure at least one uppercase and one lowercase letter
                ->numbers()  // Ensure at least one number
                ->symbols("~`!@#$%^&*()_-+={[}]|\:;'<,>.?/")  // Ensure only allowed special characters
                ->uncompromised()
            ]
        ];

        $this->validate($request->all(), $rules);

        if(!empty($this->validations_errors)) {
            return $this->build_response(response(), 'Registration failed', 400);
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

            return  $this->build_response(
                response(), 'Account created', 200,
                [
                    'token' => $user->createToken('token')->accessToken,
                    'user' => new UserResource($user),
                ]
            );

        } catch(\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), 'Registration failed : '. $e->getMessage(), 400);
        }
    }
}
