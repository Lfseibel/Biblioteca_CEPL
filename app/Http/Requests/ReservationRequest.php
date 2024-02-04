<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'user_name' => ['required',],
            
            'devolutionDate' => ['required', 'date'],
        ];

        return $rules;
    }

    public function messages()
    {
        return ['user_name.required' => 'Nome precisa ser preenchido', 'devolutionDate.required' => 'Data de devolução é necessário'];
    }
}
