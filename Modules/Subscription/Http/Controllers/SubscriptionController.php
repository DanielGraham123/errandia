<?php

namespace Modules\Subscription\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Shop\Services\ShopService;

use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Entities\Shopsubscription;
use Modules\Utility\Services\UtilityService;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    private $Subscription;
    private $shopService;
    private $Shopsubscription;

    public function __construct(Shopsubscription $Shopsubscription, ShopService $shopService, Subscription $Subscription)
    {
        $this->Subscription = $Subscription;
        $this->shopService = $shopService;
        $this->Shopsubscription = $Shopsubscription;
    }

    public function index()
    {
        $data['subscriptions'] = $this->Subscription->getAllSubscription();
        return view('subscription::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('subscription::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //save data
        $subscriptionDatails = ['name' => $request->input('name'), 'description' => $request->input('description'), 'amount' => $request->input('amount'), 'duration' => $request->input('duration'), 'status' => 1];
        $subscription_id = $this->Subscription->saveSubscription($subscriptionDatails);
        if ($subscription_id) {
            session()->flash('success', trans('admin.subscriptions_add_success_msg'));
            return redirect()->route('subscription');
        }
        return redirect()->back()->withErrors([trans('admin.subscriptions_add_error_msg')]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('subscription::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $subscription = $this->Subscription->findSubscriptionByID($id);
        if (empty($subscription)) {
            return redirect()->route('subscription')
                ->withErrors([trans('admin.category_not_found')]);
        }
        $data['subscription'] = $subscription;

        return view('subscription::edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $subscriptionDatails = ['name' => $request->input('name'), 'description' => $request->input('description'), 'amount' => $request->input('amount'), 'duration' => $request->input('duration')];
        $updateSubscription = $this->Subscription->updateSubscription($id, $subscriptionDatails);
        if ($updateSubscription) {
            return redirect()->route('subscription')
                ->with(['success' => trans('admin.subscriptions_updated_success_msg')]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->Subscription->deleteSubscription($id);
        //redirect to list
        return redirect()->route('subscription')
            ->with(['success' => trans('admin.subscriptions_delete_success_msg')]);
    }

    public function ShopSubscription()
    {
        $data['subscriptions'] = $this->shopService->getShopSubscription();
        return view('subscription::shop-subscription')->with($data);
    }

    public function AddShopSubscription()
    {
        $data['shops'] = $this->shopService->getActiveShops();
        $data['subscriptions'] = $this->Subscription->ShopSubscription();
        return view('subscription::add-shop-subscription')->with($data);
    }

    public function SaveShopSubscription(Request $request)
    {
        $shopId = $request->input('shop_id');
        //check if shop already has an active subscription
        if ($this->shopService->hasActiveSubscriptionShop($shopId)) {
            return redirect()->back()->withErrors([trans('admin.subscriptions_add_exist_error_msg')]);
        }
        $subArr = explode("|", $request->input('subscription_id'));
        $subscription_id = $subArr[0];
        $start_date = date("Y-m-d");
        $end_date = date("Y-m-d", strtotime($start_date . ' + ' . $subArr[1] . ' days'));

        $subscriptionDatails = ['shop_id' => $shopId, 'subscription_id' => $subscription_id, 'start_date' => $start_date, 'end_date' => $end_date];
        $subscription_id = $this->shopService->savePackageSubscription($subscriptionDatails);
        if ($subscription_id) {
            //update shop profile
            $shopStatus = array('status' => 1, 'image_path' => '');
            $this->shopService->updateShopInfo($request->input('shop_id'), $shopStatus);
            //flash success message
            session()->flash('success', trans('admin.subscriptions_add_success_msg'));
            return redirect()->route('shop-subscription');
        }
        return redirect()->back()->withErrors([trans('admin.subscriptions_add_error_msg')]);
    }

    public function blockShopSubscriptionDue(Request $request)
    {
        $shop = $request->get('shop_id');
        $subscription = $request->get('subscriptionId');
        $shopStatus = array('status' => 0, 'image_path' => '');
        $subscriptionStatus = array('end_date'=>Carbon::yesterday());
        $this->shopService->updateShopInfo($shop, $shopStatus);
        $this->shopService->updateShopSubscription($subscription,$subscriptionStatus);
        session()->flash('success', trans('admin.subscriptions_blocked_success_msg'));
        return redirect()->back()->with('success', trans('admin.subscriptions_blocked_success_msg'));
    }

    //manage shop subscribers
    public function showShopSubscribersPage(UtilityService $utilityService)
    {
        $shop_id = $utilityService->getCurrentUserShop()->id;
        $data['subscribers'] = $this->shopService->getShopSubscribers($shop_id);
        return view("subscription::shop_subscribers")->with($data);
    }
}

?>
