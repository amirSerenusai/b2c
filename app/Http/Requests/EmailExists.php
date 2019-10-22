<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailExists extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'exists:users'
        ];
    }

    public function messages()
    {
        return [
            'email.exists:users' => 'A title exists is required',

        ];
    }
}
