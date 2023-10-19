<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class WelcomeController extends Controller
{
    public function home()
    {
        if(Auth::user()?Auth::user()->type == 'teacher':false){
            return redirect()->route('user.home');
            }elseif(Auth::user()?Auth::user()->type == 'admin':false){
            return redirect()->route('admin.home');
        }
        return redirect()->to(route('login'));
    }

}
