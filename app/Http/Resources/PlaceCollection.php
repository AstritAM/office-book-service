<?php

namespace App\Http\Resources;

use App\DTO\ResponseData;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class PlaceCollection extends ResourceCollection
{
    public static $wrap = 'payload';

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|JsonSerializable
     */
    public function toArray(Request $request): array|JsonSerializable|Arrayable
    {
        return ResponseData::success(
            $this->collection->map(function ($place) {
                return [
                    'id' => $place->id,
                    'name' => $place->name,
                    'scheme' => $place->scheme,
                ];
            }),
        );
    }
}
