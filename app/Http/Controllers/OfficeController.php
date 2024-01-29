<?php

namespace App\Http\Controllers;

use App\DTO\OfficeData;
use App\DTO\ResponseData;
use App\DTO\SearchData;
use App\Http\Requests\OfficeRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\OfficeCollection;
use App\Http\Resources\OfficeResource;
use App\Http\Resources\ScheduleCollection;
use App\Repositories\OfficeRepository;
use App\Repositories\ScheduleRepository;
use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OfficeController extends Controller
{
    public const NOT_FOUND_MESSAGE = 'Office Not found';
    private OfficeRepository $officeRepository;
    private ScheduleRepository $scheduleRepository;
    private SearchService $searchService;

    public function __construct(
        OfficeRepository $officeRepository,
        ScheduleRepository $scheduleRepository,
        SearchService $searchService
    ) {
        $this->officeRepository = $officeRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->searchService = $searchService;
    }

    public function getAll(): OfficeCollection
    {
        return new OfficeCollection($this->officeRepository->getAll());
    }

    public function getById(Request $request): OfficeResource
    {
        return new OfficeResource($this->officeRepository->getById($request->officeId));
    }

    public function create(OfficeRequest $request): ResponseData
    {
        $input = $request->validated();

        $officeData = new OfficeData();
        $officeData->setName($input['name']);
        $officeData->setLocation($input['location']);
        $officeData->setScheme($input['scheme']);

        $newOffice = $this->officeRepository->create($officeData);

        return ResponseData::success(['id' => $newOffice->id]);
    }

    public function update(OfficeRequest $request): ResponseData
    {
        $input = $request->validated();

        $officeData = new OfficeData();
        $officeData->setName($input['name']);
        $officeData->setLocation($input['location']);
        $officeData->setScheme($input['scheme']);

        $updateOffice = $this->officeRepository->update($request->officeId, $officeData);

        return ResponseData::success(['id' => $updateOffice->id]);
    }

    public function delete(Request $request): Response|ResponseData
    {
        $isSuccess = $this->officeRepository->delete($request->officeId);

        if ($isSuccess) {
            return ResponseData::success([]);
        }

        return response(ResponseData::fail(self::NOT_FOUND_MESSAGE, []), 404);
    }

    public function getSchedule(Request $request): ScheduleCollection
    {
        return new ScheduleCollection($this->scheduleRepository->getSchedule($request->officeId));
    }

    public function search(SearchRequest $request): ResponseData
    {
        $input = $request->validated();

        $searchData = new SearchData();
        $searchData->setOfficeId($request->officeId);
        $searchData->setDateFrom($input['from_date']);
        $searchData->setDateTo($input['to_date']);

        return ResponseData::success($this->searchService->search($searchData)->toArray());
    }
}
