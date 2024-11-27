<?php

namespace App\Http\Requests\Dashboard\Content;

use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
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
            'file' => 'array',
            'old_file' => 'array',
            'file.*' => 'nullable',
            'old_file.*' => 'nullable',
        ];
    }
}
