<?php

namespace App\Http\Requests\Dashboard\Companies;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'field_id' => 'required|exists:fields,id',
            'image' => 'mimes:jpg,jpeg,png|max:5120',
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email'.($this->isMethod('put') ? ','.$this->company.',id' : ''),
            'password' => !$this->isMethod('put') ? 'required|min:8|confirmed' : 'nullable|min:8|confirmed',
            'phone' => 'required|min:8',
        ];
    }
}
