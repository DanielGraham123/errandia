<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Guardian;
use App\Models\Students;
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
            return redirect()->route('admin.home')->with('success','Welcome to Admin Dashboard '.Auth::user()->name);
        }
        
        // return "Spot 3";
        $request->session()->flash('error', 'Invalid Username or Password');
        return redirect()->route('login')->withInput($request->only('username','remember'));
    }

    public function logout(Request $request){
        Auth::logout();
        Auth::guard('student')->logout();
        Auth::guard('parents')->logout();
        return redirect(route('login'));
    }

}
