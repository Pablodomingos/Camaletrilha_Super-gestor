<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarefasRequest extends FormRequest
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
            'tarefa' => 'required|min:6|max:199',
            'data_limite' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute precisa ser preenchido',
            'min' => 'Quantidade minima permitida para esse campo é 6 caracteres',
            'max' => 'Quantidade maxima permitida foi atingida',
        ];
    }
}
