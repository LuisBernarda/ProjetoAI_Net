<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Conta;

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
    {
        return [

            'descricao' => 'nullable',
            'saldo_atual' => 'numeric',
            'saldo_abertura' => 'required|numeric',
            'nome' => Rule::unique('contas')->ignore($this->conta),'required','max:20'
        ];
    }
}

//'required','max:20',Rule::unique('contas')->ignore($this->name),

// Rule::exists('users', 'id')->where(function ($query) use ($variable) {
//                 $query->where('admin_id', $variable);
//             }),



//->ignore($this)
// 'nome' => [Rule::unique('contas')->where(function ($query) {
//                 return $query->where('user_id', Auth::user()->id)->where('nome', '<>', $this->nome);}
//->where('nome', '<>', $this->nome)