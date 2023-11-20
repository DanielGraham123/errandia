<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Guardian;
use App\Models\User;
// use Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use \Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:2'
        ]);
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
        session()->flush();
        return redirect(route('login'));
    }

    public function register(){
        return view('auth.register');
    }

    public function signup(Request $request){
        $validator = Validator::make($request->all(), ['name'=>'required', 'phone'=>'required', 'email'=>'required|email', 'confirm_password'=>'required|min:6', 'password'=>'required|same:confirm_password']);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->first())->withInput();
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
}
