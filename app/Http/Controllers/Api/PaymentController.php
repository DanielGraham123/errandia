<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private SubscriptionService $subscriptionService;

    private string $auth_key = '(,%-vp.lPmL7&UgmKoIx>FO}xgrY<^d96eK';

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function return(Request $request)
    {
        $data = $request->all();
        $this->subscriptionService->update_payment($data);
        logger()->info(json_encode($data));
        return $this->build_success_response(response(), 'payment details received');
    }

}