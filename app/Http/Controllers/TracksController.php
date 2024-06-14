<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackForm;
use App\Services\TracksService;
use Illuminate\Http\JsonResponse;

class TracksController extends Controller
{
    /**
     * Использует инъекцию сервиса
     * @param TracksService $tracksService
     */
    public function __construct(
        protected readonly TracksService $tracksService
    ){
    }

    /**
     * Отправляет данные трека времени на сохранение через сервис
     * @param TrackForm $request
     * @return JsonResponse
     */
    public function addTrack(TrackForm $request): JsonResponse
    {
        if ($this->tracksService->create($request->validated())) {
            return response()->json(['success' => true], 200);
        }

        return response()->json(['errors' => 'Не удалось создать задачу']);
    }

}
