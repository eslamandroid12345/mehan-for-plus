<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SeekerDetailsResource extends JsonResource
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
            'ad' => new SeekerAdResource($this->seeker),
            'job' => new JobResource($this->seeker->job),
            'skills' => SkillResource::collection($this->seeker->skills),
            'more_skills' => $this->seeker->more_skills ?? '',
            'is_resident' => (bool)$this->seeker->is_resident,
            'is_favorite' => auth('api')->check() && !is_null(auth('api')->user()->company) ? auth('api')->user()->company->isFavorite($this->seeker->id) : false,
            'profile_views' => !is_null($this->seeker->ad) ? $this->seeker->ad->views : 0,
            'id' => $this->id,
            'profile_picture' => !is_null($this->image) ? url($this->image) : '',
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'is_phone_public' => !is_null($this->is_phone_public) ? $this->is_phone_public : 0,
            'linkedin_account' => !is_null($this->seeker->ad) ? $this->seeker->ad->linkedin_account : '',
            'qualification' => !is_null($this->seeker->ad) && !is_null($this->seeker->ad->qualification) ? new QualificationResource($this->seeker->ad->qualification) : null,
            'religion' => $this->seeker->religion,
            'nationality' => new NationalityResource($this->seeker->nationality),
            'country' => new CountryResource($this->seeker->city?->country),
            'city' => new CityResource($this->seeker->city),
            'work_hours_type' => !is_null($this->seeker->ad) ? (int)$this->seeker->ad->work_hours_type : -1,
            'cv' => !is_null($this->seeker->cv) ? url($this->seeker->cv) : '',
            'gender' => $this->seeker->gender,
            'years_of_experience' => !is_null($this->seeker->ad) ? $this->seeker->ad->years_of_experience : '',
            'marital_status' => !is_null($this->seeker->ad) ? (int)$this->seeker->ad->marital_status : -1,
            'biography' => !is_null($this->seeker->ad) ? $this->seeker->ad->biography : '',
            'residency_number' => !is_null($this->seeker->residency_number) ? $this->seeker->residency_number : '',
            'is_residency_number_public' => !is_null($this->seeker->is_residency_number_public) ? $this->seeker->is_residency_number_public : 0,
            'residency_expiration' => !is_null($this->seeker->residency_expiration) ? Carbon::parse($this->seeker->residency_expiration)->format('Y-m-d') : '',
            'is_residency_expiration_public' => !is_null($this->seeker->is_residency_expiration_public) ? $this->seeker->is_residency_expiration_public : 0,
            'is_worked_before_in_ksa' => !is_null($this->seeker->is_worked_before_in_ksa) ? (int)$this->seeker->is_worked_before_in_ksa : -1,
        ];
    }

}
