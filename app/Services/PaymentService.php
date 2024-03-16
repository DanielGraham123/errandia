<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PaymentService{
    private string $api_key;
    private string $api_id;
    private $token;
    private string $return_url;
    private string $api_payment_base_url;

    public function __construct(){
        $this->api_payment_base_url =
            env('API_PAYMENT_MODE', 'sandbox') == 'sandbox' ?
            env('API_PAYMENT_BASE_URL', 'https://sandbox.dsapi.tranzak.me') :
            env('API_PAYMENT_PROD_BASE_URL', 'https://dsapi.tranzak.me');

        $this->api_id = env('API_PAYMENT_API_ID', null);
        $this->api_key = env('API_PAYMENT_API_KEY', null);
        $this->return_url = env('APP_URL'). '/api/payments/return';
    }

    private function getToken(): void
    {
        $params = ['appId' =>  $this->api_id, 'appKey' => $this->api_key];
        $response = Http::asJson()
            ->post($this->api_payment_base_url . '/auth/token', $params);

        if (!$response['success']) {
          logger()->error('Api payment failed to get Token');
          $this->token = null;
        } else{

            $this->token = $response['data']['token'];
        }
    }

    public function makePaymentRequest($phone_number, $amount, $payment_ref, $description)
    {
        $this->getToken();
        $params = [
            'amount' => $amount,
            'currencyCode' => 'XAF',
            'description' => $description,
            'mchTransactionRef' => $payment_ref,
            'mobileWalletNumber' => $phone_number,
            'returnUrl' => $this->return_url,
        ];

        if ($this->token == null) {
            return null;
        }

        $response =  Http::asJson()
            ->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->post($this->api_payment_base_url . '/xp021/v1/request/create-mobile-wallet-charge', $params);

        if (!$response['success']) {
            logger()->error("api payment error message : " . $response['errorMsg']);
            return  null;
        }
        return $response['data'];
    }

    public function getPaymentDetails($request_id)
    {
        $this->getToken();
        if ($this->token == null) {
            return null;
        }

        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->get($this->api_payment_base_url . '/xp021/v1/request/details?requestId='. $request_id);

        if (empty($response['success']) ||  !$response['success']) {
            logger()->error("api payment error message : " . $response['errorMsg']);
            return  null;
        }

        return $response['data'];
    }

}