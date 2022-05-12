<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CarroRequest extends FormRequest
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
            $rules = [
            'modelo_id',
            'placa',
            'disponivel',
            'km',
        ];

            foreach($rules as $rule) {
                if(array_key_exists($rule, $request->all())) {
                    switch($rule){
                        case 'modelo_id':
                            return ['modelo_id' => 'exists:modelos,id'];
                            break;
                        case 'placa':
                            return ['placa' => "required|unique:carros,placa,$this->carro->id"];
                            break;
                        case 'disponivel':
                            return ['disponivel' => 'required|boolean'];
                            break;
                        case 'km':
                            return ['km' => 'required|integer'];
                            break;
                    }
                }
            }
        }else {
            return [
                'modelo_id' => 'exists:modelos,id',
                'placa' => "required|unique:carros,placa,$this->carro->id",
                'disponivel' => 'required|boolean',
                'km' => 'required|integer',
            ];
        }
    }
}
