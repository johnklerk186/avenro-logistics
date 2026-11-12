<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function trackShipment(string $trackingNumber): JsonResponse
    {
        $shipment = Shipment::with(['location', 'sender:id,name', 'receiver:id,name'])
            ->where('tracking_number', $trackingNumber)
            ->firstOrFail();

        return response()->json([
            'status' => 'success',
            'data' => [
                'shipment' => $shipment,
                'location' => $shipment->location,
                'estimated_delivery' => $shipment->estimated_delivery,
                'current_status' => $shipment->status,
            ]
        ]);
    }

    public function getActiveVehicles(): JsonResponse
    {
        $vehicles = Vehicle::with(['location', 'driver:id,name'])
            ->where('status', 'active')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $vehicles
        ]);
    }

    public function updateLocation(Request $request, string $entityType, int $entityId): JsonResponse
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $model = match ($entityType) {
            'shipment' => Shipment::findOrFail($entityId),
            'vehicle' => Vehicle::findOrFail($entityId),
            default => abort(400, 'Invalid entity type'),
        };

        $model->location()->updateOrCreate(
            ['entity_type' => $entityType, 'entity_id' => $entityId],
            [
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'last_updated' => now(),
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Location updated successfully'
        ]);
    }
} 