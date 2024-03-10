<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
            self::convert_paginated_result($result, $result->items())
        );
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        return $this->build_success_response(response(), 'subscription request sent', []);
    }

    public function show(Request $request)
    {
        $user = auth('api')->user();
        $subscription = $this->subscriptionService->get_current($user->id);
        return $this->build_success_response(response(), 'subscription loaded', ['item' => $subscription?? []]);
    }
}