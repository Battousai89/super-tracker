<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectForm;
use App\Services\ProjectsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class ProjectsController extends Controller
{
    /**
     * Используется инъекция сервиса
     * @param ProjectsService $projectsService
     */
    public function __construct(
        protected readonly ProjectsService $projectsService
    ){
    }

    /**
     * Запрашивает все проекты у сервиса
     * @return Collection
     */
    public function getProjects(): Collection
    {
        return $this->projectsService->all();
    }


    /**
     * Запрашивает проект по id у сервиса
     * @param $id
     * @return mixed
     */
    public function getProject($id): mixed
    {
        return $this->projectsService->getById((int)$id);
    }


    /**
     * Отправляет данные проекта на сохранение через сервис
     * @param ProjectForm $request
     * @param $id
     * @return JsonResponse
     */
    public function saveProject(ProjectForm $request, $id): JsonResponse
    {
        if ($this->projectsService->update($request->validated(), (int)$id)) {
            return response()->json(['success' => true], 200);
        }

        return response()->json(['errors' => 'Не удалось сохранить данные в базе']);
    }

    /**
     * Отправляет данные проекта на создание новой записи через сервис
     * @param ProjectForm $request
     * @return JsonResponse
     */
    public function addProject(ProjectForm $request): JsonResponse
    {
        if ($this->projectsService->create($request->validated())) {
            return response()->json(['success' => true], 200);
        }

        return response()->json(['errors' => 'Не удалось добавить проект']);
    }
}
