<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerLoginRequest extends FormRequest
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
            // 'mac' => ['required', 'string', 'max:255', 'exists:stbs,mac'],
            // 'identity' => ['required', 'string', 'max:255']
            'identity_username' => ['required', 'string', 'max:255'],
            'identity_password' => ['required', 'string', 'max:255'],
            'ispCode' => ['nullable', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            // 'mac.required' => "Vyplňte pole",
            // 'mac.string' => "Neplatný formát",
            // 'mac.max' => "Překročen maximální počet znaků",
            // 'mac.exists' => "Nenalezena mac adresa stb",
            // 'identity.required' => "Vyplňte pole",
            // 'identity.string' => "Neplatný formát",
            // 'identity.max' => "Překročen maximální počet znaků",
            // 'identity.exists' => "Nenalezena identita"
            'identity_username.required' => 'Vyplňte uživatelské jméno',
            'identity_username.string' => 'Neplatný formát',
            'identity_username.max' => 'Maximální počet znaků je 255',
            // 'identity_username.exists' => "Neexistuje uživatel",
            'identity_password.required' => 'Vyplňte heslo',
            'identity_password.string' => 'Neplatný formát',
            'identity_password.max' => 'Maximální počet znaků je 255',
        ];
    }
}
