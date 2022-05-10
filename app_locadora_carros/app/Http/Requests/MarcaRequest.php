<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MarcaRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if($request->method() == 'PATCH') {
            $rules = ['nome', 'image'];

            foreach($rules as $rule) {
                if(array_key_exists($rule, $request->all())) {
                    switch($rule){
                        case 'nome':
                            return ['nome' => "required|min:3|max:50|unique:marcas,nome,$this->marca->id"];
                            break;
                        case 'image':
                            return ['image' => 'required|mimes:png,jpg|file'];
                            break;
                    }
                }
            }
        }else {
            return [
                'nome' => "required|min:3|max:50|unique:marcas,nome,$this->marca->id",
                'image' => 'required|mimes:png,jpg|file',
            ];
        }
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatorio!',
            'unique' => 'Marca já cadastrada',
            'min' => 'A quantidade minima de caracteres aceito e 3',
            'max' => 'A quantidade maxima de caracteres atingida',
            'mimes' => 'Formato de arquivo invalido. Arquivos aceitos no formato: PNG, JPG.',
            'file' => 'Por favor insira apenas arquivos nesse campo'
        ];
    }
}
