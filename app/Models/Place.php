<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $name
 * @property mixed $scheme
 * @property int|mixed $room_id
 * @property bool isBooked
 * @property int id
 */
class Place extends Model
{
    protected $table = 'places';
    public $timestamps = false;

    protected $casts = [
        'scheme' => 'array',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function setIsBooked(bool $isBooked): void
    {
        $this->isBooked = $isBooked;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
