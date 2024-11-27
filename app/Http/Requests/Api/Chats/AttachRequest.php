<?php

namespace App\Http\Requests\Api\Chats;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttachRequest extends FormRequest
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
            'type' => ['required', Rule::in(['IMAGE', 'AUDIO', 'FILE'])],
            'attachment' => 'required|mimes:pdf,doc,jpg,jpeg,png,mp3,m4a,mp4a,mp4,webm|max:20480'
        ];
    }
}
