<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_shipments' => Shipment::count(),
            'pending_shipments' => Shipment::where('status', 'pending')->count(),
            'in_transit_shipments' => Shipment::where('status', 'in_transit')->count(),
            'delivered_shipments' => Shipment::where('status', 'delivered')->count(),
            'recent_shipments' => Shipment::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
} 
