<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TimeTrack;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class TasksService
{
    /**
     * Возвращает все задачи
     * @return Collection
     */
    public function all(): Collection
    {
        return Task::all();
    }

    /**
     * Возвращает задачу по id
     * @param int $id
     * @return mixed
     */
    public function getById(int $id): mixed
    {
        $task = Task::whereId($id)->with('project', 'tracks', 'executor')->first();
        $task['executor_name'] = isset($task->executor) ? $task->executor->name : 'Нет';
        $task['created'] = Carbon::createFromDate($task->created_at)->format('Y-m-d H:i:s');
        $task['updated'] = Carbon::createFromDate($task->updated_at)->format('Y-m-d H:i:s');

        $task['spent_time'] = 0;
        foreach ($task->tracks as $track) {
            $task['spent_time'] += $track->spent_time;
        }

        $task['is_expired'] = $task['spent_time'] > $task['time_estimate'];
        $task['formated_time_estimate'] = HelperService::secToStr($task->time_estimate);
        $task['formated_spent_time'] = HelperService::secToStr($task['spent_time']);
        return $task;
    }

    /**
     * Возвращает все треки времени по задаче
     * @param int $id
     * @return Collection
     */
    public function getTrackForTask(int $id): Collection
    {
        $tracks = TimeTrack::whereTaskId($id)->with('user')->get();

        foreach ($tracks as $track) {
            $track['created'] = Carbon::createFromDate($track->created_at)->format('Y-m-d H:i:s');
            $track['updated'] = Carbon::createFromDate($track->updated_at)->format('Y-m-d H:i:s');
            $track['explanation'] = empty($track['explanation']) ? 'Без комментария' : $track['explanation'];
            $track['formated_spent_time'] = HelperService::secToStr($track['spent_time']);
        }

        return $tracks;
    }

    /**
     * Создает задачу
     * @param array $fields
     * @return mixed
     */
    public function create(array $fields): mixed
    {
        $fields['user_id'] = $fields['user_id'] ?? null;
        return Task::create($fields);
    }

    /**
     * Обновляет данные задачи
     * @param array $fields
     * @param int $id
     * @return bool|int
     */
    public function update(array $fields, int $id): bool|int
    {
        $task = Task::whereId($id)->first();
        return $task->update($fields);
    }
}
