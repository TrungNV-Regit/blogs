<?php

namespace App\Events;

use App\Models\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $author;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public int $blogId,
        public Comment $comment,
        public int $typeEvent,
    ) {
        $this->author = auth()->user();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        $result = null;
        switch ($this->typeEvent) {
        case Comment::CREATE:
            $result = new Channel('create-comment.' . $this->blogId);
            break;
        case Comment::UPDATE:
            $result = new Channel('update-comment.' . $this->blogId);
            break;
        case Comment::DESTROY:
            $result = new Channel('destroy-comment.' . $this->blogId);
            break;
        }
        return $result;
    }
}
