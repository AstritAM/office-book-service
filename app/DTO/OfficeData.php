<?php

namespace App\DTO;

class OfficeData
{
    public string $name;
    public array $scheme;
    public string $location;

    public function getName(): string
    {
        return $this->name;
    }

    public function getScheme(): array
    {
        return $this->scheme;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function setScheme(array $scheme): void
    {
        $this->scheme = $scheme;
    }
}
