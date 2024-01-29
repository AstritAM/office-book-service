<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static find(int $id)
 * @property mixed|string $name
 * @property mixed|string $type
 * @property array|mixed $scheme
 * @property mixed $id
 * @property int|mixed $office_id
 * @property int|mixed isBooked
 */
class Room extends Model
{
    protected $table = 'rooms';
    public $timestamps = false;
    protected $casts = [
        'scheme' => 'array',
    ];

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function places(): HasMany
    {
        return $this->hasMany(Place::class);
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
