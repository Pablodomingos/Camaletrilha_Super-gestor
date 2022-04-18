<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'email',
            'password' => 'required|min:4|max:10',
            'newPassword' => 'required|min:4|max:10',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Digite o seu nome',
            'email' => 'Digite seu email aqui PORRA!',
            'required' => 'Precisa colocar uma senha sua mula',
            'min' => 'A quantidade minima é 4',
            'max' => 'Você atingiu a quantidade maxíma de caracteres'
        ];
    }
}
