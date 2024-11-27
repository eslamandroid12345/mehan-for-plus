<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'image' => !is_null($this->image) ? url($this->image) : '',
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'field' => new FieldResource($this->company->field),
        ];
    }
}
