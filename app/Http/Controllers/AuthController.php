<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginForm;
use App\Http\Requests\RegisterForm;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Авторизует пользователя и отдает токен
     * @param LoginForm $request
     * @return JsonResponse|string
     */
    public function login(LoginForm $request): JsonResponse|string
    {
        $user = User::whereEmail($request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['errors' => [ 'email' => ["Пользователь не найден, либо данные введены не правильно"]]], 422);
        }

        return $user->createToken($request->email)->plainTextToken;
    }

    /**
     * Регистрирует пользователя в системе
     * и перенаправляет на страницу авторизации
     * @param RegisterForm $request
     * @return RedirectResponse
     */
    public function register(RegisterForm $request): RedirectResponse
    {
        User::create($request->validated());
        return redirect()->intended('/login');
    }

    /**
     * Удаляет все активные токены авторизации пользователя
     * и перенаправляет на страницу авторизации
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        auth()->user()->tokens()->delete();
        return redirect()->intended('/login');
    }

    /**
     * Проверяет авторизован ли пользователь
     * @return bool
     */
    public function check(): bool
    {
        return auth()->check();
    }
}
