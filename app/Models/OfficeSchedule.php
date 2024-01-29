<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfficeSchedule extends Model
{
    protected $table = 'office_schedule';
    public $timestamps = false;


    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }
}
