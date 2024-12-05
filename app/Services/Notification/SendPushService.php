<?php

namespace App\Services\Notification;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class SendPushService
{

    public function index(string $title, string $body, string $deviceToken)
    {
        // Initialize Firebase
        $factory = (new Factory)
            ->withServiceAccount(config('firebase.credentials'));

        $messaging = $factory->createMessaging();

        // Create the notification message
        $notification = [
            'title' => $title,
            'body'  => $body,
        ];

        // Create the CloudMessage
        $message = CloudMessage::withTarget('token', $deviceToken)
                               ->withNotification($notification);

        // Send the message
        $messaging->send($message);
    }
}
