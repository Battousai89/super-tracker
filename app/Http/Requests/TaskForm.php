<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskForm extends FormRequest
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
            'description' => 'required|max:500|min:25',
            'project_id' => 'required|integer|exists:projects,id',
            'user_id' => 'integer|nullable|exists:users,id',
            'time_estimate' => 'required|integer|between:0,10000000',
        ];
    }

    /**
     * Массив сообщений об ошибках
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Название задачи обязательно',
            'name.string' => 'Название должно быть строкой',
            'name.max' => 'Название не должно превышать 255 символов',
            'description.required' => 'Это обязательное поле',
            'description.max' => 'Описание не должно превышать 500 символов',
            'description.min' => 'Описание должно содержать не менее 25 символов',
            'project_id.required' => 'Должен быть выбран проект',
            'project_id.integer' => 'Должен быть выбран корректный проект',
            'user_id.exists' => 'Выбранный пользователь отсутствует в системе',
            'user_id.integer' => 'Id пользователя должно быть целочисленным',
            'time_estimate.required' => 'Это поле обязательное',
            'time_estimate.integer' => 'Значение должно быть целочисленным',
            'time_estimate.between' => 'Значение должно быть в диапозоне от 0 до 10000000',
        ];
    }
}
