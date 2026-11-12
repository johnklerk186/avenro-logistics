<?php

use App\Http\Controllers\Api\TrackingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public tracking routes
Route::get('/track/{trackingNumber}', [TrackingController::class, 'trackShipment']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Vehicle tracking
    Route::get('/vehicles/active', [TrackingController::class, 'getActiveVehicles']);
    
    // Location updates
    Route::post('/location/{entityType}/{entityId}', [TrackingController::class, 'updateLocation']);
}); 