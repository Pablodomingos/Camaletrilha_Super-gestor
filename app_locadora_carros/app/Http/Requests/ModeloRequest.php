<?php

namespace App\Http\Requests;

use App\Models\Modelo;
use Illuminate\Foundation\Http\FormRequest;
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
    public function rules()
    {
        return [
        'marca_id' => 'exists:marcas,id',
        'nome' => ['required|min:3|max:120', Rule::unique('modelos')->ignore(Modelo::get('nome'))],
        'image' => 'required|file|mimes:png,jpg,jpeg',
        'numero_portas' => 'required|integer|digits_between:1,5', //(1,2,3,4,5)
        'lugares' => 'required|integer|digits_between:1,20',
        'air_bag' => 'required|boolean',
        'abs' => 'required|boolean' //true, false, 1, 0, "1", "0"
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O :attribute e necessario',
            '' => '',
        ];
    }
}
