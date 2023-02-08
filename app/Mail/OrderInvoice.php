<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderInvoice extends Mailable
{
    use Queueable, SerializesModels;

    protected  $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // عنوان الرسالة
        $this->subject('Invoice #' .  $this->order->number);
        // صاحب الرسالة
        $this->from('Billing@localhost', 'Billing Account');
        // محتوى الرسالة
        return $this->view('mails.invoice', [
            'order' => $this->order,
        ]);
    }
}
