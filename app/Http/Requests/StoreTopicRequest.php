<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTopicRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', 'unique:topics,title'],
            'text' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vyplňte titulek',
            'title.string' => 'Neplatný formát',
            'title.max' => 'Maximální počet znaků je 255',
            'title.unique' => 'Článek s tímto titulkem již existuje',
            'text.required' => 'Nesmí být prázdné',
            'text.string' => 'Neplatný formát',
        ];
    }
}
