<?php

namespace App\Http\Requests;

use App\Models\Estado;
use Illuminate\Foundation\Http\FormRequest;

class EstadoFormRequest extends FormRequest
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
           'uf' => ['required', 'max:2', function($attribute, $value, $fail){
                if ($value != "")
                {
                    $reg = Estado::where('uf', $value)->first();
                    if (isset($reg)) {
                        $fail("O :attribute já cadastrado.");
                    }
                }
           }],
           'nome' => ['required', 'max:120']
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
