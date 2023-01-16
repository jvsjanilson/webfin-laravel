<?php

namespace App\Http\Requests;

use App\Models\Cidade;
use App\Models\Cliente;
use App\Models\Estado;
use Illuminate\Foundation\Http\FormRequest;

class ClienteFormRequest extends FormRequest
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
            'nome' => ['required'],
            'cpfcnpj' => [function($attribute, $value, $fail) {
                if ($value != "") {
                    $reg = Cliente::where('cpfcnpj', $value)->first();
                    if (isset($reg)) {
                        $fail("O :attribute já cadastrado.");
                    }
                }
            }],
            'estado_id' => ['required',
                function ($attribute, $value, $fail) {
                    $reg = Estado::find($value);
                    if (!isset($reg)){
                        $fail("O :attribute não existe.");
                    }
                }
            ],
            'cidade_id' => ['required',
                function ($attribute, $value, $fail) {
                    $reg = Cidade::find($value);
                    if (!isset($reg)){
                        $fail("O :attribute não existe.");
                    }
                }
            ],

        ];
    }

    public function attributes()
    {
        return [
            'nome'      => 'Nome do cliente',
            'cpfcnpj'   => 'CPF/CNPJ',
            'estado_id' => 'Estado',
            'cidade_id' => 'Cidade'
        ];
    }
}
