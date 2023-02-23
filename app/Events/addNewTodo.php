<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class addNewTodo implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $authId, $title, $body;

    /**
     * Create a new event instance.
     */
    public function __construct($authId, $title, $body)
    {
        $this->authId = $authId;
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('add-todo'),
        ];
    }
}
