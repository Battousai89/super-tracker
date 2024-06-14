<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TimeTrack;
use Illuminate\Database\Seeder;

class TimeTrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taskIds = Task::query()->pluck('id')->toArray();

        $tracks = [
            [
                'explanation' => 'Писал супер крутой код.',
                'spent_time' => 7200
            ],
            [
                'explanation' => 'Изучал документацию по проекту.',
                'spent_time' => 3600
            ],
            [
                'explanation' => 'Тестировал решение, исправлял ошибки.',
                'spent_time' => 12000
            ],
            [
                'explanation' => 'Обсуждение задачи с Висилием',
                'spent_time' => 6500
            ],
            [
                'explanation' => 'Оценивал задачу.',
                'spent_time' => 100000
            ],
            [
                'explanation' => 'Ничего не делал, просто так затрекал.',
                'spent_time' => 25000
            ],
        ];

        foreach ($taskIds as $taskId) {
            for ($i = 0; $i < 5; $i++) {
                $track = fake()->randomElement($tracks);
                TimeTrack::factory()->create([
                    'task_id' => $taskId,
                    'spent_time' => $track['spent_time'],
                    'explanation' => $track['explanation'],
                ]);
            }
        }
    }
}
