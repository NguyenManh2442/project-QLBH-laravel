<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerOrder
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $order;
    public $orderdetails;
    public $mail;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $order, array $orderdetails, $mail)
    {
        $this->order = $order;
        $this->orderdetails = $orderdetails;
        $this->mail = $mail;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
