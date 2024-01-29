<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed|string $type
 * @property mixed|Carbon $date_to
 * @property mixed|Carbon $date_from
 * @property int|mixed $office_id
 * @property int|mixed $room_id
 * @property int|mixed|null $place_id
 * @property int|mixed $user_id
 */
class Reservation extends Model
{
    /**
     * @var mixed|string
     */
    protected $table = 'reservations';
    public $timestamps = false;

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function places(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
