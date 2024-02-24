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
    public $validations_errors = [];

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

    /**
     * @param $inputs
     * @param $rules
     * @return void
     */

    public function validate($inputs = [], $rules = [])
    {
        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            $this->validations_errors = $validator->errors();
        }
    }

    public function build_response($response, $message = '', $code  = 200, $data = [])
    {
        return
            $response->json(
                [
                    'message' => $message,
                    'data'    => empty($this->validations_errors) ? $data : $this->validations_errors,
                ],
                $code
            );
    }

    public function build_error_response($exceptionMsg, $message, $code): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => [
            'error' => $exceptionMsg,
            'message' => $message
        ]], $code);
    }

    public function build_success_response($response, $message = '', $data = [])
    {
        return
            $response->json(
                [
                    'message' => $message,
                    'data'    => empty($this->validations_errors) ? $data : $this->validations_errors,
                ],
                200
            );
    }

    public static function convert_paginated_result($result, $items)
    {
        return [
            "current_page" => $result->currentPage(),
            "per_page" => $result->perPage(),
            "total" => $result->total(),
            "items" => $items
        ];
    }

    // check if owner of the resource
    public function is_owner($resource, $authenticatedUser): bool
    {
        if ($resource->user_id !== $authenticatedUser->id) {
            return false;
        }
        return true;
    }

}
