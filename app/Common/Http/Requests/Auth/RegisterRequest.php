<?php

namespace App\Common\Http\Requests\Auth;
use Illuminate\Foundation\Http\FormRequest;


class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute є обов\'язкове.',
            'max' => 'Довжина поля :attribute максимум 255 символів',
            'min' => 'Довжина поля :attribute не менше 6 символів',
            'email' => 'Введіть корректний email',
            'confirmed' => 'Поля неспівпадають',
            'unique' => 'Даний email вже зайнято',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}