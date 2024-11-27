<?php

namespace App\Http\Resources\Structures\Main;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentStructureResource extends JsonResource
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
            "key" => "phone",
            "value" => "+966 1234 1234"
        ];
    }
}
