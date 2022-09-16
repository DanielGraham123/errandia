<?php

namespace Modules\GeneralModule\Http\Controllers;

use App\Mail\accountCreated;
use App\Mail\PasswordReset;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\GeneralModule\Config\AccountType;
use Modules\User\Http\Requests\LoginRequest;
use Modules\User\Http\Requests\ResetPasswordRequest;
use Modules\User\Http\Requests\SignUpRequest;
use Modules\User\Services\UserService;
use Modules\Utility\Services\UtilityService;
use Carbon\Carbon;

/*
 * @Author:Dieudonne Dengun
 * @Date: 13/04/2021
 * @Description: manage user authentication, login, register and password reset
 */

class AuthenticationController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /*
     * show login page
     */
    public function showLoginPage(Request $request, UtilityService $utilityService)
    {
        if ($utilityService->hasSessionValue('isLoggedIn')) return redirect()->route('general_home');
        if ($request->has('redirectTo')) $utilityService->addSessionData('redirect', $request->query('redirectTo'));
        return view('generalmodule::authentication.login');
    }

    /**
     * Login user action
     */
    public function login(LoginRequest $request, UtilityService $utilityService)
    {
        $login_dto = $request->getLoginDto();
        //authenticate user
        if (!$this->userService->isValidUsernamePassword($login_dto->email, $login_dto->password)) {
            $request->session()->regenerate();
            return redirect()->back()->withErrors([trans('general.login_invalid_password')]);
        }
        //login user into the system
        $utilityService->addSessionData("isLoggedIn", true);
        //check if user has trying to access an intend route
        if ($utilityService->hasSessionValue('redirect')) {
            $intendedUrl = $utilityService->getSessionDataByKey('redirect');
            $utilityService->forgetSessionByKey('redirect');
            return redirect($intendedUrl);
        }
        //get the authenticated user type
        $user = $utilityService->getCurrentLoggedUser();
        if (AccountType::$IS_CUSTOMER == $user->user_type) {
            //send to customer dashboard
            return redirect()->route('user_profile');
        }
        if (AccountType::$IS_VENDOR == $user->user_type) {
            //send to vendor dashboard
            return redirect()->route('products');
        }
        return redirect()->route('shop_list');
    }

    /**
     * Show register or signup page
     */
    public function showRegisterPage()
    {
        return view('generalmodule::authentication.register');
    }

    /**
     * create user account or register (for general users)
     */
    public function registerUserAccount(SignUpRequest $request, UtilityService $utilityService)
    {
        $create_account_dto = $request->getUserDTO();
        //check email exist
        if ($this->userService->emailExist($create_account_dto['email'])) {
            return redirect()->back()->withInput($request->all())->withErrors([trans('general.register_email_exist_msg')]);
        }
        //save user account details
        $create_account_dto['user_type'] = 1;
        $user_account = $this->userService->saveUserAccount($create_account_dto);
        if ($user_account) {
            //send welcome mail to user
            Mail::to($user_account)->send(new accountCreated($user_account));
            //flash success message and redirect back
            $request->session()->flash('message', trans('general.register_account_success'));
            return redirect("/login")->with('message', trans('general.register_account_success'));
        } else {
            return redirect()->back()->withErrors([trans('general.register_account_error')]);
        }
    }

    /*
     * @Author:Dieudonne Dengun
     */
    public function logout(Request $request, UtilityService $utilityService)
    {
        $utilityService->clearSession();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('general_home');
    }

    public function showPasswordResetPage()
    {
        return view("generalmodule::authentication.forgot_password");
    }

    public function generatePasswordResetLink(Request $request)
    {
        $email = $request->get("email");
        $userEmailExist = $this->userService->findUserByEmail($email);
        //check if user email exist
        if ($userEmailExist->isEmpty()) {
            return redirect()->back()->withInput($request->all())->withErrors([trans('general.reset_password_email_not_exist_msg', ['email' => $email])]);
        }
        //generate a password reset link which has an expired duration
        $userCollection = collect($userEmailExist)->first();
        $userId = $userCollection->id;
        $resetSlug = Str::slug(bcrypt(Str::random(16) . time() . $userId));
        $expiredDate = Carbon::now();
        $expiredDate->addDay();
        $passwordReset = array("user_id" => $userId, "slug" => $resetSlug,
            "expired" => $expiredDate, "created_at" => date("Y-m-d H:i:s"));

        if ($this->userService->saveUserPasswordReset($passwordReset) > 0) {
            Mail::to($userCollection)->send(new PasswordReset($userCollection, $resetSlug));
            $request->session()->flash('message', trans('general.generate_password_reset_success', ['email' => $email]));
            return redirect()->back()->with('message', trans('general.generate_password_reset_success', ['email' => $email]));
        }
        return redirect()->back()->withInput($request->all())->withErrors([trans('general.reset_password_email_failed')]);
    }

    public function showPasswordResetConfirmationPage(Request $request, UtilityService $utilityService)
    {
        //verify if the password slug is active and hasn't expired
        $slug = $request->get("ref");
        $isValidPasswordReset = $this->userService->getPasswordResetDetailsBySlug($slug);
        if (empty($isValidPasswordReset)) {
            return redirect()->route("forgot_password_page")->withErrors([trans('general.reset_password_email_invalid_link')]);
        }
        //check if it has expired
        if (date('Y-m-d H:i:s') > $isValidPasswordReset->expired) {
            return redirect()->route("forgot_password_page")->withErrors([trans('general.reset_password_email_expired_link')]);
        }
        $utilityService->addSessionData("passwordResetUserId", $isValidPasswordReset->user_id);
        return view("generalmodule::authentication.forgot_password_reset")->with('userRequest', $isValidPasswordReset);
    }

    public function resetUserAccountPassword(ResetPasswordRequest $request, UtilityService $utilityService)
    {
        $userId = $utilityService->getSessionDataByKey("passwordResetUserId");
        $userPassword = $request->getPasswordResetDTO();
        if ($this->userService->updateUserAccount($userPassword, $userId)) {
            //flush session reset val
            $utilityService->forgetSessionByKey("passwordResetUserId");
            $request->session()->flash('message', trans('general.generate_password_reset_confirmation_success'));
            return redirect()->route("login_page")->with('message', trans('general.generate_password_reset_confirmation_success'));
        }
    }
}
