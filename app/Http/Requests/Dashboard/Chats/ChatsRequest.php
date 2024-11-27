<?php

namespace App\Http\Requests\Dashboard\Chats;

use Illuminate\Foundation\Http\FormRequest;

class ChatsRequest extends FormRequest
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
            'company_id' => 'required|exists:users,id',
            'seeker_id' => 'required|exists:users,id',
        ];
    }
}
