<?php

namespace App\DTO;


use Illuminate\Support\Collection;

class ResponseData implements \JsonSerializable
{
    public function __construct(
        private bool $success,
        private ?string $message = null,
        private array|Collection|null $payload = null,
        private ?array $errors = null
    ) {
        $this->success = $success;
        $this->message = $message;
        $this->payload = $payload;
        $this->errors = $errors;
    }

    public static function success(array|Collection $payload): self
    {
        return new self(success: true, payload: $payload);
    }

    public static function fail(string $message, array $errors): self
    {
        return new self(success: false, message: $message, errors: $errors);
    }

    public function jsonSerialize(): array
    {
        $response = [
            'success' => $this->success,
            'payload' => $this->payload,
            'message' => $this->message,
            'error' => $this->errors
        ];

        return array_filter($response, function ($value) {
            return $value !== null;
        });
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    public function getPayload(): array|Collection|null
    {
        return $this->payload;
    }

    public function setPayload(array|Collection|null $payload): void
    {
        $this->payload = $payload;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function setErrors(?array $errors): void
    {
        $this->errors = $errors;
    }
}
