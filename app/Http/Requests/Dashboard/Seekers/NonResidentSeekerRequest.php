<?php

namespace App\Http\Requests\Dashboard\Seekers;

use App\Repository\NationalityRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class NonResidentSeekerRequest extends FormRequest
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
        $rules = [
            'image' => 'mimes:jpg,jpeg,png|max:5120',
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email'.($this->isMethod('put') ? ','.$this->non_resident_seeker.',id' : ''),
            'password' => !$this->isMethod('put') ? 'required|min:8|confirmed' : 'nullable|min:8|confirmed',
            'phone' => ['required', 'numeric', 'min:7'],
            'cv' => 'mimes:pdf,doc,docx|max:20480',
            'nationality_id' => 'required|exists:nationalities,id',
            'city_id' => 'required|exists:cities,id',
            'gender' => 'required|numeric',
            'religion' => 'required',
            'job_id' => 'required|exists:jobs,id',
            'skills.*' => 'exists:skills,id',
            'is_worked_before_in_ksa' => 'required|boolean',
        ];
        return $rules;
    }

}
