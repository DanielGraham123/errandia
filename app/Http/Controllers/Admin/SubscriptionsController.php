<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Errand;
use App\Models\ShopSubscription;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionsController extends Controller
{
    public function index(Request $reuest)
    {
        $data['title'] = "All Subscription Plans";
        $data['plans'] = Subscription::all();
        return view('admin.subscriptions.index', $data);
    }

    public function create_subscription_plan (Request $reuest)
    {
        # code...
        $data['title'] = "Add New Subscription Plan";
        return view('admin.subscriptions.create', $data);
    }

    public function save_subscription_plan (Request $request)
    {
        # code...
        // dd($request->all());

        $validity = Validator::make($request->all(), ['name'=>'required', 'amount'=>'required|numeric', 'duration'=>'required']);
        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }

        $data = ['name'=>$request->name, 'amount'=>$request->amount, 'duration'=>$request->duration, 'currency'=>$request->currency??'XAF', 'description'=>$request->description??''];
        if(Subscription::where(['name'=>$request->name, 'amount'=>$request->amoun, 'duration'=>$request->duration])->count() > 0){
            session()->flash('error', 'Plan already exist');
            return back()->withInput();
        }

        $instance = new Subscription($data);
        $instance->save();

        return redirect()->route('admin.plans.index');
    }

    public function edit_subscription_plan (Request $request, $slug)
    {
        # code...
        $data['title'] = "Edit Subscription Plan";
        $data['plan'] = Subscription::whereSlug($slug)->first();
        return view('admin.subscriptions.edit', $data);
    }

    public function subscription_report (Request $request)
    {
        # code...
        $data['title'] = "All Subscriptions";
        $data['subscriptions'] = ShopSubscription::all();
        return view('admin.reports.subscriptions', $data);
    }
}