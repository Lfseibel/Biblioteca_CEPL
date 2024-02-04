<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
       

        $rules =[
            'name' => 'required|string|max:255|min:3',
            'number' => ['required','unique:authors'],
            
        ];

        
        return $rules;
    }

    public function messages()
    {
        return ['name.required' => 'Nome precisa ser preenchido', 'name.min' => 'Nome precisa ter no minimo 3 caracteres', 'name.max' => 'Nome pode ter no maximo 255 caracteres', 
        'number.required' => 'Número é necessário'];
    }
}
