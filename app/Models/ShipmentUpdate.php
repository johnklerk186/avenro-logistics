<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShipmentUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_id',
        'status',
        'location',
        'latitude',
        'longitude',
        'description',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8'
    ];

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
} 