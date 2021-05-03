<?php

namespace App\Listeners;

use App\Events\CustomerOrder;
use App\Mail\ConfirmOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendMailConfirmOrder implements ShouldQueue
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
     * @param  CustomerOrder  $event
     * @return void
     */
    public function handle(CustomerOrder $event)
    {
        Mail::to($event->mail)->send(new ConfirmOrder($event->order, $event->orderdetails));
    }
}
