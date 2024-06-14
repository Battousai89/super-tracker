<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrackForm extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'spent_time' => 'required|integer|between:0,10000000',
            'task_id' => 'required|integer|exists:tasks,id',
            'explanation' => 'string|nullable',
        ];
    }

    /**
     * Массив сообщений об ошибках
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'date.required' => 'Это обязательное поле обязательно',
            'date.date' => 'Неверный формат даты',
            'spent_time.required' => 'Это обязательное поле',
            'spent_time.integer' => 'Время должно быть в минутах',
            'spent_time.between' => 'Значение должно находиться в диапозоне от 0 до 10000000',
            'task_id.required' => 'Должно быть указано id задача',
            'task_id.integer' => 'Задача передана в неверном формате',
        ];
    }
}
