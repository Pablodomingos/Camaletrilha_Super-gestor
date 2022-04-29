<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FornecedorRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if($request->_token) {
            return [
                'nome' => 'required|min:3|max:60',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];
        } else {
            return [
            ];
        }
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'email' => 'O campo E-mail é obrigatório',
            'nome.min' => 'O nome não atingiu a quantidade minima de caracteres',
            'nome.max' => 'O nome já atingiu a quantidade máxima de caracteres',
            'uf.min' => 'Não atigiu a quantidade minima de caracteres',
            'uf.max' => 'Já atingiu a quantidade máxima de caracteres',
        ];
    }
}
