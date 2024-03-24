<?php

namespace App\Notifications;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;

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
        $fcmNotification = FcmNotification::create();
        $fcmNotification->setBody($this->body);
        $fcmNotification->setTitle ($this->title);
        $fcmNotification->setImage('https://errandia.com/assets/images/app-logo.png');
        $message->setNotification($fcmNotification);

        return  $message;
    }

}