<?php

namespace App\Repositories;

use App\DTO\ReservationData;
use App\DTO\SearchData;
use App\Enum\ReservationType;
use App\Models\Reservation;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class ReservationRepository
{
    public function create(ReservationData $data): Reservation
    {
        $reservation = new Reservation();
        $reservation->date_from = $data->getDateFrom();
        $reservation->date_to = $data->getDateTo();
        $reservation->type = $data->getType();
        $reservation->office_id = $data->getOfficeId();
        $reservation->room_id = $data->getRoomId();
        $reservation->place_id = $data->getPlaceId();
        $reservation->user_id = $data->getUserId();

        $reservation->saveOrFail();
        return $reservation;
    }

    public function getReservation(ReservationData $data): Collection
    {
        return DB::table('reservations')
            ->where('office_id', $data->getOfficeId())
            ->where([
                ['date_to', '>', $data->getDateFrom()],
                ['date_from', '<', $data->getDateTo()]
            ])
            ->where(
                function (Builder $query) use ($data) {
                    $query
                        ->orWhere([
                            ['reservations.room_id', '=', $data->getRoomId()],
                            ['reservations.type', '=', ReservationType::FULL_TYPE->value]
                        ])
                        ->orWhere([
                            ['reservations.room_id', '=', $data->getRoomId()],
                            ['reservations.place_id', '=', $data->getPlaceId()],
                            ['reservations.type', '=', ReservationType::PLACE_TYPE->value]
                        ]);
                }
            )->get();
    }

    public function getBookedRooms(SearchData $data): Collection
    {
        return Reservation::where([
            ['date_to', '>', $data->getDateFrom()],
            ['date_from', '<', $data->getDateTo()],
            ['office_id', '=', $data->getOfficeId()],
        ])->whereNull('place_id')->get();
    }

    public function getBookedPlaces(SearchData $data): Collection
    {
        return Reservation::where([
            ['date_to', '>', $data->getDateFrom()],
            ['date_from', '<', $data->getDateTo()],
            ['office_id', '=', $data->getOfficeId()],
        ])->whereNotNull('place_id')->get();
    }
}

