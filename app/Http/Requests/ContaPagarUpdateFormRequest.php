<?php

namespace App\Http\Requests;

use App\Models\ContaPagar;
use App\Models\Conta;
use App\Models\Fornecedor;
use Illuminate\Foundation\Http\FormRequest;

class ContaPagarUpdateFormRequest extends FormRequest
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
                        $reg = ContaPagar::where($attribute, $value)
                            ->where('conta_pagars.id', '<>', $this->route('contapagar'))
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
            'fornecedor_id'    => ['filled', 'integer',
                function($attribute, $value, $fail)
                {
                    if ($value != "")
                    {
                        $fornecedor = Fornecedor::find($value);
                        if (!isset($fornecedor))
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
            'fornecedor_id' => 'Fornecedor'
        ];
    }
}
