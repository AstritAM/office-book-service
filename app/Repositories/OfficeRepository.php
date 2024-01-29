<?php

namespace App\Repositories;

use App\DTO\OfficeData;
use App\Models\Office;
use Illuminate\Database\Eloquent\Collection;

class OfficeRepository
{
    public function getAll(): Collection|array
    {
        return Office::with('rooms')->get();
    }

    public function getById(int $id): Office
    {
        return Office::findOrFail($id);
    }

    public function delete(int $id): int
    {
        return Office::destroy($id);
    }

    public function create(OfficeData $data): Office
    {
        $office = new Office();
        $office->name = $data->getName();
        $office->location = $data->getLocation();
        $office->scheme = $data->getScheme();

        $office->saveOrFail();
        return $office;
    }

    public function update(int $id, OfficeData $data): Office
    {
        $office = Office::find($id);
        $office->name = $data->getName();
        $office->location = $data->getLocation();
        $office->scheme = $data->getScheme();

        $office->saveOrFail();
        return $office;
    }
}
