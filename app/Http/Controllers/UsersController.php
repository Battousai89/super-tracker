<?php

namespace App\Http\Controllers;

use App\Services\UsersService;
use Illuminate\Database\Eloquent\Collection;

class UsersController extends Controller
{
    /**
     * Использует инъекцию сервиса
     * @param UsersService $usersService
     */
    public function __construct(
        protected readonly UsersService $usersService
    ){
    }

    /**
     * Запрашивает всех пользователей у сервиса
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return $this->usersService->all();
    }
}
