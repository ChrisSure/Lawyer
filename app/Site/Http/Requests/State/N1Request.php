<?php

namespace App\Site\Http\Requests\State;

use Illuminate\Foundation\Http\FormRequest;


class N1Request extends FormRequest
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
            'integer' => 'Поле :attribute повинно бути числом',
            'date' => 'Поле :attribute повинно бути корректною датою'
        ];
    }

    public function rules(): array
    {
        return [
            'law' => 'required|string|max:255',
            'p_name' => 'required|string|max:255',
            'p_address' => 'required|string|max:255',
            'v_name' => 'required|string|max:255',
            'v_address' => 'required|string|max:255',
            'price_claim' => 'required|integer',
            'price_give' => 'required|integer',
            'date_give' => 'required|date|max:255',
            'circum' => 'required|string',
        ];
    }
}