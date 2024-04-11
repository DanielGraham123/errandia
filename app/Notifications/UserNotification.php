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
    private string $page;
    public function __construct(string $title, string $body, $page = 'subscription')
    {
        $this->title = $title;
        $this->body = $body;
        $this->page = $page;
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
        // $androidNotification->setIcon('https://errandia.com/assets/images/app-logo.png');
        $androidNotification->setSound('alert');
        $androidNotification->setChannelId('errandia_channel_id');
        $androidNotification->setClickAction('FLUTTER_NOTIFICATION_CLICK');
        $androidConfig->setNotification($androidNotification);
        $androidConfig->setData(
            [
                'page' => $this->page,
                'image' => 'https://errandia.com/assets/images/app-logo.png'
            ]
        );
        $message->setAndroid($androidConfig);
        return  $message;
    }

}