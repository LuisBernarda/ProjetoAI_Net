<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovimento extends FormRequest
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
        // if (old('valor') > 'valor') {
        //     dd("Valor é menor");
        // }

        return [
            'data'=>'date|required',
            'valor'=>'numeric|required',
            'tipo'=>'required|string',
            'descricao' => 'nullable',
            'categoria' => 'nullable|numeric'
        ];

    }
}
