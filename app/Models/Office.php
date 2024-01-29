<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed|string $name
 * @property mixed|string $location
 * @property array $scheme
 * @method static find(int $id)
 */
class Office extends Model
{
    protected $table = 'offices';
    public $timestamps = false;
    public $primarykey = 'id';

    protected $casts = [
        'scheme' => 'array',
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function officeSchedule(): HasMany
    {
        return $this->hasMany(OfficeSchedule::class);
    }
}
