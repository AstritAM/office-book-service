<?php

namespace App\Services;

use App\DTO\SearchData;
use App\Repositories\ReservationRepository;
use App\Repositories\RoomRepository;
use Illuminate\Database\Eloquent\Collection;

class SearchService
{
    private ReservationRepository $reservationRepository;
    private RoomRepository $roomRepository;

    public function __construct(ReservationRepository $reservationRepository, RoomRepository $roomRepository)
    {
        $this->reservationRepository = $reservationRepository;
        $this->roomRepository = $roomRepository;
    }

    public function search(SearchData $data): Collection|array
    {
        $bookedRooms = $this->reservationRepository->getBookedRooms($data)->pluck('room_id');
        $bookedPlaces = $this->reservationRepository->getBookedPlaces($data)->pluck('place_id');

        $rooms = $this->roomRepository->getAll($data->getOfficeId());

        foreach ($rooms as $room) {
            $room->setIsBooked( $bookedRooms->contains($room->getId()));
            foreach ($room->places as $place) {
                $isPlaceBooked = $bookedPlaces->contains($place->getId());
                $place->setIsBooked($isPlaceBooked || $room->isBooked);
            }
        }

        return $rooms;
    }

}
