<?php

namespace App\Http\Requests\Api\Auth;

use App\Repository\NationalityRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    private NationalityRepositoryInterface $nationalityRepository;

    public function __construct(NationalityRepositoryInterface $nationalityRepository, array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->nationalityRepository = $nationalityRepository;
    }

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
            'user_type' => ['required','numeric', Rule::in([0, 1])],
            'device_token' => 'nullable',
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required|min:8',
        ];

        if ($this->user_type == 0) {
            $rules['company_field'] = 'required|exists:fields,id';
        } else {
            $rules['is_phone_public'] = 'required|boolean';
            $rules['is_resident'] = 'required|numeric';
            $rules['nationality_id'] = 'nullable|exists:nationalities,id';
            $rules['city_id'] = 'nullable|exists:cities,id';
            $rules['gender'] = 'required|numeric';
            $rules['religion'] = 'nullable';
            $rules['cv'] = 'mimes:pdf,doc,docx|max:20480';
            if ($this->is_resident == 1) {
                if(!$this->nationalityRepository->isSaudi($this->nationality_id)) {
                    $rules['residency_number'] = 'nullable|unique:seekers,residency_number';
                    $rules['is_residency_number_public'] = 'required|boolean';
                    $rules['residency_expiration'] = 'nullable|date';
                    $rules['is_residency_expiration_public'] = 'required|boolean';
                }
            } else {
                $rules['is_worked_before_in_ksa'] = 'required|boolean';
            }
        }
        return $rules;
    }
}
