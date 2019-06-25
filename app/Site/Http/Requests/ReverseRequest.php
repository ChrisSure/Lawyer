<?php

namespace App\Site\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ReverseRequest extends FormRequest
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
        ];
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'text' => 'required|string',
        ];
    }
}