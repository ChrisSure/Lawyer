<?php

namespace App\Cabinet\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use App\Common\Entity\User;

/**
 * @property User $user
 */
class UpdateMainRequest extends FormRequest
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
            'unique' => 'Даний email вже зайнято',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . $this->user->id,
        ];
    }
}