<?php

namespace App\Services;

use App\Models\TimeTrack;

class TracksService
{
    /**
     * Создает трек времени
     * @param array $fields
     * @return mixed
     */
    public function create(array $fields): mixed
    {
        $fields['user_id'] = auth()->user()->id;
        return TimeTrack::create($fields);
    }
}
