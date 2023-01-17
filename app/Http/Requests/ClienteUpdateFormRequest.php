<?php

namespace App\Http\Requests;

use App\Fnc\Validador;
use App\Models\Cidade;
use App\Models\Cliente;
use App\Models\Estado;
use Illuminate\Foundation\Http\FormRequest;

class ClienteUpdateFormRequest extends FormRequest
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
            'cpfcnpj' => [function($attribute, $value, $fail) {
                if ($value != "") {
                    $reg = Cliente::where('cpfcnpj', $value)->first();
                    if (isset($reg)) {
                        $fail("O :attribute já cadastrado.");
                    }

                    if (!Validador::cpfcnpj($value)) {
                        $fail("O :attribute inválido.");
                    }
                }
            }],
            'estado_id' => [
                function ($attribute, $value, $fail) {
                    if ($value != "") {
                        $reg = Estado::find($value);
                        if (!isset($reg)){
                            $fail("O :attribute não existe.");
                        }
                    }
                }
            ],
            'cidade_id' => [
                function ($attribute, $value, $fail) {
                    if ($value != "") {
                        $reg = Cidade::find($value);
                        if (!isset($reg)){
                            $fail("O :attribute não existe.");
                        }
                    }
                }
            ],
        ];
    }

    public function attributes()
    {
        return [
            'cpfcnpj'   => 'CPF/CNPJ',
            'estado_id' => 'Estado',
            'cidade_id' => 'Cidade'
        ];
    }
}
