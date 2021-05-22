<?php

namespace App\Listeners;

use App\Events\ResetPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\ResetPassword as ChangePassword;
use Illuminate\Support\Facades\Mail;

class SendMailResetPassword implements ShouldQueue
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
     * @param  ResetPassword  $event
     * @return void
     */
    public function handle(ResetPassword $event)
    {
        Mail::to($event->email)->send(new ChangePassword($event->url));
    }
}
