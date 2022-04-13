<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContatoRequest extends FormRequest
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
            'nome' => 'required|min:3|max:40|unique:site_contatos',
            'telefone' => 'required',
            'email' => 'required|email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|min:6|max:200'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Digite o nome!',
            'nome.min' => 'Digite um nome com mais de 3 caracteres',
            'nome.max' => 'O nome não pode ter mais de 40 caracteres!',
            'telefone.required' => 'Falto o telefone parceiro!',
            'email.required' => 'Esqueceu o email aqui ó',

            'required' => 'Esqueceu esse campo :attribute aqui ó',
        ];
    }
}
