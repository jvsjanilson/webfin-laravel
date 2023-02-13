<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContaFormRequest extends FormRequest
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
            'numero_banco' => ['required', 'max:4'],
            // 'numero_banco' => ['required', 'max:4', 'regex:/^[A-Za-z0-9]*$/'],
            'numero_agencia' => ['required', 'max:15'],
            'numero_conta' => ['required', 'max:30'],
            'descricao' => ['required', 'max:60'],
            'tipo_conta' => ['required', Rule::in(1,2)],
            'data_abertura' => ['required'],


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
