<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use App\Models\Conta;
use Illuminate\Foundation\Http\FormRequest;

class ContaReceberFormRequest extends FormRequest
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
            'documento'     => ['required', 'max:30', 'unique:conta_recebers'],
            'emissao'       => ['required'],
            'vencimento'    => ['required'],
            'conta_id'      => ['required', 'integer',
                function($attribute, $value, $fail)
                {
                    $conta = Conta::find($value);
                    if (!isset($conta))
                        $fail(":attribute não existe.");
                }
            ],
            'cliente_id'    => ['required', 'integer',
                function($attribute, $value, $fail)
                {
                    $cliente = Cliente::find($value);
                    if (!isset($cliente))
                        $fail(":attribute não existe.");
                }
            ],
        ];
    }

    public function attributes()
    {
        return [
            'documento'     => 'Documento',
            'emissao'       => 'Data Emissão',
            'vencimento'    => 'Data Vencimento',
            'conta_id'      => 'Conta',
            'cliente_id'    => 'Cliente'
        ];
    }
}
