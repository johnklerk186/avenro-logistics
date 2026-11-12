<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        // Get basic statistics
        $stats = [
            'total_shipments' => Shipment::count(),
            'pending_shipments' => Shipment::where('status', 'Pending')->count(),
            'in_transit' => Shipment::where('status', 'In Transit')->count(),
            'delivered' => Shipment::where('status', 'Delivered')->count(),
        ];

        return view('admin.statistics', compact('stats'));
    }
}
