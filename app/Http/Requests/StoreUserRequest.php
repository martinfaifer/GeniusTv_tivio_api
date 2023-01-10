<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:250'],
            'email' => ['required', 'unique:users,email', 'email', 'max:250'],
            'isAdmin' => ['nullable', 'boolean'],
            'password' => ['required', 'string', 'min:8', 'max:16'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vyplňte jméno',
            'name.string' => 'Neplatný formát',
            'name.max' => 'Maximální počet znaků je 250',
            'email.required' => 'Vyplňte e-mail',
            'email.unique' => 'Tento e-mail již existuje',
            'email.email' => 'Neplatný formát',
            'email.max' => 'Maximální počet znaků je 250',
            'isAdmin.boolean' => 'Neplatný formát',
            'password.required' => 'Vyplňte heslo',
            'password.string' => 'Neplatný formát',
            'password.min' => 'Minimální počet znaků je 8',
            'password.max' => 'Maximální počet znaků je 16',
        ];
    }
}
