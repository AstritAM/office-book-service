<?php

namespace App\Services;

use App\DTO\ReservationData;
use App\Enum\ReservationType;
use App\Enum\RoomType;
use App\Exceptions\NotFoundException;
use App\Models\Reservation;
use App\Models\Room;
use App\Repositories\ReservationRepository;
use App\Repositories\RoomRepository;
use App\Repositories\ScheduleRepository;
use Carbon\Carbon;

class ReservationService
{
    public const MIN_TIME_RESERVATION_PLACE = 60;
    public const MIN_TIME_RESERVATION_MEETING_ROOM = 30;
    private ReservationRepository $reservationRepository;
    private RoomRepository $roomRepository;
    private ScheduleRepository $scheduleRepository;
    private OfficeSchedulingService $officeSchedulingService;

    public function __construct(
        ReservationRepository $reservationRepository,
        RoomRepository $roomRepository,
        ScheduleRepository $scheduleRepository,
        OfficeSchedulingService $officeSchedulingService
    ) {
        $this->reservationRepository = $reservationRepository;
        $this->roomRepository = $roomRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->officeSchedulingService = $officeSchedulingService;
    }

    public function isReserved(ReservationData $data): bool
    {
        if ($this->reservationRepository->getReservation($data)->isEmpty()) {
            return false;
        }

        return true;
    }

    public function book(ReservationData $data): Reservation|bool
    {
        if (!$this->officeSchedulingService->checkOfficeSchedule($data->getOfficeId(), $data->getDateFrom()) &&
            !$this->officeSchedulingService->checkOfficeSchedule($data->getOfficeId(), $data->getDateTo())
        ) {
            return false;
        }

        if (!$room = $this->roomRepository->getRoom($data->getRoomId(), $data->getOfficeId(), $data->getPlaceId())) {
            throw new NotFoundException('Not found room or place');
        }

        $roomType = $room->type;

        if ($roomType === RoomType::MEETING_ROOM_TYPE->value || $data->getType() === ReservationType::FULL_TYPE->value) {
            $data->setType(ReservationType::FULL_TYPE->value);
            $data->setPlaceId(null);
        }

        if (!$this->validateBookRestrictions($data, $room)) {
            return false;
        }

        if ($this->isReserved($data)) {
            return false;
        }

        return $this->reservationRepository->create($data);
    }

    private function validateBookRestrictions(ReservationData $data, Room $room): bool
    {
        $diffTimeInMin = $data->getDateFrom()->diffInMinutes($data->getDateTo());

        $schedule = $this->scheduleRepository->getScheduleByDate(
            $data->getOfficeId(),
            $data->getDateFrom()
        );

        $workingTime = Carbon::parse($schedule->start)->diffInMinutes(Carbon::parse($schedule->end));

        if ($data->getType() === ReservationType::PLACE_TYPE->value && $diffTimeInMin >= self::MIN_TIME_RESERVATION_PLACE) {
            return true;
        }

        if ($room->type === RoomType::MEETING_ROOM_TYPE->value && $diffTimeInMin >= self::MIN_TIME_RESERVATION_MEETING_ROOM) {
            return true;
        }

        if ($room->type === RoomType::CABINET_TYPE->value && $diffTimeInMin >= $workingTime) {
            return true;
        }

        return false;
    }
}
