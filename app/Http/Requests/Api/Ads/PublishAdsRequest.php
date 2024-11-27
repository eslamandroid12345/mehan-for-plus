<?php

namespace App\Http\Requests\Api\Ads;

use App\Exceptions\PublishAdException;
use App\Http\Traits\Responser;
use App\Repository\NationalityRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class PublishAdsRequest extends FormRequest
{
    use Responser;
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
        return Gate::allows('publish-ad');
    }

    protected function failedAuthorization()
    {
        throw new PublishAdException;
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
            'email' => ['required', 'email:rfc,dns', Rule::unique('users' , 'email')->ignore($this->user()->id, 'id')],
            'phone' => 'required|min:8',
            'is_phone_public' => 'required|boolean',
            'linkedin_account' => 'nullable|url',
            'qualification_id' => 'nullable|exists:qualifications,id',
            'religion' => 'nullable',
            'nationality_id' => 'nullable|exists:nationalities,id',
            'city_id' => 'nullable|exists:cities,id',
            'work_hours_type' => ['required', Rule::in([0, 1])],
            'cv' => 'mimes:pdf,doc,docx|max:20480',
            'gender' => ['required', Rule::in([0, 1])],
            'years_of_experience' => ['required', Rule::in(['1-', '3-', '10-', '10+'])],
            'marital_status' => ['required', Rule::in([0, 1, 2, 3])],
            'biography' => 'required',
        ];
        if($this->user()->seeker->is_resident) {
            if(!$this->nationalityRepository->isSaudi($this->nationality_id)) {
                $rules['residency_number'] = ['nullable', Rule::unique('seekers' , 'residency_number')->ignore($this->user()->seeker->id, 'id')];
                $rules['is_residency_number_public'] = 'required|boolean';
                $rules['residency_expiration'] = 'nullable|date';
                $rules['is_residency_expiration_public'] = 'required|boolean';
            }
        } else {
            $rules['is_worked_before_in_ksa'] = 'required|boolean';
        }
        return $rules;
    }
}
