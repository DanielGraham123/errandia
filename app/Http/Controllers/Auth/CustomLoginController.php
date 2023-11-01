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
            if(auth()->user()->type == 'admin'){
                return redirect()->route('admin.home')->with('success','Welcome to Admin Dashboard '.Auth::user()->name);
            }
            if(auth()->user()->type == '2'){
                return redirect()->route('business_admin.home')->with('success','Welcome to Business Admin Dashboard '.Auth::user()->name);
            }
            if(auth()->user()->type == 'customer'){
                // return redirect()->route('customer.home')->with('success','Welcome to Customer Dashboard '.Auth::user()->name);
            }
            auth()->logout();
            session()->flush();
            return redirect()->route('login');
        }elseif(auth('manager')->attempt(['email'=>$request->username,'password'=>$request->password])){
            return redirect()->route('manager.home')->with('success','Welcome to Manager\'s Dashboard '.auth('manager')->user()->name);
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
        $validator = Validator::make($request->all(), []);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->first())->withInput();
        }
        $user = new User($request->all());
        $user->save();
        return view('auth.register');
    }
}
