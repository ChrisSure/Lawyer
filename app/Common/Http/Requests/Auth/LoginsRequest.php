<?php

namespace App\Common\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;


class LoginsRequest extends FormRequest
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
        ];
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|string',
            'password' => 'required|string',
        ];
    }
}