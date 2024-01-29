<?php

namespace App\Http\Controllers;

use App\DTO\PlaceData;
use App\DTO\ResponseData;
use App\Http\Requests\PlaceRequest;
use App\Http\Resources\PlaceCollection;
use App\Http\Resources\PlaceResource;
use App\Repositories\PlaceRepository;
use App\Services\PlaceService;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Response;

class PlaceController
{
    private PlaceRepository $placeRepository;
    private PlaceService $placeService;
    public const NOT_FOUND_MESSAGE = 'Place Not found';

    public function __construct(PlaceRepository $placeRepository, PlaceService $placeService)
    {
        $this->placeRepository = $placeRepository;
        $this->placeService = $placeService;
    }

    public function getAll(Request $request): PlaceCollection
    {
        return new PlaceCollection($this->placeRepository->getAll($request->roomId));
    }

    public function getById(Request $request): PlaceResource
    {
        return new PlaceResource($this->placeRepository->getById($request->placeId));
    }

    public function create(PlaceRequest $request): ResponseData
    {
        $input = $request->validated();

        $newPlace = new PlaceData();
        $newPlace->setName($input['name']);
        $newPlace->setScheme($input['scheme']);
        $newPlace->setRoomId($request->roomId);

        if ($newPlace = $this->placeService->create($newPlace)) {
            return ResponseData::success(['id' => $newPlace->id]);
        }

        return ResponseData::fail('Impossible to add a place in the meeting room', []);
    }

    public function update(PlaceRequest $request): ResponseData
    {
        $input = $request->validated();

        $updatePlace = new PlaceData();
        $updatePlace->setName($input['name']);
        $updatePlace->setScheme($input['scheme']);
        $updatePlace->setRoomId($request->roomId);

        if ($updatePlace = $this->placeService->update($updatePlace)) {
            return ResponseData::success(['id' => $updatePlace->id]);
        }

        return ResponseData::fail('Impossible to add a place in the meeting room', []);
    }

    public function delete(Request $request): Response|ResponseData
    {
        $isSuccess = $this->placeRepository->delete($request->placeId);

        if ($isSuccess) {
            return ResponseData::success([]);
        }

        return response(ResponseData::fail(self::NOT_FOUND_MESSAGE, []), 404);
    }
}
