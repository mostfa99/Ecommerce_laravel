<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

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
        // mail , database , nexmo (SMS) , brodcast , stack
        // return ['mail','database', 'nexmo', 'broadcast'];
        $via = [
            'mail', 'database', 'broadcast'
        ];
        /* if ($notifiable->notify_sms) {
            $via[] = 'nexmo';
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
                'name' => $notifiable->name
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
