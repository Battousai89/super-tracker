<?php

namespace App\Services;

use App\Models\Task;

class StatisticsService
{
    /**
     * Генерирует статистику по всем проектам и их задачам
     * @return array
     */
    public function full(): array
    {
        $tasks = Task::with('tracks', 'project')->get();

        $projects = [];
        foreach ($tasks as $task) {
            $projects[$task->project->id]['spent_time'] = $projects[$task->project->id]['spent_time'] ?? 0;
            $projects[$task->project->id]['name'] = $projects[$task->project->id]['name'] ?? $task->project->name;
            $projects[$task->project->id]['tasks'][$task->id]['spent_time'] = 0;
            $projects[$task->project->id]['tasks'][$task->id]['name'] = $task->name;

            foreach ($task->tracks as $track) {
                $projects[$task->project->id]['tasks'][$task->id]['spent_time'] += $track->spent_time;
                $projects[$task->project->id]['spent_time'] += $track->spent_time;
            }
            $projects[$task->project->id]['tasks'][$task->id]['formated_spent_time'] = HelperService::secToStr($projects[$task->project->id]['tasks'][$task->id]['spent_time']);
        }

        foreach ($projects as &$project) {
            $project['formated_spent_time'] = HelperService::secToStr($project['spent_time']);
        }

        return $projects;
    }
}
