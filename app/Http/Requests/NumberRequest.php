<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NumberRequest extends FormRequest
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
            'number'  => 'required|min:8|max:14|string',
        ];
    }

    public function messages()
    {
      return [
        'number.required' => 'O campo Number é obrigatório!',
        'number.string'   => 'O campo Number deve ser uma string!',
        'number.min'      => 'O campo Number deve conter pelo menos 8 caracteres!',
        'number.max'      => 'O campo Number deve conter no máximo 14 caracteres!',
      ];
    }
}
