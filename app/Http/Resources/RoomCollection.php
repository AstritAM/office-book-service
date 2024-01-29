<?php

namespace App\Http\Resources;

use App\DTO\ResponseData;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoomCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        return ResponseData::success(
            $this->collection->map(function ($room) {
                return [
                    'id' => $room->id,
                    'name' => $room->name,
                    'type' => $room->type,
                    'scheme' => $room->scheme,
                    'places' => $room->places
                ];
            }),
        );
    }
}
