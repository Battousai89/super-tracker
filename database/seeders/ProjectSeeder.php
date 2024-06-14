<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'name' => 'Кастом Банк',
                'description' => 'Партнер с 2013 года. Имеет большую клиентскую базу. Сайт партнера https://google.gom'
            ],
            [
                'name' => 'Арматура34',
                'description' => 'Стек: Bitrix + Aspro. Зашел к нам на редизайн.'
            ],
            [
                'name' => 'Super Tracker',
                'description' => 'Проект этого сайта. Можно создавать задачи и трекать сюда время по его доработки.'
            ],
            [
                'name' => 'Супер Фитнес',
                'description' => 'Спортивный комплекс. Имеет большую клиентскую базу.'
            ],
            [
                'name' => 'Автометрик',
                'description' => 'Сайт, который собирает и отображает статистику по страницам в Google Page Speed'
            ]
        ];

        foreach ($projects as $project) {
            Project::firstOrCreate($project);
        }
    }
}
