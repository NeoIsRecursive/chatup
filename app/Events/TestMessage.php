<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Crypt;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestMessage implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->message->friendship_id);
    }

    public function broadcastWith()
    {
        return [
            'content' => Crypt::decryptString($this->message->content),
            'user_id' => User::find($this->message->user_id)->name,
            'friendship_id' => $this->message->friendship_id,
        ];
    }
}
