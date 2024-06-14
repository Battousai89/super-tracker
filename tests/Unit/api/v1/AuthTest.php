<?php

namespace Tests\Unit\api\v1;

use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * URI запроса
     * @var string
     */
    private string $uri = '/api/v1/auth/';

    /**
     * Тестирует весь функционал регистрации и авторизации
     * @return void
     */
    public function testAuth(): void
    {
        $email = fake()->unique()->email;

        //Register
        $response = $this->post($this->uri . 'register', [
            'name' => fake()->name(),
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertStatus(302);
        $this->assertNotNull(User::whereEmail($email)->first());

        //Login
        $response = $this->post($this->uri . 'login', [
            'email' => $email,
            'password' => 'password',
        ]);
        $response->assertStatus(200);
        $token = $response->content();

        //Check
        $response = $this->get($this->uri . 'check', [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
            'X-CSRF-Token' => csrf_token(),
        ]);
        $response->assertStatus(200);
        $this->assertEquals($response->getContent(), 1);

        //Logout
        $response = $this->get($this->uri . 'logout', [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
            'X-CSRF-Token' => csrf_token(),
        ]);
        $response->assertStatus(302);
    }
}
