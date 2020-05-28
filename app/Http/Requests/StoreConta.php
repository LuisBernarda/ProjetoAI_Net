<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StoreConta extends FormRequest
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
    {   //dd($this->conta->user_id);
        return [

            'descricao' => 'nullable',
            'saldo_atual' => 'numeric',
            'saldo_abertura' => 'required|numeric',
            'nome' => [Rule::unique('contas')->where(function ($query) {
                return $query->where('user_id', Auth::user()->id)->where('id', '<>', $this->conta->id);
            }),'required', 'max:20']
        ];
    }
}
