<?php

namespace Modules\ForTheBuilder\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RealTimeMessage implements ShouldBroadcast
{
    use SerializesModels;

    public $message;
    public $userTaskId;

    public function __construct($message,$userTaskId)
    {
        $this->message = $message;
        $this->userTaskId = $userTaskId;
    }

    public function broadcastOn()
    {
        return new Channel('events');
    }

    public function broadcastAs()
    {
        return 'notification';
    }
}
