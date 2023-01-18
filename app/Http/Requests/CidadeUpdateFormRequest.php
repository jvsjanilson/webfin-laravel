<?php

namespace App\Http\Requests;


use App\Models\Estado;
use Illuminate\Foundation\Http\FormRequest;

class CidadeUpdateFormRequest extends FormRequest
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
            'nome' => ['filled', 'max:60'],
            'estado_id' => ['integer', 'filled',
                function($attribute, $value, $fail)
                {
                    $estado = Estado::find($value);
                    if (!isset($estado))
                        $fail("Estado não é valido.");
                }
            ]
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome da cidade',
            'estado_id' => 'Estado'
        ];
    }
}
