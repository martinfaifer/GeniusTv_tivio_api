<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'password' => ['nullable', 'string', 'max:16', 'min:8'],
            'check_password' => ['nullable', 'string', 'max:16', 'min:8', 'same:password'],
            'isAdmin' => ['required', 'boolean']
        ];
    }

    public function messages()
    {
        return [
            'password.string' => "Naplatný formát",
            'password.min' => "Minimální počet znaků je 8",
            'password.max' => "Maximální počet znaků je 16",
            'check_password.string' => "Naplatný formát",
            'check_password.min' => "Minimální počet znaků je 8",
            'check_password.max' => "Maximální počet znaků je 16",
            'check_password.same' => "Hesla se neshodují",
            'isAdmin.boolean' => "Neplatný formát"
        ];
    }
}
