<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoFormRequest extends FormRequest
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
            'nombre'=>'required|max:50',
            'apePaterno'=>'required|max:45',
            'apeMaterno'=>'required|max:45',
            'domicilio'=>'required|max:100',
            'telefono'=>'max:20',
            'fechaIngreso'=>'date',
            'puesto'=>'max:45',
            'salario'=>'numeric',
            'seguro'=>'numeric'
        ];
    }
}
