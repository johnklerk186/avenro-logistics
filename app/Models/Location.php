<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Location extends Model
{
    protected $fillable = [
        'entity_type',
        'entity_id',
        'latitude',
        'longitude',
        'last_updated',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'last_updated' => 'datetime',
    ];

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }
} 