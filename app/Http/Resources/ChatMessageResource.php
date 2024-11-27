<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'image' => !is_null($this->user->image) ? url($this->user->image) : '',
            'sender_id' => $this->user_id,
            'type' => $this->type,
            'content' => $this->content,
            'time' => Carbon::parse($this->created_at)->diffForHumans()
        ];
    }
}
