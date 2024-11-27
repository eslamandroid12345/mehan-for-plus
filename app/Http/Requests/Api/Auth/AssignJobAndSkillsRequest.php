<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AssignJobAndSkillsRequest extends FormRequest
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
            'job' => 'required|exists:jobs,id',
//            'skills' => 'required',
            'skills.*' => 'exists:skills,id',
            'more_skills' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'skills.*.exists' => __('messages.Wrong skill was selected'),
            'job.exists' => __('messages.Wrong job was selected'),
        ];
    }
}
