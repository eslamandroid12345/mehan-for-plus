<?php

namespace App\Http\Requests\Dashboard\Structure;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'en.content.contacts.message' => 'nullable',
            'ar.content.contacts.message' => 'nullable',
            'en.content.contacts.content.*.key' => 'nullable',
            'en.content.contacts.content.*.value' => 'nullable',
            'en.content.social.message' => 'nullable',
            'ar.content.social.message' => 'nullable',
            'en.content.social.content.*.key' => 'nullable',
            'en.content.social.content.*.value' => 'nullable',
        ];
    }
}
