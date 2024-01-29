<?php

namespace App\Repositories;

use App\Models\OfficeSchedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ScheduleRepository
{
    public function getSchedule(int $officeId): Collection|array
    {
        return OfficeSchedule::where('office_id', $officeId)->get();
    }

    public function getScheduleByDate(int $officeId, Carbon $date)
    {
        return OfficeSchedule::where('office_id', $officeId)->where('date', $date)->first();
    }
}
