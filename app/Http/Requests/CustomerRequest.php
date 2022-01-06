<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name'      => 'required|string',
            'document'  => 'required|min:6|max:12',
        ];
    }

    public function messages()
    {
      return [
        'name.required'     => 'O campo Name é obrigatório!',
        'name.string'       => 'O campo Name deve ser uma string!',
        'document.required' => 'O campo Document é obrigatório!',
        'document.min'      => 'O campo Document deve conter pelo menos 6 caracteres!',
        'document.max'      => 'O campo Document deve conter no máximo 12 caracteres!',
      ];
    }
}
