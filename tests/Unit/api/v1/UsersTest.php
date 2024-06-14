<?php

namespace Tests\Unit\api\v1;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * URI запроса
     * @var string
     */
    private string $uri = '/api/v1/users/';

    /**
     * Тестирует получение всех пользователей системы
     * @return void
     */
    public function testGetAllUsers(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->get($this->uri);
        $response->assertStatus(200);
        $this->assertEquals($response->getContent(), User::all());
    }

    /**
     * Тестирует ограничение доступа к пользователям системы
     * @return void
     */
    public function testSanctumAuthUsers(): void
    {
        $response = $this->get($this->uri);
        $response->assertStatus(302);

        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->get($this->uri);
        $response->assertStatus(200);
    }
}
