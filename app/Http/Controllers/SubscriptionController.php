<?php

namespace App\Http\Controllers;

use App\Services\ShopSubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    //
    public function __construct(ShopSubscriptionService $shopSubscriptionService)
    {
        # code...
    }
    
    public function subscriptions()
    {
        # code...
        $data['title'] = "My Subscriptions";
        $data['shops'] = auth()->user()->shops;
        $data['plans'] = \App\Models\Subscription::all();
        $data['subscriptions'] = \App\Models\ShopSubscription::whereIn('shop_id', auth()->user()->shops()->pluck('id')->toArray())->orderBy('subscription_date', 'DESC')->get();
        return view('b_admin.subscriptions.index', $data);

    }
    
    public function save(Request $request)
    {
        # code...
        $validity = Validator::make($request->all(), ['shop_id'=>'required', 'payment_method'=>'required', 'subscription_id'=>'required', 'account_number'=>'required']);

        if($validity->fails()){
            session()->flash('error', $validity->errors()->first());
            return back()->withInput();
        }

        // Create a pending subscription
        $plan = \App\Models\Subscription::find($request->subscription_id);
        $instance = new \App\Models\ShopSubscription(['shop_id'=>$request->shop_id, 'subscription_id'=>$request->subscription_id, 'subscription_date'=>now(), 'expiration_date'=>now()->addDays($plan->duration??0)]);
        $instance->save();

        // Make payment and update subscription record

        return back();
    }

    public function update(Request $request, $id)
    {
        # code...
    }

    public function renew(Request $request, $id)
    {
        # code...
    }

    public function delete(Request $request, $id)
    {
        # code...
    }
}
