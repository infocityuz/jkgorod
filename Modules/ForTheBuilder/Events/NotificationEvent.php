<?php

namespace Modules\ForTheBuilder\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $models;
    public $userid;

    public function __construct($models)
    {
        $this->models = $models;
    }

    public function broadcastOn()
    {
        return new Channel('prepayment_event');
    }

    public function broadcastAs()
    {
        return 'prepayment_notification';
    }
}
