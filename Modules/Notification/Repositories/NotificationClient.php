<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 2/10/2021
 * Time: 11:11 PM
 */

namespace Modules\Notification\Repositories;


use Illuminate\Support\Facades\Notification;

class NotificationClient
{
    public function sendEmailNotification($notification, $receiver)
    {
        Notification::send($receiver, $notification);
    }

    public function sendSMSNotification($notification, $receiver)
    {

    }
}