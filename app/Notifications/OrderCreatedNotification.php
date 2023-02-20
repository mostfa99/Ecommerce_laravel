<?php

namespace App\Notifications;

use App\Channels\TweetSmsChannel;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\VonageMessage;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    public $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // mail , database , vonage (SMS) , brodcast , stack
        // return ['mail','database', 'vonage', 'broadcast'];
        $via = [
            //'database', 'mail',  'broadcast', 'vonage'
            TweetSmsChannel::class
        ];
        /* if ($notifiable->notify_sms) {
            $via[] = 'vonage';
        }
        if ($notifiable->notify_mail) {
            $via[] = 'mail';
        }*/
        return  $via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('New order #:number', [
                'number' => $this->order->number
            ]))
            #custome sender not from .env
            ->from('invoices@localhost', 'Electro Billing ')
            // welcome name
            ->greeting(__('Hello , :name ', [
                'name' => $notifiable->name ?? ''
            ]))
            ->line(__('New order has been created (Order #:number).', [
                'number' => $this->order->number,
            ]))
            ->action('view Order', url('/'))
            ->line('Thank you for Shopping with us!');
        // custome view page
        /*  ->view('',[
                'order'=>$this->order,
            ])*/
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => __('New order #:number', [
                'number' => $this->order->number
            ]),
            'body'  => __('New order has been created (Order #:number).', [
                'number' => $this->order->number,
            ]),
            'icon'  => '',
            'url'   => url('/'),
        ];
    }

    public function toBroadcast($notifiable)
    {

        return new BroadcastMessage([
            'title' => __('New order #:number', [
                'number' => $this->order->number
            ]),
            'body'  => __('New order has been created (Order #:number).', [
                'number' => $this->order->number,
            ]),
            'icon'  => '',
            'url'   => url('/'),
            'time' => Carbon::now()->diffForHumans(),
        ]);
        /* return [
            'title' => __('New order #:number', [
                'number' => $this->order->number
            ]),
            'body'  => __('New order has been created (Order #:number).', [
                'number' => $this->order->number,
            ]),
            'icon'  => '',
            'url'   => url('/'),
        ];*/
    }
    /**
     * Get the Vonage / SMS representation of the notification.
     */
    public function toVonage($notifiable)
    {
        $message = new VonageMessage();
        $message->content(__('New order has been created (Order #:number).', [
            'number' => $this->order->number,
        ]));
        return $message;
    }
    public function toTweetSms($notifiable)
    {
        return __(
            'New order has been created (Order #:number).',
            ['number' => $this->order->number,]
        );
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
