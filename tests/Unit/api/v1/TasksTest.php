<?php

namespace Tests\Unit\api\v1;

use App\Models\Project;
use App\Models\Task;
use App\Models\TimeTrack;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TasksTest extends TestCase
{
    /**
     * URI запроса
     * @var string
     */
    private string $uri = '/api/v1/tasks/';

    /**
     * Тестирует получение всех задач
     * @return void
     */
    public function testGetAllTasks(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->get($this->uri);
        $response->assertStatus(200);
        $this->assertEquals($response->getContent(), Task::all());
    }

    /**
     * Тестирует ограничение доступа к задачам
     * @return void
     */
    public function testSanctumAuthTasks(): void
    {
        $response = $this->get($this->uri);
        $response->assertStatus(302);

        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->get($this->uri);
        $response->assertStatus(200);
    }

    /**
     * Тестирует получение задачи по id
     * @return void
     */
    public function testGetTaskById(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $task = Task::factory()->create();
        $response = $this->get($this->uri . $task->id);
        $response->assertStatus(200);
    }

    /**
     * Тестирует добалвение новой задачи
     * @return void
     */
    public function testAddTask(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->post($this->uri, [
            'name' => fake()->text(100),
            'description' => fake()->text(),
            'project_id' => Project::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'time_estimate' => fake()->numberBetween(0, 9999999),
        ]);
        $response->assertStatus(200);
    }

    /**
     * Тестирует получение всех треков времени задачи
     * @return void
     */
    public function testGetTaskTracks(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $task = Task::factory()->create();
        TimeTrack::factory(10)->create(['task_id' => $task->id]);

        $response = $this->get($this->uri . $task->id . '/tracks');
        $response->assertStatus(200);
    }


    /**
     * Тестирует обновление данных задачи
     * @return void
     */
    public function testUpdateTask(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $task = Task::factory()->create();
        $response = $this->put($this->uri . $task->id, [
            'name' => 'Test task',
            'time_estimate' => $task->time_estimate,
            'description' => $task->description,
            'project_id' => $task->project_id,
            'user_id' => $task->user_id,
        ]);
        $response->assertStatus(200);

        $task->refresh();
        $this->assertEquals($task->name, 'Test task');
    }
}
