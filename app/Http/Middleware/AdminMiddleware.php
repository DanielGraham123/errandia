<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Carbon;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {  

        // dd(auth()->user());
        if(auth('admin')->user() == null){
            auth()->logout();
            session()->flush();
            return redirect(route('login'))->with('error', __('text.permission_denied'));
        }
        return $next($request);
    }
}
