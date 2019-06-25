<?php

namespace App\Admin\Http\Requests\Reverse;

use Illuminate\Foundation\Http\FormRequest;


class MailCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'text' => 'required|string',
        ];
    }
}