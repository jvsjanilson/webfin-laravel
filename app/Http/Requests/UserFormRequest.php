<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'name' => ['required', 'max:60'],
            'email' => ['required', 'email', 'max:60', 'unique:users'],
            'password' => ['required','string', 'min:8'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nome do usuário',
            'email' => 'E-mail',
            'password' => 'Senha'
        ];
    }
}
