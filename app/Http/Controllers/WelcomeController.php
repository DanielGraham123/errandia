<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class WelcomeController extends Controller
{
    public function home()
    {
        return view("public.home");
    }

}
