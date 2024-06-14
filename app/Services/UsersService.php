<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UsersService
{
    /**
     * Возвращает всех пользователей системы
     * @return Collection
     */
    public function all(): Collection
    {
        return User::all();
    }
}
