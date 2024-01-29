<?php

namespace App\DTO;

use Illuminate\Support\Carbon;

class ReservationData
{
    private Carbon $dateFrom;
    private Carbon $dateTo;
    private string $type;
    private int $officeId;
    private int $roomId;
    private ?int $placeId;
    private int $userId;

    public function getDateFrom(): Carbon
    {
        return $this->dateFrom;
    }

    public function setDateFrom(string $dateFrom): void
    {

        $this->dateFrom = Carbon::parse($dateFrom);
    }

    public function getDateTo(): Carbon
    {
        return $this->dateTo;
    }

    public function setDateTo(string $dateTo): void
    {
        $this->dateTo = Carbon::parse($dateTo);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getOfficeId(): int
    {
        return $this->officeId;
    }

    public function setOfficeId(int $officeId): void
    {
        $this->officeId = $officeId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function setRoomId(int $roomId): void
    {
        $this->roomId = $roomId;
    }

    public function getPlaceId(): ?int
    {
        return $this->placeId;
    }

    public function setPlaceId(?int $placeId): void
    {
        $this->placeId = $placeId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
}
