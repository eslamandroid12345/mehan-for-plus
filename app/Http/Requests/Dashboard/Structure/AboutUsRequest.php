<?php

namespace App\Http\Requests\Dashboard\Structure;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsRequest extends FormRequest
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
            'ar.main_title' => 'nullable',
            'en.main_title' => 'nullable',
            'image' => 'nullable|image',
            'old_image' => 'required|exclude',
            'en.content.title' => 'nullable',
            'ar.content.title' => 'nullable',
            'en.content.content' => 'nullable',
            'ar.content.content' => 'nullable',
        ];
    }
}
