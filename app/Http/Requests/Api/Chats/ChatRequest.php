<?php

namespace App\Http\Requests\Api\Chats;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChatRequest extends FormRequest
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
            'room_id' => 'required|exists:chat_rooms,id',
            'content' => 'required|string',
            'type' => ['required', Rule::in(['TEXT', 'IMAGE', 'FILE', 'AUDIO'])],
        ];
    }
}
