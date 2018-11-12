<?php

namespace App\Cabinet\Http\Requests\Articles;

use Illuminate\Foundation\Http\FormRequest;
use App\Common\Entity\Articles;

/**
 * @property Articles $article
 */
class UpdateArticlesRequest extends FormRequest
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
            'unique' => 'Дане ім\'я вже зайнято',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:articles,name,' . $this->article->id,
            'text' => 'required|string',
        ];
    }
}