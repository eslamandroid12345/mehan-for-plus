<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class YearsOfExperience extends JsonResource
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
            'value' => $this->years_of_experience,
            'string' => __('db.years_of_experience.'.$this->years_of_experience),
        ];
    }
}
