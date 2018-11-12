<?php

namespace App\Cabinet\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;


class UpdateProfileRequest extends FormRequest
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:12',
        ];
    }
}