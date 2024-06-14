<?php

namespace App\Http\Controllers;

use App\Services\StatisticsService;

class StatisticsController extends Controller
{
    /**
     * Используется инъекция сервиса
     * @param StatisticsService $statisticsService
     */
    public function __construct(
        protected readonly StatisticsService $statisticsService
    ){
    }

    /**
     * Запрашивает массив со статистикой по проекта у сервиса
     * @return array
     */
    public function getStatistics(): array
    {
        return $this->statisticsService->full();
    }
}
