<?php

namespace Tests\Unit\api\v1;

use App\Models\Project;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    /**
     * URI запроса
     * @var string
     */
    private string $uri = '/api/v1/projects/';

    /**
     * Тестирует получение всех проектов
     * @return void
     */
    public function testGetAllProjects(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->get($this->uri);
        $response->assertStatus(200);
        $this->assertEquals($response->getContent(), Project::all());
    }

    /**
     * Тестирует ограничение доступа к проктам
     * @return void
     */
    public function testSanctumAuthProjects(): void
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
     * Тестирует получение проекта по id
     * @return void
     */
    public function testGetProjectById(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $project = Project::factory()->create();
        $response = $this->get($this->uri . $project->id);
        $response->assertStatus(200);

        $this->assertEquals($response->getContent(), Project::whereId($project->id)->with('tasks')->first()->toJson());
    }

    /**
     * Тестирует добавление нового проекта
     * @return void
     */
    public function testAddProject(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->post($this->uri, [
            'name' => fake()->text(100),
            'description' => fake()->text(),
        ]);
        $response->assertStatus(200);
    }

    /**
     * Тестирует обновление данных проекта
     * @return void
     */
    public function testUpdateProject(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $project = Project::factory()->create();
        $response = $this->put($this->uri . $project->id, [
            'name' => 'Test project',
            'description' => $project->description,
        ]);
        $response->assertStatus(200);

        $project->refresh();
        $this->assertEquals($project->name, 'Test project');
    }
}
