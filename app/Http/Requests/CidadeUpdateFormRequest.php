<?php

namespace App\Http\Requests;

use App\Exceptions\ExceptionNotFound;
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
            'nome' => [
                function($attribute, $value, $fail)
                {
                    if ($value == "") {

                        $fail("O :attribute não pode ser vazio.");
                    }
                }
            ],
            'estado_id' => [
                function($attribute, $value, $fail)
                {
                    if ($value == "") {

                        $fail("O :attribute não pode ser vazio.");
                    } else {
                        $estado = Estado::find($value);
                        if (!isset($estado))
                            $fail("Estado não é valido.");
                    }
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
