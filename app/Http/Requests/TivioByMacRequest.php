<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TivioByMacRequest extends FormRequest
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
            'mac' => ['required', 'exists:stbs,mac']
        ];
    }

    public function messages()
    {
        return [
            'mac.required' => "Vyplňte pole.",
            'mac.exists' => "Nenalezen STB."
        ];
    }
}
