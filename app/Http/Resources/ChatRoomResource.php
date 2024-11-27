<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatRoomResource extends JsonResource
{
    private $user_id;

    public function __construct($resource, $user_id)
    {
        parent::__construct($resource);
        $this->user_id = $user_id;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = $this->users()->where('user_id', '!=', $this->user_id)->first();
        $unread = $this->users()->where('user_id', '=', $this->user_id)->pluck('unread')->first();
        $lastMessage = $this->messages()->latest()->first();
        return [
            'room_id' => $this->id,
            'user_id' => $user->user->id,
            'image' => !is_null($user->user->image) ? url($user->user->image) : '',
            'name' => $user->user->name,
            'last_message' => !is_null($lastMessage) ? ($lastMessage->user_id == $this->user_id ? __('messages.You:') : '') . ($lastMessage->type == 'TEXT' ? $lastMessage->content : __('messages.'.$lastMessage->type)) : '',
            'last_message_date' => !is_null($lastMessage) ? Carbon::parse($lastMessage->create_at)->format('d M Y') : '',
            'unread_count' => $unread,
        ];
    }
}
