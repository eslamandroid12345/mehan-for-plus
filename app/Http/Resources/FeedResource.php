<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedResource extends JsonResource
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
            'id' => $this->seeker->user->id,
            'photo' => !is_null($this->seeker->user->image) ? url($this->seeker->user->image) : '',
            'name' => $this->seeker->user->name,
            'job' => $this->seeker->job->t('name'),
            'years_of_experience' => $this->years_of_experience,
            'city' => $this->seeker->city?->getRawOriginal('name_'.app()->getLocale()),
            'biography' => $this->biography,
            'phone' => new PhoneResource($this->seeker->ad),
            'is_hired' => (bool) $this->seeker->ad->is_hired,
            'is_phone_public' => !is_null($this->seeker->user->is_phone_public) ? $this->seeker->user->is_phone_public : 0,
            'is_favorite' => auth('api')->check() && !is_null(auth('api')->user()->company) ? auth('api')->user()->company->isFavorite($this->seeker->id) : false,
        ];
    }
}
