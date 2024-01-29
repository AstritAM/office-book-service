<?php

namespace App\Repositories;

use App\DTO\PlaceData;
use App\Models\Place;
use Illuminate\Database\Eloquent\Collection;

class PlaceRepository
{
    public function getAll(int $roomId): Collection|array
    {
        return Place::where('room_id', $roomId)->get();
    }

    public function getById(int $id): Place
    {
        return Place::findOrFail($id);
    }

    public function delete(int $id): int
    {
        return Place::destroy($id);
    }

    public function create(PlaceData $data): Place
    {
        $place = new Place();
        $place->name = $data->getName();
        $place->scheme = $data->getScheme();
        $place->room_id = $data->getRoomId();

        $place->saveOrFail();
        return $place;
    }

    public function update(int $id, PlaceData $data): Place
    {
        $place = Place::find($id);
        $place->name = $data->getName();
        $place->scheme = $data->getScheme();
        $place->room_id = $data->getRoomId();

        $place->saveOrFail();
        return $place;
    }
}
