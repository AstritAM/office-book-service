<?php

namespace App\DTO;

class RoomData
{
    private string $name;
    private array $scheme;
    private string $type;

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

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
