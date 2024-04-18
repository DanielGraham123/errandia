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
    private array $data_to_send;
    public function __construct(string $title, string $body, $page = 'subscription', $data_to_send = array())
    {
        $this->title = $title;
        $this->body = $body;
        $this->page = $page;
        $this->data_to_send = $data_to_send;
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
        $androidNotification->setSound('alert');
        $androidNotification->setChannelId('errandia_channel_id');
        $androidNotification->setClickAction('FLUTTER_NOTIFICATION_CLICK');
        $androidConfig->setNotification($androidNotification);
        $data = [
            'page' => $this->page,
            'image' => 'https://errandia.com/assets/images/app-logo.png'
        ];
        $androidConfig->setData(array_merge($data, $this->data_to_send));
        $message->setAndroid($androidConfig);
        return  $message;
    }

}