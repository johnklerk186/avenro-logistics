<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);
Route::get('/track', [TrackingController::class, 'track'])->name('track');
Route::get('/services', [App\Http\Controllers\ServiceController::class, 'index'])->name('services.index');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about.index');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

// Public chat routes
Route::post('/chat/initiate', [ChatController::class, 'initiateChat'])->name('chat.initiate');
Route::post('/chat/user/send', [ChatController::class, 'userSendMessage'])->name('chat.user.send');
Route::get('/chat/messages', [ChatController::class, 'getMessages'])->name('chat.messages');

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Admin auth routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin protected routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {
    // Dashboard
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Shipment routes
    Route::resource('shipments', App\Http\Controllers\Admin\ShipmentController::class);
    Route::post('shipments/{shipment}/update-status', [App\Http\Controllers\Admin\ShipmentController::class, 'updateStatus'])
        ->name('shipments.update-status');

    // Testimonial routes
    Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class);
    Route::post('testimonials/reorder', [App\Http\Controllers\Admin\TestimonialController::class, 'reorder'])
        ->name('testimonials.reorder');

    // Profile and Settings routes
    Route::get('profile', [App\Http\Controllers\Admin\ProfileController::class, 'profile'])->name('profile');
    Route::put('profile', [App\Http\Controllers\Admin\ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::get('settings', [App\Http\Controllers\Admin\ProfileController::class, 'settings'])->name('settings');
    Route::put('settings/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('settings.password');
    Route::put('settings/notifications', [App\Http\Controllers\Admin\ProfileController::class, 'updateSettings'])->name('settings.notifications');
    Route::put('settings/branding', [App\Http\Controllers\Admin\ProfileController::class, 'updateBranding'])->name('settings.branding');

    // Statistics and Reports routes
    Route::get('statistics', [App\Http\Controllers\Admin\StatisticsController::class, 'index'])->name('statistics');
    Route::get('reports', [App\Http\Controllers\Admin\ReportsController::class, 'index'])->name('reports');

    // Chat management routes
    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/', [ChatController::class, 'adminIndex'])->name('index');
        Route::get('/sessions', [ChatController::class, 'getSessions'])->name('sessions');
        Route::post('/send', [ChatController::class, 'adminSendMessage'])->name('send');
        Route::post('/end', [ChatController::class, 'endChat'])->name('end');
        Route::delete('/delete/{session_id}', [ChatController::class, 'deleteChat'])->name('delete');
    });
});

Route::get('/tracking-updates/{tracking_number}', function($tracking_number) {
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    header('Connection: keep-alive');
    header('X-Accel-Buffering: no'); // Disable buffering for nginx

    $lastUpdate = null;

    while (true) {
        $update = DB::table('shipment_updates')
            ->join('shipments', 'shipments.id', '=', 'shipment_updates.shipment_id')
            ->where('shipments.tracking_number', $tracking_number)
            ->orderBy('shipment_updates.created_at', 'desc')
            ->first();

        if ($update && (!$lastUpdate || $update->created_at > $lastUpdate)) {
            $lastUpdate = $update->created_at;
            echo "data: " . json_encode([
                'latitude' => $update->latitude,
                'longitude' => $update->longitude,
                'location' => $update->location,
                'description' => $update->description,
                'created_at' => $update->created_at
            ]) . "\n\n";
            ob_flush();
            flush();
        }

        // Sleep for 5 seconds before checking for updates again
        sleep(5);
    }
})->name('tracking.updates');
