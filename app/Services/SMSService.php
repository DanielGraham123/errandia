<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SMSService {

    private $senderId;
    private $phone_number;
    private $user_name;
    private $password;
    private $message;
    public function __construct()
    {
        $this->senderId = 'ERRANDIA';
        $this->user_name = 'nishang@gmail.com';
        $this->password = 'test2371';
    }

    public function send($phone_number, $message)
    {
        $this->phone_number = $phone_number;
        $this->message = $message;
        return $this->makeApiCall();
    }



    private function makeApiCall()
    {
        $sent = false;
        $params = [
            'user='. $this->user_name,
            'password='.$this->password,
            'senderid='.$this->senderId,
            'sms='. $this->message,
            'mobiles='. $this->phone_number,
        ];

       $response = Http::withHeaders(
           ['Content-Type' => 'application/json']
       )->get(
           'https://smsvas.com/bulk/public/index.php/api/v1/sendsms?'
           . implode( '&', $params)
       );

       if ($response && $response['responsedescription'] == 'error') {
           logger()->error($response['responsemessage']);
       }
       else {
           $sent = true;
           logger()->info($response['responsemessage']);
       }
       return $sent;
    }

}