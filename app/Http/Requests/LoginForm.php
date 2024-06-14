<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginForm extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ];
    }

    /**
     * Массив сообщений об ошибках
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Поле обязательное',
            'email.string' => 'Поле должно быть строкой',
            'email.email' => 'Неверный формат Email',
            'email.max' => 'Поле должно содержать не больше 255 символов',
            'password.required' => 'Поле обязательное',
            'password.string' => 'Поле должно быть строкой',
            'password.min' => 'Поле должно содержать не менее 8 символов',
        ];
    }
}
