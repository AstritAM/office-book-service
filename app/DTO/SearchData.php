<?php

namespace App\DTO;

use Illuminate\Support\Carbon;

class SearchData
{
    private Carbon $dateFrom;
    private Carbon $dateTo;
    private int $officeId;

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

    public function getOfficeId(): int
    {
        return $this->officeId;
    }

    public function setOfficeId(int $officeId): void
    {
        $this->officeId = $officeId;
    }
}
