<?php

namespace App\Http\Controllers;

use App\DTO\ReservationData;
use App\DTO\ResponseData;
use App\Http\Requests\ReservationRequest;
use App\Services\ReservationService;
use App\Services\SearchService;

class ReservationController extends Controller
{
    private ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function reservation(ReservationRequest $request, SearchService $search): ResponseData
    {
        $input = $request->validated();

        $reservation = new ReservationData();
        $reservation->setType($input['type']);
        $reservation->setDateFrom($input['dateFrom']);
        $reservation->setDateTo($input['dateTo']);
        $reservation->setOfficeId($input['officeId']);
        $reservation->setRoomId($input['roomId']);
        $reservation->setPlaceId($input['placeId'] ?? null);
        $reservation->setUserId($input['userId']);

        if ($reservation = $this->reservationService->book($reservation)) {
            return ResponseData::success(['id' => $reservation->id]);
        }

        return ResponseData::fail('Something wrong', []);
    }
}
