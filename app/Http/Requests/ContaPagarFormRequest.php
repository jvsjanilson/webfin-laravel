<?php

namespace App\Http\Requests;

use App\Models\Conta;
use App\Models\Fornecedor;
use Illuminate\Foundation\Http\FormRequest;

class ContaPagarFormRequest extends FormRequest
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
            'documento'     => ['required', 'max:30', 'unique:conta_pagars'],
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
            'fornecedor_id'    => ['required', 'integer',
                function($attribute, $value, $fail)
                {
                    $fornecedor = Fornecedor::find($value);
                    if (!isset($fornecedor))
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
            'fornecedor_id' => 'Fornecedor'
        ];
    }
}
