<?php

namespace App\Http\Requests\Dashboard\Qualifications;

use Illuminate\Foundation\Http\FormRequest;

class QualificationsRequest extends FormRequest
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
            'name_en' => 'required',
            'name_ar' => 'required',
        ];
    }
}
