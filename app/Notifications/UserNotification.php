<?php

namespace App\Notifications;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidNotification;

class UserNotification extends Notification
{
    private string $title;
    private string $body;
    public function __construct(string $title, string $body)
    {
        $this->title = $title;
        $this->body = $body;
    }

    public function via($notifiable): array
    {
        return [FcmChannel::class];
    }

    public function toFcm($notifiable): FcmMessage
    {
        $message = FcmMessage::create();
        $androidConfig = AndroidConfig::create();
        $androidNotification = AndroidNotification::create();
        $androidNotification->setTitle($this->title);
        $androidNotification->setBody($this->body);
        $androidNotification->setIcon('https://errandia.com/assets/images/app-logo.png');
        $androidConfig->setNotification($androidNotification);
        $message->setAndroid($androidConfig);
        return  $message;
    }

}