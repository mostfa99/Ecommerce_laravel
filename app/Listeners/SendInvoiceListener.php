<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\OrderInvoice;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Listeners\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class SendInvoiceListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {

        dd('Code in SendInvoiceListener');
        $order = $event->order;
        $user = User::where('type', 'super-admin')->first(); // retrieve the first matching user
        $user->notify(new OrderCreatedNotification($order)); // call the notify method on the user instance

        // Mail::to($order->billing_email)->send(new OrderInvoice($order));


        $users = User::whereIn('type', ['super-admin', 'admin'])->get();
        foreach ($users as $user) {
            $user->notify(new OrderCreatedNotification($order));
        }
        FacadesNotification::send($users, new OrderCreatedNotification($order));

        // FacadesNotification::route('mail', ['info@example.com', 'admin@example.com'])
        //     ->notify(new OrderCreatedNotification($order));

        // Mail::to($order->billing_email)->send(new OrderInvoice($order));
    }
}
