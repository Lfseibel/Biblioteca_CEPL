<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            
            'author' => ['required', 'string','max:255', 'min:3'],
            'year' => ['required'],
            'image' => ['nullable', 'image', 'max: 1024',],
            'gender' => ['required']
        ];

        
        return $rules;
    }

    public function messages()
    {
        return ['name.required' => 'Nome precisa ser preenchido',];
    }
}
