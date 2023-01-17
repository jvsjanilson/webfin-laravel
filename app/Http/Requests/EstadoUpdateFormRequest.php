<?php

namespace App\Http\Requests;

use App\Exceptions\ExceptionNotFound;
use App\Models\Estado;
use Illuminate\Foundation\Http\FormRequest;

class EstadoUpdateFormRequest extends FormRequest
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
            'uf' => [
                function($attribute, $value, $fail)
                {
                    if ($value == "") {
                        $fail("O :attribute não pode ser vazio.");
                    }
                },

                function($attribute, $value, $fail)
                {
                    if ($value != "") {
                        $reg = Estado::where($attribute, $value)
                            ->where('estados.id', '<>', $this->route('estado'))
                            ->first();

                        if (isset($reg)) {
                            $fail("A :attribute já cadastrado.");
                        }
                    }
                },
            ],
            'nome' => [
                function($attribute, $value, $fail)
                {
                    if ($value == "") {

                        $fail("O :attribute não pode ser vazio.");
                    }
                }
            ]
        ];
    }

    public function attributes()
    {
        return [
            'uf' => 'UF',
            'nome' => 'Nome'
        ];
    }
}
