<?php

namespace App\Channels;

use Exception;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class TweetSmsChannel
{
    /**
     * Send the given notification.
     */
    public function send($notifiable, Notification $notification)
    {
        $to  = $notifiable->routeNotificationForTweetSms();
        $message  = $notification->toTweetSms($notifiable);
        $response = Http::baseUrl('https://www.tweetsms.ps')
            ->get('api.php', [
                'comm' => 'sendsms',
                'user' => config('services.tweetsms.user'),
                'pass' => config('services.tweetsms.passwrod'),
                'to' => $to,
                'message' => urlencode($message),
                'sender' => config('services.tweetsms.sender'),

            ]);
        // user + pass + to + message + sender
        // https://www.tweetsms.ps/api.php?comm=sendsms&user=TEST&pass=123456&to=972594127070&message=testmessage&sender=TweetTEST
        $result = $response->body();
        if ($result != 1) {
            throw new Exception('Error code: ' . $result);
        }
    }
}
