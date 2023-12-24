<?php

namespace App\Http\Controllers\Auth;
use App\Mail\PasswordResetConfirmation;
use Carbon\Carbon;
use \Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\ResetEmail;
use Illuminate\Support\Facades\Mail;
class CustomForgotPasswordController extends Controller
{

    public function forgotPassword(Request $request)
    {
        return view('auth.forgot_password');
    }

    public function sendPasswordResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request['email'])->first();
        if(!$user){
            return redirect()->back()->with('error','User does not exist with this email')->withInput();
        }
        $token = Str::random(70);
        $link = route('show_reset_password',["token" => $token]);
        $data['link'] = $link;
        $data['email'] = $request['email'];
        try {
            Mail::to($request['email'])->send(new ResetEmail($data));
        }catch (\Exception $exception){
            return redirect()->back()->with('error','Could not send password reset link. Please try again.');
        }
        DB::table('password_resets')->insert([
            'email'     => $request['email'],
            'token'     => $token,
            'created_at' => Carbon::now(),
            'expire_at' => Carbon::now()->addMinutes(15)
        ]);
        return redirect()->back()->with('success', 'Password Reset Link has been sent to your email address.');
    }

    public function showResetPassword(Request $request)
    {
        $savePasswordReset = DB::table('password_resets')->where('token', $request['token'])->first();
        if (!isset($savePasswordReset)){
            return view('404')->with("error", "Invalid request link");
        }
        $data['token'] = $request['token'];
        $data['email'] =  $savePasswordReset->email;
        return view('auth.passwords.reset')->with($data);
    }

    public function resetPassword(Request $request)
    {
        $token = $request['token'];
        $validator = Validator::make($request->all(), [
            'token'     => 'required',
            'password'  => 'required|confirmed|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/'
        ]);
        if ($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $savedPasswordRest = DB::table('password_resets')->where('token', $request['token'])->first();
            if(isset($savedPasswordRest)){
                if (Carbon::now()->greaterThan($savedPasswordRest->expire_at)){
                    return \redirect()->route('login')->with('error', 'Password Reset link has expired');
                }
            }else{
                return \redirect()->route('login')->with('error', 'Invalid Password Reset link');
            }
            $user = User::where('email', $savedPasswordRest->email)->first();
            if (!isset($user)){
                return \redirect()->back()->with('error', 'User does not exist with this email address');
            }
            $user->password = \Illuminate\Support\Facades\Hash::make($request['password']);
            $user->save();
            DB::table('password_resets')->where('token', $token)->delete();
            try {
                $data['email'] = $savedPasswordRest->email;
                Mail::to($savedPasswordRest->email)->send(new PasswordResetConfirmation($data));
            }catch (\Exception $exception){
                return  \redirect()->route('login')->with('error', 'Could not send password reset confirmation email');
            }
            return \redirect()->route('login')->with("success", "Password reset successful. Please login");
        }

    }

}
