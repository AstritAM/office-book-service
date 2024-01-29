<?php

namespace App\Enum;

enum ScheduleType: string
{
    case WORKDAY_TYPE = 'workday';
    case DAY_OFF_TYPE = 'day_off';
}
