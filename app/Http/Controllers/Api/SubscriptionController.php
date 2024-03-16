<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriptionResource;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected SubscriptionService $subscriptionService;
    public  function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function index(Request $request)
    {
        $user = auth('api')->user();
        $result = $this->subscriptionService->find_all_by_user($user->id);
        return $this->build_success_response(
            response(),
            'subscriptions loaded',
            self::convert_paginated_result($result, SubscriptionResource::collection($result->items()))
        );
    }

    public function store(Request $request)
    {
        $rules = [
            'plan_id' => 'required',
            'phone_number' => 'required',
        ];
        $data = $request->all();
        $this->validate($data, $rules);
        if(!empty($this->validations_errors)) {
            return $this->build_response(response(), 'failed to create business', 400);
        }

        $user = auth('api')->user();
        try {
            $this->subscriptionService->subscribe($user->id, $data);
            return $this->build_success_response(response(), 'subscription request sent', []);
        } catch (\Exception $e) {
            logger()->error("subscription error : ". $e->getMessage());
            return  $this->build_response(response(), $e->getMessage(), 400);
        }
    }

    public function show(Request $request)
    {
        $user = auth('api')->user();
        $subscription = $this->subscriptionService->get_current($user->id);
        return $this->build_success_response(response(), 'subscription loaded', ['item' => $subscription?? []]);
    }

    public function checkStatus(Request $request, $id)
    {
        try {
            $subscription =  $this->subscriptionService->check_status($id);
            return $this->build_success_response(response(), 'subscription info loaded', [
                'item' => new SubscriptionResource($subscription)
            ]);
        } catch (\Exception $e) {
            logger()->error('Error when checking subscription status : '. $e->getMessage());
            return $this->build_response(response(), $e->getMessage(), 400);
        }
    }
}