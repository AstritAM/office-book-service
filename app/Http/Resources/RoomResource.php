<?php

namespace App\Http\Resources;

use App\DTO\ResponseData;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        return ResponseData::success([
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'scheme' => $this->scheme,
            'places' => $this->places
        ]);
    }
}
