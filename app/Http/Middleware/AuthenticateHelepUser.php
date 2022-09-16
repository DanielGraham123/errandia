<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Modules\Utility\Services\UtilityService;

class AuthenticateHelepUser
{
    private $authGuard;
    private $utilityService;

    public function __construct(Guard $guard, UtilityService $utilityService)
    {
        $this->authGuard = $guard;
        $this->utilityService = $utilityService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $userType, $optionType = 100, $otherUserType = 50)
    {

        $intendUrl = $request->fullUrl();
        //check if user is authenticated
        if (!$this->authGuard->check()) {
            return redirect()
                ->route('login_page', ['redirectTo' => $intendUrl])
                ->withErrors([trans('general.unauthorized_access_msg')]);;
        } else {
            //check if user has the privilege to access url
            if ($this->utilityService->getCurrentLoggedUser()->user_type != intval($userType)) {
                if ($optionType != 100 && ($this->utilityService->getCurrentLoggedUser()->user_type == intval($optionType))) {
                } else {
                    if ($otherUserType != 50 && ($this->utilityService->getCurrentLoggedUser()->user_type == intval($otherUserType))) {

                    } else {
                        return redirect()
                            ->route('login_page', ['redirectTo' => $intendUrl])
                            ->withErrors([trans('general.unauthorized_access_msg')]);
                    }
                }
            }
        }
        return $next($request);
    }
}
