<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;

class AuthController extends Controller
{

    protected $userService;

    public function __construct(UserService  $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        $this->validate($request->all(), [
            'identifier' => 'required',
        ]);

        if(!empty($this->validations_errors)) {
            return $this->build_response(response(), 'Error found when verifying the phone number', 400);
        }

        $result = $this->userService->findAndSendOTP($request->get('identifier'));
        if ($result) {
            $user = $result['user'];
            $channel = $result['channel'];
            return $this->build_response(
                response(), 'A token has been sent to your ' . ( $user->phone == $channel ? 'phone number' : 'email address' ), 200,
                [
                    'uuid' => $result['uuid']
                ]
            );

        } else {
            return $this->build_response(response(), "Phone does not exist", 400);
        }
    }

    public function validateOtpCode(Request $request)
    {
        $this->validate($request->all(), [
            'code' => 'required',
            'uuid' => 'required',
        ]);

        if(!empty($this->validations_errors)) {
            return $this->build_response(response(), 'code is not correct', 400);
        }

        $user = $this->userService->checkOTP($request->get('uuid'), $request->get('code'));
        if ($user) {
            return $this->build_response(
                response(), 'otp ok', 200,
                [
                    'token' => $user->createToken('token')->accessToken,
                    'user' => new UserResource($user),
                ]
            );
        } else {
            return $this->build_response(response(), "code not valid or expired", 400);
        }
    }

    public function loginWithEmail(Request $request)
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
    
    public function signup(Request $request)
    {        
        $rules = [
            'name' => ['required', 'string', 'max:200', 'min:3'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'phone' => ['required', 'unique:users,phone']
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

                if ($request->file('profile')) {
                    $user->photo = $request->file('profile')->store('users');
                } 
                $user->save();
                return $user;
            });

            return  $this->build_response(
                response(), 'Account created'
            );

        } catch(\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), 'Registration failed : '. $e->getMessage(), 400);
        }
    }

    public function forgetPassword(Request $request)
    {
        return $this->build_response(response(), 'not yet implement. :)', 200);
    }

    public function validateFpCode(Request $request)
    {
        return $this->build_response(response(), 'not yet implement. :)', 200);
    }

    public function resetPassword(Request $request)
    {
        return $this->build_response(response(), 'not yet implement. :)', 200);
    }

    public function verifyToken(Request $request)
    {
        if(Auth::guard('api')->check()) {
            return $this->build_success_response(
                response(),
                'token is valid'
            );
        } else {
            return $this->build_response(
                response(),
                'token expired',
                403
            );
        }
    }

    public function refreshToken(Request $request)
    {
        if(Auth::guard('api')->check()) {
            return $this->build_success_response(
                response(),
                'token is valid'
            );
        } else {
            return $this->build_response(
                response(),
                'token expired',
                403
            );
        }
    }

    public function logout(Request $request)
    {
        $token_id = $request->user()->token()->id;
        $tokenRepository = app(TokenRepository::class);
        $refreshTokenRepository = app(RefreshTokenRepository::class);
        $tokenRepository->revokeAccessToken($token_id);
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($token_id);

        logger()->info('user successfully logged out');
        return $this->build_success_response(
            response(),
            'session closed'
        );
    }
}
