<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SeekerAdResource extends JsonResource
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
            'id' => (int)!is_null($this->ad) ? $this->ad->id : 0,
            'is_have_past' => (bool)!is_null($this->ad) && $this->ad->is_past,
            'is_active' => (bool)!is_null($this->ad) && $this->ad->is_active,
            'is_hired' => (bool)!is_null($this->ad) && $this->ad->is_hired,
            'ad_expiration_date' => (string)!is_null($this->ad) && !Carbon::parse($this->ad->expiration_date)->isPast() && $this->ad->is_active ? adExpiration($this->ad->expiration_date) : '',
        ];
    }
}
