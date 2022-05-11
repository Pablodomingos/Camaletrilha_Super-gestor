<?php

namespace App\Http\Requests;

use App\Models\Modelo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModeloRequest extends FormRequest
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
            'marca_id',
            'nome',
            'image',
            'numero_portas',
            'lugares',
            'air_bag',
            'abs'
        ];

            foreach($rules as $rule) {
                if(array_key_exists($rule, $request->all())) {
                    switch($rule){
                        case 'marca_id':
                            return ['marca_id' => 'exists:marcas,id'];
                            break;
                        case 'nome':
                            return ['nome' => "required|min:3|max:50|unique:marcas,nome,$this->modelo->id"];
                            break;
                        case 'image':
                            return ['image' => 'required|file|mimes:png,jpg,jpeg'];
                            break;
                        case 'numero_portas':
                            return ['numero_portas' => 'required|integer|digits_between:1,5'];
                            break;
                        case 'lugares':
                            return ['lugares' => 'required|integer|digits_between:1,20'];
                            break;
                        case 'air_bag':
                            return ['air_bag' => 'required|boolean'];
                            break;
                        case 'abs':
                            return ['abs' => 'required|boolean'];
                            break;
                    }
                }
            }
        }else {
            return [
            'marca_id' => 'exists:marcas,id',
            'nome' => "required|min:3|max:120|unique:marcas,nome,$this->modelo->id",
            'image' => 'required|file|mimes:png,jpg,jpeg',
            'numero_portas' => 'required|integer|digits_between:1,5', //(1,2,3,4,5)
            'lugares' => 'required|integer|digits_between:1,20',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean' //true, false, 1, 0, "1", "0"
            ];
        }
    }

    public function messages()
    {
        return [
            'required' => 'O :attribute e necessario',
        ];
    }
}
