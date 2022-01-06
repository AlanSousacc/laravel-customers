<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NumberPreferenceRequest extends FormRequest
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
            'name'  => 'required|string',
            'value' => 'required|string',
        ];
    }

    public function messages()
    {
      return [
        'name.required'  => 'O campo Name é obrigatório!',
        'name.string'    => 'O campo Name deve ser uma string!',
        'value.required' => 'O campo Value é obrigatório!',
        'value.string'   => 'O campo Value deve ser uma string!',
      ];
    }
}
