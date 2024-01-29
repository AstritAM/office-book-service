<?php

namespace App\DTO;

class PlaceData
{
    public string $name;
    public array $scheme;
    public int $roomId;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getScheme(): array
    {
        return $this->scheme;
    }

    public function setScheme(array $scheme): void
    {
        $this->scheme = $scheme;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function setRoomId(int $roomId): void
    {
        $this->roomId = $roomId;
    }
}
