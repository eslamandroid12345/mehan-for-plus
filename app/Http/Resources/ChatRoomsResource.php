<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatRoomsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = $this->users()->where('user_id', '!=', auth('api')->id())->first();
        $unread = auth('api')->user()->chatRooms()->where('chat_room_id', $this->id)->pluck('unread')->first();
        $lastMessage = $this->messages()->latest()->first();
        return [
            'room_id' => $this->id,
            'user_id' => $user->user->id,
            'image' => !is_null($user->user->image) ? url($user->user->image) : '',
            'name' => $user->user->name,
            'last_message' => !is_null($lastMessage) ? ($lastMessage->user_id == auth('api')->id() ? __('messages.You:') : '') . ($lastMessage->type == 'TEXT' ? $lastMessage->content : __('messages.'.$lastMessage->type)) : '',
            'last_message_date' => Carbon::parse($lastMessage->created_at)->format('d M Y'),
            'unread_count' => $unread,
        ];
    }
}
