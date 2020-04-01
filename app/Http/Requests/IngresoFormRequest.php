<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoFormRequest extends FormRequest
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
            'idProveedor'=>'required',
            'idarticulo'=>'required',
            'numComprobante'=>'required|max:10',
            'cantidad'=>'required',
            // 'totalPagar'=>'required',
            // 'saldoPendiente'=>'required',
            'precioCompra'=>'required',
            'precioVenta'=>'required',
        ];
    }
}
