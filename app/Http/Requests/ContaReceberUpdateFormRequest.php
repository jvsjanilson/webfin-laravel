<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use App\Models\Conta;
use Illuminate\Foundation\Http\FormRequest;

class ContaReceberUpdateFormRequest extends FormRequest
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
            'documento'     => ['filled', 'max:30', "unique:conta_recebers,documento,except,$this->id"],
            'emissao'       => ['filled'],
            'vencimento'    => ['filled'],
            'conta_id'      => ['filled', 'integer',
                function($attribute, $value, $fail)
                {
                    if ($value != "")
                    {
                        $conta = Conta::find($value);
                        if (!isset($conta))
                            $fail(":attribute não existe.");
                    }
                }
            ],
            'cliente_id'    => ['filled', 'integer',
                function($attribute, $value, $fail)
                {
                    if ($value != "")
                    {
                        $cliente = Cliente::find($value);
                        if (!isset($cliente))
                            $fail(":attribute não existe.");
                    }
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
