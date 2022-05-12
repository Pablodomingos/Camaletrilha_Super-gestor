<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LocacaoRequest extends FormRequest
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
            'cliente_id',
            'carro_id',
            'data_inicio_periodo',
            'data_final_previsto_periodo',
            'data_final_realizado_periodo',
            'valor_diario',
            'km_inicial',
            'km_fianl',
        ];

            foreach($rules as $rule) {
                if(array_key_exists($rule, $request->all())) {
                    switch($rule){
                        case 'cliente_id':
                            return ['cliente_id' => 'exists:clientes,id'];
                            break;
                        case 'carro_id':
                            return ['carro_id' => 'exists:carros,id'];
                            break;
                        case 'data_inicio_periodo':
                            return ['data_inicio_periodo' => 'required|date'];
                            break;
                        case 'data_final_previsto_periodo':
                            return ['data_final_previsto_periodo' => 'required|date'];
                            break;
                        case 'data_final_realizado_periodo':
                            return ['data_final_realizado_periodo' => 'required|date'];
                            break;
                        case 'valor_diario':
                            return ['valor_diario' => 'required'];
                            break;
                        case 'km_inicial':
                            return ['km_inicial' => 'required|integer'];
                            break;
                        case 'km_fianl':
                            return ['km_fianl' => 'required'];
                            break;
                    }
                }
            }
        }else {
            return [
                'cliente_id' => 'exists:clientes,id',
                'carro_id' => 'exists:carros,id',
                'data_inicio_periodo' => 'required|date',
                'data_final_previsto_periodo' => 'required|date',
                'data_final_realizado_periodo' => 'required|date',
                'valor_diario' => 'required',
                'km_inicial' => 'required|integer',
                'km_fianl' => 'required',
            ];
        }
    }
}
