<?php

namespace App\Events;

use App\Http\Resources\ChatRoomResource;
use App\Http\Resources\ChatRoomsResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChangeChatRoomsStateEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id, $data)
    {
        $this->user_id = $user_id;
        $this->data = new ChatRoomResource($data, $user_id);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.rooms.states.'.$this->user_id);
    }
}
