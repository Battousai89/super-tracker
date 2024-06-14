<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectIds = Project::query()->pluck('id')->toArray();

        $tasks = [
            [
                'name' => 'Исправить заголовок страницы',
                'description' => 'На странице https://google.com необходимо исправить опечатку в названии страницы.'
            ],
            [
                'name' => 'Скрыть кнопку',
                'description' => 'На странице https://google.com необходимо скрыть кнопку, отображающую меню.'
            ],
            [
                'name' => 'Добавить новый способ оплаты',
                'description' => 'Необходимо интегрировать модуль оплаты нового партнера на сайт и проверить его работу.'
            ],
            [
                'name' => 'Развернуть dev-среду проекта',
                'description' => 'Развернуть песочницу для разработки.'
            ],
            [
                'name' => 'Провести полное тестирование сайта',
                'description' => 'Выполнить тестрирование сайта и сформировать баг-репорт.'
            ],
        ];

        foreach ($projectIds as $projectId) {
            for ($i = 0; $i < 10; $i++) {
                $task = fake()->randomElement($tasks);
                Task::factory()->create([
                    'project_id' => $projectId,
                    'name' => $task['name'],
                    'description' => $task['description']
                ]);
            }
        }
    }
}
