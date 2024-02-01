<?php

namespace App\Http\Controllers\BAdmin;

use App\Http\Controllers\Controller;
use App\Services\ShopService;
use App\Services\ShopSubscriptionService;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{

    protected 
        $shopSubscriptionService,
        $subscriptionService,
        $shopService;
    //
    public function __construct(
        ShopSubscriptionService $shopSubscriptionService, SubscriptionService $subscriptionService, ShopService $shopService
    )
    {
        # code...
        $this->shopSubscriptionService = $shopSubscriptionService;
        $this->subscriptionService = $subscriptionService;
        $this->shopService = $shopService;
    }
    
    public function subscriptions()
    {
        # code...
        $data['title'] = "My Subscriptions";
        $data['shops'] = auth()->user()->shops;
        $data['plans'] = $this->subscriptionService->getAll();
        $data['subscriptions'] = $this->shopSubscriptionService->userSubscriptions(auth()->id());
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

        try {
            //code...
            $plan = $this->subscriptionService->getById($request->subscription_id);
            $instance = $this->shopSubscriptionService->save(['shop_id'=>$request->shop_id, 'subscription_id'=>$request->subscription_id, 'subscription_date'=>now(), 'expiration_date'=>now()->addDays($plan->duration??0)]);
        } catch (\Throwable $th) {
            //throw $th;
            session()->flash('error', $th->getMessage());
            return back()->withInput();
        }
        // Create a pending subscription

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
