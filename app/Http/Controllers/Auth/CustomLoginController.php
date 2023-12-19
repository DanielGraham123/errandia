<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class CustomLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:web', ['except'=>['logout']]);
    }

    public function showLoginForm(){
        // session()->flush();
        return view('auth.login');
    }
    


    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }
        session()->flush();

        if( Auth::attempt(['email'=>$request->username,'password'=>$request->password])){
            return redirect()->route('business_admin.home')->with('success','Welcome to Business Admin Dashboard '.Auth::user()->name);
        }elseif(auth('admin')->attempt(['email'=>$request->username,'password'=>$request->password])){
            return redirect()->route('admin.home')->with('success','Welcome to Admin Dashboard '.auth('admin')->user()->name);
        }
        
        // return "Spot 3";
        $request->session()->flash('error', 'Invalid Username or Password');
        return redirect()->route('login')->withInput($request->only('username','remember'));
    }

    public function logout(Request $request){
        Auth::logout();
        Auth::guard('admin')->logout();
        session()->flush();
        return redirect(route('login'));
    }

    public function register(){
        return view('auth.register');
    }

    public function signup(Request $request){
        $validator = Validator::make($request->all(), ['name'=>'required', 'phone'=>'required|unique:users,phone',
            'email'=>'required|email|unique:users,email', 'password'=>'required|confirmed|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/']);
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $data = ['name'=>$request->name, 'email'=>$request->email, 'phone'=>$request->phone, 'password'=>\Hash::make($request->password)];
        $user = new User($data);
        $user->save();

        // Auth::login();
        // auto log user in aftrer user registration
        if( Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect(route('business_admin.home'));
        }
        return redirect(route('login'))->with('success', 'Your account successfully created.');
    }

    public function googleSignRedirect(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();
        $existUser = User::where('google_id', $user->getId())->first();
        if($existUser){
            Auth::login($existUser);
            return redirect()->route('business_admin.home')->with('success','Welcome to Business Admin Dashboard '.$existUser->name);
        }else {
            $newUser = User::create([
                'name'      => $user->getName(),
                'email'     => $user->getEmail(),
                'google_id' => $user->getId(),
                'active'    => true,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make($user->getName())
            ]);
            Auth::login($newUser);

            return redirect()->route('business_admin.home')->with('success','Welcome to Business Admin Dashboard '.$newUser->name);
        }
    }
}
