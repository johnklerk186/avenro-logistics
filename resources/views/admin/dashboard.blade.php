@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold heading-font" style="color: #2D3748;">Dashboard Overview</h1>
        <p class="text-sm mt-1" style="color: #718096;">Welcome back! Here's what's happening with your shipments today.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6 transition-all duration-200 hover:shadow-xl" style="border-left: 4px solid #0F2B4D;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider mb-1" style="color: #718096;">Total Shipments</p>
                    <p class="text-3xl font-bold heading-font" style="color: #2D3748;">{{ $stats['total_shipments'] }}</p>
                </div>
                <div class="p-4 rounded-full" style="background-color: #F1F4F9;">
                    <i class="fas fa-box fa-2x" style="color: #0F2B4D;"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 transition-all duration-200 hover:shadow-xl" style="border-left: 4px solid #C6A15B;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider mb-1" style="color: #718096;">Pending</p>
                    <p class="text-3xl font-bold heading-font" style="color: #2D3748;">{{ $stats['pending_shipments'] }}</p>
                </div>
                <div class="p-4 rounded-full" style="background-color: #F4ECDC;">
                    <i class="fas fa-clock fa-2x" style="color: #C6A15B;"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 transition-all duration-200 hover:shadow-xl" style="border-left: 4px solid #1B4470;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider mb-1" style="color: #718096;">In Transit</p>
                    <p class="text-3xl font-bold heading-font" style="color: #2D3748;">{{ $stats['in_transit_shipments'] }}</p>
                </div>
                <div class="p-4 rounded-full" style="background-color: #F4F6F9;">
                    <i class="fas fa-truck fa-2x" style="color: #1B4470;"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 transition-all duration-200 hover:shadow-xl" style="border-left: 4px solid #38A169;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider mb-1" style="color: #718096;">Delivered</p>
                    <p class="text-3xl font-bold heading-font" style="color: #2D3748;">{{ $stats['delivered_shipments'] }}</p>
                </div>
                <div class="p-4 rounded-full" style="background-color: #E6F7ED;">
                    <i class="fas fa-check-circle fa-2x" style="color: #38A169;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">
        <!-- Recent Shipments -->
        <div class="bg-white rounded-lg shadow-lg p-6" style="border-top: 3px solid #0F2B4D;">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold heading-font" style="color: #2D3748;">
                    <i class="fas fa-history mr-2" style="color: #0F2B4D;"></i>Recent Shipments
                </h2>
                <a href="{{ route('admin.shipments.index') }}" class="text-sm font-semibold transition-colors duration-150" style="color: #0F2B4D;" onmouseover="this.style.color='#0A1F3D'" onmouseout="this.style.color='#0F2B4D'">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="overflow-x-auto -mx-4 md:mx-0">
                <div class="inline-block min-w-full align-middle">
                    <table class="min-w-full divide-y" style="border-color: #E2E8F0;">
                        <thead style="background-color: #F1F4F9;">
                            <tr>
                                <th class="px-4 md:px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                    Tracking #
                                </th>
                                <th class="px-4 md:px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                    Status
                                </th>
                                <th class="px-4 md:px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                    Date
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y" style="border-color: #E2E8F0;">
                            @foreach($stats['recent_shipments'] as $shipment)
                            <tr class="hover:bg-opacity-50 transition-colors duration-150" onmouseover="this.style.backgroundColor='#F4F6F9'" onmouseout="this.style.backgroundColor='#FFFFFF'">
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: #0F2B4D;">
                                    <a href="{{ route('admin.shipments.show', $shipment) }}">
                                        {{ $shipment->tracking_number }}
                                    </a>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($shipment->status == 'delivered') text-white @elseif($shipment->status == 'in_transit') text-white @elseif($shipment->status == 'pending') text-gray-800 @elseif($shipment->status == 'on_hold') text-white @endif"
                                        style="@if($shipment->status == 'delivered') background-color: #38A169; @elseif($shipment->status == 'in_transit') background-color: #C6A15B; @elseif($shipment->status == 'pending') background-color: #E2E8F0; @elseif($shipment->status == 'on_hold') background-color: #E53E3E; @endif">
                                        {{ ucfirst(str_replace('_', ' ', $shipment->status)) }}
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm" style="color: #4A5568;">
                                    {{ $shipment->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-lg p-6" style="border-top: 3px solid #0F2B4D;">
            <h2 class="text-xl font-bold heading-font mb-6" style="color: #2D3748;">
                <i class="fas fa-bolt mr-2" style="color: #0F2B4D;"></i>Quick Actions
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('admin.shipments.create') }}" 
                   class="flex items-center p-4 rounded-lg transition-all duration-200 border-2" 
                   style="background-color: #F1F4F9; border-color: #C6A15B;"
                   onmouseover="this.style.backgroundColor='#0F2B4D'; this.style.borderColor='#0F2B4D'; this.querySelector('.action-icon').style.backgroundColor='#FFFFFF'; this.querySelector('.action-icon').style.color='#0F2B4D'; this.querySelector('.action-text').style.color='#FFFFFF'; this.querySelector('.action-desc').style.color='#FFFFFF';"
                   onmouseout="this.style.backgroundColor='#F1F4F9'; this.style.borderColor='#C6A15B'; this.querySelector('.action-icon').style.backgroundColor='#0F2B4D'; this.querySelector('.action-icon').style.color='#FFFFFF'; this.querySelector('.action-text').style.color='#0F2B4D'; this.querySelector('.action-desc').style.color='#718096';">
                    <div class="p-3 rounded-full action-icon" style="background-color: #0F2B4D; color: #FFFFFF;">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-bold action-text" style="color: #0F2B4D;">New Shipment</p>
                        <p class="text-xs action-desc" style="color: #718096;">Create shipment</p>
                    </div>
                </a>

                <a href="{{ route('admin.reports') }}" 
                   class="flex items-center p-4 rounded-lg transition-all duration-200 border-2" 
                   style="background-color: #F1F4F9; border-color: #C6A15B;"
                   onmouseover="this.style.backgroundColor='#1B4470'; this.style.borderColor='#1B4470'; this.querySelector('.action-icon').style.backgroundColor='#FFFFFF'; this.querySelector('.action-icon').style.color='#1B4470'; this.querySelector('.action-text').style.color='#FFFFFF'; this.querySelector('.action-desc').style.color='#FFFFFF';"
                   onmouseout="this.style.backgroundColor='#F1F4F9'; this.style.borderColor='#C6A15B'; this.querySelector('.action-icon').style.backgroundColor='#1B4470'; this.querySelector('.action-icon').style.color='#FFFFFF'; this.querySelector('.action-text').style.color='#1B4470'; this.querySelector('.action-desc').style.color='#718096';">
                    <div class="p-3 rounded-full action-icon" style="background-color: #1B4470; color: #FFFFFF;">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-bold action-text" style="color: #1B4470;">Reports</p>
                        <p class="text-xs action-desc" style="color: #718096;">View analytics</p>
                    </div>
                </a>

                <a href="{{ route('admin.shipments.index') }}" 
                   class="flex items-center p-4 rounded-lg transition-all duration-200 border-2" 
                   style="background-color: #E6F7ED; border-color: #9AE6B4;"
                   onmouseover="this.style.backgroundColor='#38A169'; this.style.borderColor='#38A169'; this.querySelector('.action-icon').style.backgroundColor='#FFFFFF'; this.querySelector('.action-icon').style.color='#38A169'; this.querySelector('.action-text').style.color='#FFFFFF'; this.querySelector('.action-desc').style.color='#FFFFFF';"
                   onmouseout="this.style.backgroundColor='#E6F7ED'; this.style.borderColor='#9AE6B4'; this.querySelector('.action-icon').style.backgroundColor='#38A169'; this.querySelector('.action-icon').style.color='#FFFFFF'; this.querySelector('.action-text').style.color='#38A169'; this.querySelector('.action-desc').style.color='#718096';">
                    <div class="p-3 rounded-full action-icon" style="background-color: #38A169; color: #FFFFFF;">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-bold action-text" style="color: #38A169;">Shipments</p>
                        <p class="text-xs action-desc" style="color: #718096;">Manage all</p>
                    </div>
                </a>

                <a href="{{ route('admin.settings') }}" 
                   class="flex items-center p-4 rounded-lg transition-all duration-200 border-2" 
                   style="background-color: #F4ECDC; border-color: #F6E05E;"
                   onmouseover="this.style.backgroundColor='#C6A15B'; this.style.borderColor='#C6A15B'; this.querySelector('.action-icon').style.backgroundColor='#FFFFFF'; this.querySelector('.action-icon').style.color='#C6A15B'; this.querySelector('.action-text').style.color='#FFFFFF'; this.querySelector('.action-desc').style.color='#FFFFFF';"
                   onmouseout="this.style.backgroundColor='#F4ECDC'; this.style.borderColor='#F6E05E'; this.querySelector('.action-icon').style.backgroundColor='#C6A15B'; this.querySelector('.action-icon').style.color='#FFFFFF'; this.querySelector('.action-text').style.color='#C6A15B'; this.querySelector('.action-desc').style.color='#718096';">
                    <div class="p-3 rounded-full action-icon" style="background-color: #C6A15B; color: #FFFFFF;">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-bold action-text" style="color: #C6A15B;">Settings</p>
                        <p class="text-xs action-desc" style="color: #718096;">System config</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 
