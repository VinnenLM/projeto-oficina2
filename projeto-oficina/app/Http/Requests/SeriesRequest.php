<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesRequest extends FormRequest
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
            'nome' => 'required',
            'qtd_temporadas' => 'required|numeric|min:0|not_in:0',
            'qtd_episodios' => 'required|numeric|min:0|not_in:0'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo ":attribute" é obrigatório.',
            'not_in' => 'O campo ":attribute" é inválido.',
            'min' => 'O campo ":attribute" é inválido.',
            'numeric' => 'O campo ":attribute" é inválido.'
        ];
    }
}
