<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use App\Models\Conta;
use App\Models\ContaReceber;
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
            'documento'     => ['filled', 'max:30', 
                function($attribute, $value, $fail)
                {
                    
                    if ($value != "") {
                        $reg = ContaReceber::where($attribute, $value)
                            ->where('conta_recebers.id', '<>', $this->route('contareceber'))
                            ->first();

                        if (isset($reg)) {
                            $fail("A :attribute já cadastrado.");
                        }
                    }
                },
        ],
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
