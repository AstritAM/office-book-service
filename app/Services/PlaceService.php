<?php

namespace App\Services;

use App\DTO\PlaceData;
use App\Enum\RoomType;
use App\Models\Place;
use App\Repositories\PlaceRepository;
use App\Repositories\RoomRepository;

class PlaceService
{
    private PlaceRepository $placeRepository;
    private RoomRepository $roomRepository;

    public function __construct(PlaceRepository $placeRepository, RoomRepository $roomRepository)
    {
        $this->placeRepository = $placeRepository;
        $this->roomRepository = $roomRepository;
    }

    public function create(PlaceData $data): Place|bool
    {
        $typeRoom = $this->roomRepository->getById($data->getRoomId())->type;
        if ($typeRoom === RoomType::MEETING_ROOM_TYPE->value) {
            return false;
        }

        return $this->placeRepository->create($data);
    }

    public function update(PlaceData $data): Place|bool
    {
        $typeRoom = $this->roomRepository->getById($data->getRoomId())->type;
        if ($typeRoom === RoomType::MEETING_ROOM_TYPE->value) {
            return false;
        }

        return $this->placeRepository->create($data);
    }

}
