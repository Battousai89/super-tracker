<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterForm extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * Массив сообщений об ошибках
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Поле обязательное',
            'name.string' => 'Поле должно быть строкой',
            'name.max' => 'Слишком длинное имя',
            'email.required' => 'Поле обязательное',
            'email.string' => 'Поле должно быть строкой',
            'email.email' => 'Неверный формат Email',
            'email.unique' => 'Пользователь с таким Email уже зарегистрирован',
            'email.max' => 'Поле должно содержать не больше 255 символов',
            'password.required' => 'Поле обязательное',
            'password.string' => 'Пароль должен быть строкой',
            'password.min' => 'Пароль должен содержать не менее 8 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ];
    }
}
