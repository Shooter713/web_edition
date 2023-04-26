<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'  => 'required',
            'image' => 'required',
            'tags'  => 'required',
            'text'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Поле Ім`я є обов`язковим',
            'image.required'    => 'Поле зображення є обов`язковим',
            'tags.required'     => 'Поле теги є обов`язковим',
            'text.required'     => 'Поле текст є обов`язковим'
        ];
    }

}
