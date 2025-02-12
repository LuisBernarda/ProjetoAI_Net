<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UserPost extends FormRequest
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
           
           // 'name' =>[
           // 
           // Rule::required()->ignore($this->user),
           // ]
            //'password' =>       'required',
            //'adm'   =>          'required|boolean',
            'bloqueado' =>      'required|boolean',
            'NIF'   =>          'nullable|integer',
            'telefone' =>       'nullable',
            'foto' =>           'nullable|image|max:8192',
            'email' => [
               'required',
               'email',
               Rule::unique('users')->ignore($this->user)],
            
        ];
    }

    
}
