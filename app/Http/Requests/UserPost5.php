<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPost5 extends FormRequest
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
    //regras para atualizar as passwords de um utilizador!!
    public function rules()
    {
        return [
            'oldPassword' =>   ['required', 'string'],
            'newPassword' =>   ['required', 'string', 'min:8'],
            'confPassword' =>   ['required', 'string', 'min:8'],
        ];
    }
}

