<?php

namespace App\Http\Requests\Dashboard\Admins;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
            'name' => 'required',
            'email' => ['required', 'email:rfc,dns', Rule::unique('admins' , 'email')->ignore($this->admin, 'id')],
            'password' => 'nullable|min:8|confirmed',
        ];
    }
}
