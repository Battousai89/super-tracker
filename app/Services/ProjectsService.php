<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class ProjectsService
{
    /**
     * Возвращает все проекты
     * @return Collection
     */
    public function all(): Collection
    {
        return Project::all();
    }

    /**
     * Возвращает проект по ID
     * @param int $id
     * @return mixed
     */
    public function getById(int $id): mixed
    {
        $project = Project::whereId($id)->with('tasks')->first();

        foreach ($project->tasks as $task) {
            $task['created'] = Carbon::createFromDate($task->created_at)->format('Y-m-d H:i:s');
            $task['updated'] = Carbon::createFromDate($task->updated_at)->format('Y-m-d H:i:s');
        }

        return $project;
    }

    /**
     * Обновляет данные проекта
     * @param array $fields
     * @param int $id
     * @return bool|int
     */
    public function update(array $fields, int $id): bool|int
    {
        $project = Project::whereId($id)->first();
        return $project->update($fields);
    }

    /**
     * Создает проект
     * @param array $fields
     * @return mixed
     */
    public function create(array $fields): mixed
    {
        return Project::create($fields);
    }
}
