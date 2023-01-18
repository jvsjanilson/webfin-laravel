<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


class ContaUpdateFormRequest extends FormRequest
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
            'numero_banco' => ['max:3', 'regex:/^[A-Za-z0-9]*$/', 'filled'],
            'numero_agencia' => ['max:15','filled'],
            'numero_conta' => ['max:30', 'filled'],
            'descricao' => ['max:60', 'filled'],
            'tipo_conta' => [Rule::in(1,2), 'filled'],
            'data_abertura' => ['filled'],
        ];
    }

     public function attributes()
     {
         return [
             'numero_banco' => 'Número do Banco',
             'numero_agencia' => 'Número da Agencia',
             'numero_conta' => 'Número da Conta',
             'descricao' => 'Descrição',
             'tipo_conta' => 'Tipo de Conta',
             'data_abertura' => 'Data Abertura',
         ];
     }
}
