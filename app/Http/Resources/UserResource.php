<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'user_type' => (int)$this->user_type,
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => !is_null($this->image) ? url($this->image) : '',
            'is_have_job' => $this->user_type == 1 && !is_null($this->seeker->job_id),
            'token' => $this->token(),
        ];
    }
}
