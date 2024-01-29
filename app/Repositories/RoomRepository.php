<?php

namespace App\Repositories;

use App\DTO\RoomData;
use App\Models\Room;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Collection;

class RoomRepository
{
    public function getAll(int $officeId): Collection|array
    {
        return Room::where('office_id', $officeId)->with('places')->get();
    }

    public function getById(int $id): Room
    {
        return Room::findOrFail($id);
    }

    public function delete(int $id): int
    {
        return Room::destroy($id);
    }

    public function create(int $officeId, RoomData $data): Room
    {
        $room = new Room();
        $room->name = $data->getName();
        $room->type = $data->getType();
        $room->scheme = $data->getScheme();
        $room->office_id = $officeId;

        $room->saveOrFail();
        return $room;
    }

    public function update(int $id, RoomData $data): Room
    {
        $room = Room::find($id);
        $room->name = $data->getName();
        $room->type = $data->getType();
        $room->scheme = $data->getScheme();

        $room->saveOrFail();
        return $room;
    }

    public function getRoom(int $id, int $officeId, int $placeId)
    {
        return Room::where([
            ['office_id', $officeId],
            ['id', $id]
        ])->orWhere(function (Builder $query) use ($id, $officeId, $placeId) {
            $query->where([
                ['office_id', $officeId],
                ['id', $id]
            ])->with('places')
                ->where('id', $placeId);
        })->first();
    }
}
