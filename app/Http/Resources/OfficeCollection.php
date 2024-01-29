<?php

namespace App\Http\Resources;

use App\DTO\ResponseData;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OfficeCollection extends ResourceCollection
{

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        return ResponseData::success(
            $this->collection->map(function ($office) {
                return [
                    'id' => $office->id,
                    'name' => $office->name,
                    'location' => $office->location,
                    'scheme' => $office->scheme,
                    'rooms' => new RoomCollection($office->rooms)
                ];
            }),
        );
    }
}
