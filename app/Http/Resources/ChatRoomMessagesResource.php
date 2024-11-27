<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatRoomMessagesResource extends JsonResource
{

    private $user;

    public function __construct($resource, $user)
    {
        parent::__construct($resource);
        $this->user = $user;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'room_id' => $this->id,
            'user_id' => (int) $this->user->id,
            'name' => $this->user->name,
            'messages' => ChatMessageResource::collection($this->messages),
        ];
    }
}
