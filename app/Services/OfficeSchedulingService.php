<?php

namespace App\Services;

use App\Enum\ScheduleType;
use App\Repositories\ScheduleRepository;
use Carbon\Carbon;

class OfficeSchedulingService
{
    private ScheduleRepository $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    public function checkOfficeSchedule(int $officeId, Carbon $date): bool
    {
        $schedule = $this->scheduleRepository->getScheduleByDate($officeId, $date);

        if (!$schedule) {
            return false;
        }

        if ($schedule->day_flag === ScheduleType::DAY_OFF_TYPE->value) {
            return false;
        }

        $time = $date->format('H:i:s');

        if ($schedule->start > $time || $schedule->end < $time) {
            return false;
        }

        return true;
    }

}
