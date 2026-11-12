<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Vehicle extends Model
{
    protected $fillable = [
        'driver_id',
        'plate_number',
        'vehicle_type',
        'model',
        'status',
        'current_location',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function location(): MorphOne
    {
        return $this->morphOne(Location::class, 'entity');
    }
} 