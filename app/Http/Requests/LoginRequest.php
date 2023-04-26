<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'    => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'Поле email є обов`язковим',
            'password.required' => 'Поле пароль є обов`язковим'
        ];
    }

}
