<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPostBloqueado extends FormRequest
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

     //regras para atualizar o estado(bloqueado) de um utilizador
    public function rules()
    {
        return [
            'bloqueado'   =>          'required|boolean',
        ];
    }
}
