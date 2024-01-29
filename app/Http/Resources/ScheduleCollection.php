<?php

namespace App\Http\Resources;

use App\DTO\ResponseData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ScheduleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return ResponseData
     */
    public function toArray(Request $request): ResponseData
    {
        return ResponseData::success(
            $this->collection->map(function ($schedule) {
                return [
                    'date' => $schedule->date,
                    'start' => $schedule->start,
                    'end' => $schedule->end,
                    'day_flag' => $schedule->day_flag,
                    'office_id' => $schedule->office_id
                ];
            }),
        );
    }
}
