<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Vonage\SMS\Message\SMS;


class SMSController extends Controller
{
    public function sms_bundles()
    {
        $data['title'] = "SMS";
        $data['sms'] = SMS::orderBy('id', 'DESC')->get();
        return view('admin.sms.index', $data);
    }
}