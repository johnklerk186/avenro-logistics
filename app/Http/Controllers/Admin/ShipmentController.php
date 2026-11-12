<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ShipmentCreated;
use App\Mail\ShipmentUpdated;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::latest()->paginate(10);
        return view('admin.shipments.index', compact('shipments'));
    }

    public function create()
    {
        return view('admin.shipments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_name' => 'nullable|string|max:255',
            'sender_email' => 'nullable|email|max:255',
            'sender_phone' => 'nullable|string|max:20',
            'sender_address' => 'nullable|string',
            'receiver_name' => 'nullable|string|max:255',
            'receiver_email' => 'nullable|email|max:255',
            'receiver_phone' => 'nullable|string|max:20',
            'receiver_address' => 'nullable|string',
            'origin' => 'nullable|string|max:255',
            'destination' => 'nullable|string|max:255',

            'package_name' => 'nullable|string|max:255',
            'package_type' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|array',
            'dimensions.length' => 'nullable|numeric|min:0',
            'dimensions.width' => 'nullable|numeric|min:0',
            'dimensions.height' => 'nullable|numeric|min:0',

            'declared_value' => 'nullable|numeric|min:0',
            'package_description' => 'nullable|string',

            'shipping_type' => 'nullable|in:air,sea,road',

            'service_type' => 'nullable|string|max:255',
            'carrier' => 'nullable|string|max:255',
            'priority' => 'nullable|string|max:255',
            'carrier_reference_no' => 'nullable|string|max:255',
            'product' => 'nullable|string|max:255',
            'qty' => 'nullable|integer|min:0',
            'payment_mode' => 'nullable|string|max:255',
            'total_freight' => 'nullable|numeric|min:0',
            'estimated_delivery_date' => 'nullable|date',

            'departure_time' => 'nullable|date_format:H:i',
            'pickup_date' => 'nullable|date',
            'pickup_time' => 'nullable|date_format:H:i',

            'comments' => 'nullable|string',
            'special_instructions' => 'nullable|string',

            'show_map' => 'boolean',
            'notes' => 'nullable|string'
        ]);

        // Fill safe defaults for non-nullable DB columns so a tracking
        // number can be generated even when fields are left blank.
        $validated['sender_name'] = $validated['sender_name'] ?? 'N/A';
        $validated['sender_email'] = $validated['sender_email'] ?? 'N/A';
        $validated['sender_phone'] = $validated['sender_phone'] ?? 'N/A';
        $validated['sender_address'] = $validated['sender_address'] ?? 'N/A';
        $validated['receiver_name'] = $validated['receiver_name'] ?? 'N/A';
        $validated['receiver_email'] = $validated['receiver_email'] ?? 'N/A';
        $validated['receiver_phone'] = $validated['receiver_phone'] ?? 'N/A';
        $validated['receiver_address'] = $validated['receiver_address'] ?? 'N/A';
        $validated['origin'] = $validated['origin'] ?? 'N/A';
        $validated['destination'] = $validated['destination'] ?? 'N/A';
        $validated['weight'] = $validated['weight'] ?? 0;
        $validated['dimensions'] = $validated['dimensions'] ?? ['length' => 0, 'width' => 0, 'height' => 0];
        $validated['shipping_type'] = $validated['shipping_type'] ?? 'road';
        $validated['estimated_delivery_date'] = $validated['estimated_delivery_date'] ?? now();

        $validated['tracking_number'] = Shipment::generateTrackingNumber();
        $validated['current_location'] = $validated['origin'];
        $validated['status'] = 'pending';
        $validated['show_map'] = $request->has('show_map');

        $validated['shipment_mode'] = match ($validated['shipping_type']) {
            'air' => 'Air Freight',
            'sea' => 'Sea Freight',
            'road' => 'Road Transport',
            default => null,
        };

        $shipment = Shipment::create($validated);

        // Create initial shipment update
        ShipmentUpdate::create([
            'shipment_id' => $shipment->id,
            'status' => 'pending',
            'location' => $validated['origin'],
            'description' => 'Shipment created and pending pickup',
            'updated_by' => Auth::guard('admin')->id()
        ]);

        // Send email notification to receiver (only when a valid email was provided)
        try {
            if (!empty($shipment->receiver_email) && $shipment->receiver_email !== 'N/A'
                && filter_var($shipment->receiver_email, FILTER_VALIDATE_EMAIL)) {
                Mail::to($shipment->receiver_email)->send(new ShipmentCreated($shipment));
                $emailMessage = 'Notification email sent successfully.';
            } else {
                $emailMessage = 'No receiver email provided — notification skipped.';
            }
        } catch (\Exception $e) {
            \Log::error('Failed to queue shipment created email: ' . $e->getMessage());
            $emailMessage = 'Shipment created but email notification failed.';
        }

        return redirect()->route('admin.shipments.show', $shipment)
            ->with('success', 'Shipment created successfully with tracking number: ' . $shipment->tracking_number . '. ' . $emailMessage);
    }

    public function show(Shipment $shipment)
    {
        $shipment->load('updates.admin');
        return view('admin.shipments.show', compact('shipment'));
    }

    public function edit(Shipment $shipment)
    {
        return view('admin.shipments.edit', compact('shipment'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $validated = $request->validate([
            'sender_name' => 'required|string|max:255',
            'sender_email' => 'required|email|max:255',
            'sender_phone' => 'required|string|max:20',
            'sender_address' => 'required|string',
            'receiver_name' => 'required|string|max:255',
            'receiver_email' => 'required|email|max:255',
            'receiver_phone' => 'required|string|max:20',
            'receiver_address' => 'required|string',
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',

            'package_name' => 'required|string|max:255',
            'package_type' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0',
            'dimensions' => 'required|array',
            'dimensions.length' => 'required|numeric|min:0',
            'dimensions.width' => 'required|numeric|min:0',
            'dimensions.height' => 'required|numeric|min:0',

            'declared_value' => 'nullable|numeric|min:0',
            'package_description' => 'nullable|string',

            'shipping_type' => 'required|in:air,sea,road',

            'service_type' => 'required|string|max:255',
            'carrier' => 'required|string|max:255',
            'priority' => 'required|string|max:255',
            'carrier_reference_no' => 'required|string|max:255',
            'product' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'payment_mode' => 'required|string|max:255',
            'total_freight' => 'required|numeric|min:0',
            'estimated_delivery_date' => 'required|date',

            'departure_time' => 'required|date_format:H:i',
            'pickup_date' => 'required|date',
            'pickup_time' => 'required|date_format:H:i',

            'comments' => 'nullable|string',
            'special_instructions' => 'nullable|string',

            'show_map' => 'boolean',
            'notes' => 'nullable|string'
        ]);

        $validated['shipment_mode'] = match ($validated['shipping_type']) {
            'air' => 'Air Freight',
            'sea' => 'Sea Freight',
            'road' => 'Road Transport',
            default => null,
        };

        $shipment->update($validated);

        return redirect()->route('admin.shipments.show', $shipment)
            ->with('success', 'Shipment updated successfully.');
    }

    public function updateStatus(Request $request, Shipment $shipment)
    {
        try {

            $validated = $request->validate([
                'status' => 'required|in:pending,picked_up,in_transit,out_for_delivery,delivered,on_hold,cancelled',
                'location' => 'required|string|max:255',
                'description' => 'required|string'
            ]);

            // Update shipment status and location
            $updated = $shipment->update([
                'status' => $validated['status'],
                'current_location' => $validated['location']
            ]);


            if (!$updated) {
                throw new \Exception('Failed to update shipment status');
            }

            // Create shipment update record
            $shipmentUpdate = ShipmentUpdate::create([
                'shipment_id' => $shipment->id,
                'status' => $validated['status'],
                'location' => $validated['location'],
                'description' => $validated['description'],
                'updated_by' => auth()->guard('admin')->id()
            ]);


            // Send email notification to receiver (async to avoid blocking)
            try {
                // Reload shipment with updates relationship
                $shipment->load('updates');
                
                // Send email immediately
                Mail::to($shipment->receiver_email)->send(new ShipmentUpdated($shipment, $shipmentUpdate));
                
                $emailMessage = 'Notification email sent successfully.';
            } catch (\Exception $e) {
                \Log::error('Failed to queue shipment update email: ' . $e->getMessage());
                $emailMessage = 'Update saved but email notification failed.';
            }

            return redirect()->route('admin.shipments.show', $shipment)
                ->with('success', 'Shipment status updated successfully. ' . $emailMessage);

        } catch (\Exception $e) {
            \Log::error('Error updating shipment status:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'shipment_id' => $shipment->id
            ]);

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update shipment status: ' . $e->getMessage()]);
        }
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();

        return redirect()->route('admin.shipments.index')
            ->with('success', 'Shipment deleted successfully.');
    }
} 