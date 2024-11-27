<?php

namespace App\Http\Requests\Api\Company;

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
            'image' => 'mimes:jpg,jpeg,png|max:5120',
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,'.auth('api')->id(),
            'phone' => 'required|min:8',
            'field_id' => 'required|exists:fields,id',
        ];
    }
}
