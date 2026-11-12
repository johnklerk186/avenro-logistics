@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-6xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6 bg-white rounded-lg shadow-md p-6" style="border-left: 4px solid #0F2B4D;">
            <h1 class="text-3xl font-bold heading-font" style="color: #2D3748;">
                <i class="fas fa-file-alt mr-2" style="color: #0F2B4D;"></i>Reports
            </h1>
            <p class="text-sm mt-1" style="color: #718096;">Comprehensive shipment reports and analytics dashboard</p>
        </div>

        <!-- Status Summary -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6" style="border-top: 3px solid #0F2B4D;">
            <h2 class="text-xl font-bold heading-font mb-4" style="color: #2D3748;">
                <i class="fas fa-chart-pie mr-2" style="color: #0F2B4D;"></i>Status Summary
            </h2>
            <div class="overflow-x-auto -mx-4 sm:mx-0">
                <div class="inline-block min-w-full align-middle">
                    <table class="min-w-full divide-y" style="border-color: #E2E8F0;">
                        <thead style="background-color: #F1F4F9;">
                            <tr>
                                <th class="px-4 sm:px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                    <i class="fas fa-info-circle mr-2" style="color: #0F2B4D;"></i>Status
                                </th>
                                <th class="px-4 sm:px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                    <i class="fas fa-hashtag mr-2" style="color: #0F2B4D;"></i>Count
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y" style="border-color: #E2E8F0;">
                            @foreach($reports['status_summary'] as $status)
                            <tr class="hover:bg-opacity-50 transition-colors duration-150" onmouseover="this.style.backgroundColor='#F4F6F9'" onmouseout="this.style.backgroundColor='#FFFFFF'">
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-semibold" style="color: #2D3748;">
                                    {{ ucfirst(str_replace('_', ' ', $status->status)) }}
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-sm font-bold rounded-lg" style="background-color: #F1F4F9; color: #0F2B4D;">
                                        {{ $status->count }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Shipments -->
        <div class="bg-white rounded-lg shadow-lg p-6" style="border-top: 3px solid #0F2B4D;">
            <h2 class="text-xl font-bold heading-font mb-4" style="color: #2D3748;">
                <i class="fas fa-history mr-2" style="color: #0F2B4D;"></i>Recent Shipments
            </h2>
            <div class="overflow-x-auto -mx-4 sm:mx-0">
                <div class="inline-block min-w-full align-middle">
                    <table class="min-w-full divide-y" style="border-color: #E2E8F0;">
                        <thead style="background-color: #F1F4F9;">
                            <tr>
                                <th class="px-4 sm:px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                    <i class="fas fa-barcode mr-1" style="color: #0F2B4D;"></i>Tracking #
                                </th>
                                <th class="px-4 sm:px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                    <i class="fas fa-info-circle mr-1" style="color: #0F2B4D;"></i>Status
                                </th>
                                <th class="hidden md:table-cell px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                    <i class="fas fa-map-marker-alt mr-1" style="color: #0F2B4D;"></i>Origin
                                </th>
                                <th class="hidden md:table-cell px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                    <i class="fas fa-flag-checkered mr-1" style="color: #0F2B4D;"></i>Destination
                                </th>
                                <th class="hidden sm:table-cell px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                    <i class="fas fa-calendar mr-1" style="color: #0F2B4D;"></i>Created
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y" style="border-color: #E2E8F0;">
                            @foreach($reports['recent_shipments'] as $shipment)
                            <tr class="hover:bg-opacity-50 transition-colors duration-150" onmouseover="this.style.backgroundColor='#F4F6F9'" onmouseout="this.style.backgroundColor='#FFFFFF'">
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: #0F2B4D;">
                                    <a href="{{ route('admin.shipments.show', $shipment) }}">{{ $shipment->tracking_number }}</a>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($shipment->status == 'delivered') text-white @elseif($shipment->status == 'in_transit') text-white @elseif($shipment->status == 'pending') text-gray-800 @elseif($shipment->status == 'on_hold') text-white @endif"
                                        style="@if($shipment->status == 'delivered') background-color: #38A169; @elseif($shipment->status == 'in_transit') background-color: #C6A15B; @elseif($shipment->status == 'pending') background-color: #E2E8F0; @elseif($shipment->status == 'on_hold') background-color: #E53E3E; @endif">
                                        {{ ucfirst(str_replace('_', ' ', $shipment->status)) }}
                                    </span>
                                </td>
                                <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap text-sm" style="color: #4A5568;">{{ $shipment->origin }}</td>
                                <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap text-sm" style="color: #4A5568;">{{ $shipment->destination }}</td>
                                <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap text-sm" style="color: #4A5568;">{{ $shipment->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                            <!-- Mobile Row Details (shown only on small screens) -->
                            <tr class="md:hidden border-b" style="border-color: #E2E8F0;">
                                <td colspan="2" class="px-4 sm:px-6 py-4 text-sm" style="color: #718096; background-color: #F4F6F9;">
                                    <div class="space-y-1">
                                        <div>
                                            <span class="font-semibold" style="color: #4A5568;">Origin:</span> {{ $shipment->origin }}
                                        </div>
                                        <div>
                                            <span class="font-semibold" style="color: #4A5568;">Destination:</span> {{ $shipment->destination }}
                                        </div>
                                        <div class="sm:hidden">
                                            <span class="font-semibold" style="color: #4A5568;">Created:</span> {{ $shipment->created_at->format('Y-m-d H:i') }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 