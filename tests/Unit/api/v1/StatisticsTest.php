<?php

namespace Tests\Unit\api\v1;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StatisticsTest extends TestCase
{
    /**
     * URI запроса
     * @var string
     */
    private string $uri = '/api/v1/statistics/';

    /**
     * Тестирует получение статистики по проектам
     * @return void
     */
    public function testGetStatistics(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->get($this->uri);
        $response->assertStatus(200);
    }

    /**
     * Тестирует ограничение доступа к статистики
     * @return void
     */
    public function testSanctumAuthStatistics(): void
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
