<?php

namespace App\Http\Requests\Dashboard\Ads;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdRequest extends FormRequest
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
            'additional_phone' => 'nullable|min:8',
            'linkedin_account' => 'nullable|url',
            'qualification_id' => 'required|exists:qualifications,id',
            'work_hours_type' => ['required', Rule::in([0, 1])],
            'marital_status' => ['required', Rule::in([0, 1])],
            'years_of_experience' => ['required', Rule::in(['1-', '3-', '10-', '10+'])],
            'biography' => 'required|max:250',
            'is_active' => 'sometimes|boolean',
            'silently' => 'sometimes|boolean',
            'renew' => 'sometimes|boolean',
        ];
    }
}
