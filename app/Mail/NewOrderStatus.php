<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewOrderStatus extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;
//    public $order_status;
    public function __construct($order)
    {

        $this->order = $order;
//        $this->order_status = $order_status;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */


    public function build()
    {
        return $this->markdown('emails.order-status')
            ->subject('Order Status')
            ->with('order', $this->order);
    }
}
