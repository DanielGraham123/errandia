<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Controllers\SMS\Helpers as SMSHelpers;
use App\Services\FocusTargetSms;
use App\Models\CampusProgram;
use App\Models\Config as ModelsConfig;
use App\Models\Message;
use App\Models\User;
use App\Models\Wage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/**
 * Summary of Controller
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    var $current_accademic_year;
    public function __construct()
    {
        # code...
        ini_set('max_execution_time', 360);
        ini_set('extension', 'php_fileinfo.so');
    }

    public function set_local(Request $request, $lang)
    {
        # code...
        // return $lang;
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('appLocale', $lang);
            App::setLocale($lang);
        }
        return back();
    }


    public function reset_password(Request $request, $id= null)
    {
        # code...
        $data['title'] = "Reset Password";
        return view('admin.reset_password', $data);
        // if (auth()->user()->type == 'admin') {
        // }
    
    }

    public function reset_password_save(Request $request)
    {
        # code...
        $validator = Validator::make($request->all(), [
            'current_password'=>'required',
            'new_password_confirmation'=>'required_with:new_password|same:new_password|min:6',
            'new_password'=>'required|min:6',
        ]);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->first());
        }
        
        if(Hash::check($request->current_password, auth()->user()->getAuthPassword())){
            $user = User::find(auth()->id());
            $user->password = Hash::make($request->new_password);
            $user->password_reset = true;
            $user->save();
            auth()->login($user);
            return back()->with('success', 'Done');
        }else{
            return back()->with('error', 'Operation failed. Make sure you entered the correct password');
        }
        
    }

    public function region_towns($region_id){
        $region = \App\Models\Region::find($region_id);
        if($region != null){
            $towns = $region->towns()->orderBy('name')->get();
            return response()->json(['data'=>$towns->toArray()]);
        }
    }

    public function town_streets($town_id){
        $town = \App\Models\Town::find($town_id);
        if($town != null){
            $streets = $town->streets()->orderBy('name')->get();
            return response()->json(['data'=>$streets->toArray()]);
        }
    }

    public function privacy_policy($slug){
        $data['title'] = "Software Policies";
       $data['policy'] = \App\Models\PrivacyPolicy::whereSlug($slug)->first();
        return view('public.policies', $data);
    }

}
