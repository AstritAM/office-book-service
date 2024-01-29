<?php

namespace App\Http\Controllers;

use App\DTO\ResponseData;
use App\DTO\RoomData;
use App\Http\Requests\RoomRequest;
use App\Http\Resources\RoomCollection;
use App\Http\Resources\RoomResource;
use App\Repositories\RoomRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoomController
{
    public const NOT_FOUND_MESSAGE = 'Room Not found';
    private RoomRepository $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function getAll(Request $request): RoomCollection
    {
        return new RoomCollection($this->roomRepository->getAll($request->officeId));
    }

    public function getById(Request $request): RoomResource
    {
        return new RoomResource($this->roomRepository->getById($request->roomId));
    }

    public function create(RoomRequest $request): ResponseData
    {
        $input = $request->validated();

        $roomData = new RoomData();
        $roomData->setName($input['name']);
        $roomData->setType($input['type']);
        $roomData->setScheme($input['scheme']);

        $newRoom = $this->roomRepository->create($request->officeId, $roomData);

        return ResponseData::success(['id' => $newRoom->id]);
    }

    public function update(RoomRequest $request): ResponseData
    {
        $input = $request->validated();

        $roomData = new RoomData();
        $roomData->setName($input['name']);
        $roomData->setType($input['type']);
        $roomData->setScheme($input['scheme']);

        $updateRoom = $this->roomRepository->update($request->roomId, $roomData);

        return ResponseData::success(['id' => $updateRoom->id]);
    }

    public function delete(Request $request): Response|ResponseData
    {
        $isSuccess = $this->roomRepository->delete($request->roomId);

        if($isSuccess){
            return ResponseData::success([]);
        }

        return response(ResponseData::fail(self::NOT_FOUND_MESSAGE, []), 404);
    }
}
