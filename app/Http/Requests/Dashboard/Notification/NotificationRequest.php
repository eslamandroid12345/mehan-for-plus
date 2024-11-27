<?php

namespace App\Http\Requests\Dashboard\Notification;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotificationRequest extends FormRequest
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
            'to' => ['required', 'array', Rule::in([0, 1, 2]),],
            'title' => 'required|string',
            'content' => 'required|string',
        ];
    }
}
