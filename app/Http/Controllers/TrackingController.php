<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function track(Request $request)
    {
        $trackingNumber = $request->input('tracking_number');

        if (!$trackingNumber) {
            return view('track')->with('error', 'Please enter a tracking number');
        }

        $shipment = Shipment::where('tracking_number', $trackingNumber)->first();

        if (!$shipment) {
            return view('track')->with('error', 'Invalid tracking number. Please check and try again.');
        }

        return view('track', [
            'shipment' => $shipment,
            'success' => true
        ]);
    }
} 