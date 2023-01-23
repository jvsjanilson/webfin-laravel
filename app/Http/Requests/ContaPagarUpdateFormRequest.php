<?php

namespace App\Http\Requests;

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
        return false;
    }

 /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'documento'     => ['filled', 'max:30', "unique:conta_pagars,documento,except,$this->id"],
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
