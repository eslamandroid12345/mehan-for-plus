<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatAttachmentResource extends JsonResource
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
            'type' => $this['type'],
            'path' => env('APP_URL') . $this['path'],
        ];
    }
}
