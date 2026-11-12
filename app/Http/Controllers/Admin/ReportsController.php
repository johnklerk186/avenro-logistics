<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        // Get recent shipments for reporting
        $reports = [
            'recent_shipments' => Shipment::latest()->take(10)->get(),
            'status_summary' => Shipment::selectRaw('status, count(*) as count')
                ->groupBy('status')
                ->get(),
        ];

        return view('admin.reports', compact('reports'));
    }
}
