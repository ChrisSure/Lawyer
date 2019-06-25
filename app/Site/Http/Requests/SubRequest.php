<?php

namespace App\Site\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class SubRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute є обов\'язкове.',
            'email' => 'Введіть корректний email',
            'unique' => 'Даний email вже зайнято',
        ];
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|string|unique:sub'
        ];
    }
}