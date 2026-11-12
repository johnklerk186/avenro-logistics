<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_number',
        'sender_name',
        'sender_email',
        'sender_phone',
        'sender_address',
        'receiver_name',
        'receiver_email',
        'receiver_phone',
        'receiver_address',
        'origin',
        'destination',
        'package_name',
        'package_type',
        'current_location',
        'status',
        'show_map',
        'weight',
        'dimensions',
        'declared_value',
        'package_description',
        'shipping_type',
        'shipment_mode',
        'service_type',
        'carrier',
        'priority',
        'carrier_reference_no',
        'product',
        'qty',
        'payment_mode',
        'total_freight',
        'estimated_delivery_date',
        'departure_time',
        'pickup_date',
        'pickup_time',
        'comments',
        'special_instructions',
        'notes'
    ];

    protected $casts = [
        'estimated_delivery_date' => 'datetime',
        'dimensions' => 'json',
        'weight' => 'decimal:2',
        'declared_value' => 'decimal:2',
        'total_freight' => 'decimal:2',
        'pickup_date' => 'date',
        'show_map' => 'boolean'
    ];

    public function getLengthAttribute()
    {
        $dimensions = $this->dimensions;
        if (is_string($dimensions)) {
            $dimensions = json_decode($dimensions, true);
        }
        return is_array($dimensions) ? ($dimensions['length'] ?? null) : null;
    }

    public function getWidthAttribute()
    {
        $dimensions = $this->dimensions;
        if (is_string($dimensions)) {
            $dimensions = json_decode($dimensions, true);
        }
        return is_array($dimensions) ? ($dimensions['width'] ?? null) : null;
    }

    public function getHeightAttribute()
    {
        $dimensions = $this->dimensions;
        if (is_string($dimensions)) {
            $dimensions = json_decode($dimensions, true);
        }
        return is_array($dimensions) ? ($dimensions['height'] ?? null) : null;
    }

    public static function generateTrackingNumber()
    {
        $prefix = 'TGL';
        $timestamp = now()->format('Ymd');
        $random = strtoupper(substr(uniqid(), -4));
        return $prefix . $timestamp . $random;
    }

    public function updates()
    {
        return $this->hasMany(ShipmentUpdate::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

    public function location(): MorphOne
    {
        return $this->morphOne(Location::class, 'entity');
    }
} 