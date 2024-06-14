<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectForm extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'name' => 'required|string|max:255',
           'description' => 'max:500',
        ];
    }

    /**
     * Массив сообщений об ошибках
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Название проекта обязательно',
            'name.string' => 'Название должно быть строкой',
            'name.max' => 'Название не должно превышать 255 символов',
            'description.max' => 'Описание не должно превышать 500 символов',
        ];
    }
}
