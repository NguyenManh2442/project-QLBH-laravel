<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $orderdetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $orderdetails)
    {
        $this->order = $order;
        $this->orderdetails = $orderdetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('customer.send_gmail_confirm_order');
    }
}
