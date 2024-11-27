<?php

namespace App\Http\Requests\Api\Ads;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterAdsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'keyword' => 'nullable',
            'nationality_id' => 'nullable|exists:nationalities,id',
            'job_id' => 'nullable|exists:jobs,id',
            'is_resident' => 'nullable|boolean',
            'qualification_id' => 'nullable|exists:qualifications,id',
            'city_id' => 'nullable|exists:cities,id',
            'years_of_experience' => ['nullable', Rule::in(['1-', '3-', '10-', '10+'])],
        ];
    }
}
