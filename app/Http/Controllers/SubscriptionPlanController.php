<?php

namespace App\Http\Controllers;

use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{

    protected $subscriptionService;


    public function __construct(SubscriptionService $subscriptionService)
    {
        # code...
        $this->subscriptionService = $subscriptionService;
    }
    //

    
}
