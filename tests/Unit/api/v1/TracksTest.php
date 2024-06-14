<?php

namespace Tests\Unit\api\v1;

use App\Models\Task;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TracksTest extends TestCase
{
    /**
     * URI запроса
     * @var string
     */
    private string $uri = '/api/v1/tracks/';

    /**
     * Тестирует добавление нового трека времени
     * @return void
     */
    public function testAddTrack(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $taskId = Task::factory()->create()->id;
        $response = $this->post($this->uri, [
            'user_id' => User::factory()->create(),
            'task_id' => $taskId,
            'explanation' => fake()->text(255),
            'date' => fake()->date(),
            'spent_time' => fake()->numberBetween(0, 9999999),
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure(["success"]);
    }
}
