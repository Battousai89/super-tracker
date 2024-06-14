<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskForm;
use App\Services\TasksService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class TasksController extends Controller
{
    /**
     * Используется инъекция сервиса
     * @param TasksService $tasksService
     */
    public function __construct(
        protected readonly TasksService $tasksService
    ){
    }

    /**
     * Запрашивает все задачи у сервиса
     * @return Collection
     */
    public function getTasks(): Collection
    {
        return $this->tasksService->all();
    }

    /**
     * Запршивает задачу по id у сервиса
     * @param $id
     * @return mixed
     */
    public function getTask($id): mixed
    {
        return $this->tasksService->getById((int)$id);
    }

    /**
     * Запрашивает все треки времени по задаче через сервис
     * @param $id
     * @return Collection
     */
    public function getTaskTracks($id): Collection
    {
        return $this->tasksService->getTrackForTask((int)$id);
    }

    /**
     * Отправляет данные задача на добавление новой записи через сервис
     * @param TaskForm $request
     * @return JsonResponse
     */
    public function addTask(TaskForm $request): JsonResponse
    {
        if ($this->tasksService->create($request->validated())) {
            return response()->json(['success' => true], 200);
        }

        return response()->json(['errors' => 'Не удалось создать задачу']);
    }

    /**
     * Отправляет данные задачи на сохранение через сервис
     * @param TaskForm $request
     * @param $id
     * @return JsonResponse
     */
    public function saveTask(TaskForm $request, $id): JsonResponse
    {
        if ($this->tasksService->update($request->validated(), (int)$id)) {
            return response()->json(['success' => true], 200);
        }

        return response()->json(['errors' => 'Не удалось сохранить данные в базе']);
    }
}
