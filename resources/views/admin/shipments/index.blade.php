@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6" style="background-color: #F4F6F9;">
    <!-- Page Header with Orange Accent -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4 sm:gap-0 bg-white rounded-lg shadow-md p-6" style="border-left: 4px solid #0F2B4D;">
        <div>
            <h1 class="text-3xl font-bold" style="color: #2D3748; font-family: 'Pathway Gothic One', sans-serif;">Manage Shipments</h1>
            <p class="text-sm mt-1" style="color: #718096;">Track and manage all your shipments</p>
        </div>
        <a href="{{ route('admin.shipments.create') }}" 
           class="inline-flex items-center px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg"
           style="background-color: #0F2B4D; color: #FFFFFF;">
            <i class="fas fa-plus mr-2"></i>
            Create New Shipment
        </a>
    </div>

    @if(session('success'))
    <div class="border rounded-lg px-6 py-4 mb-6 shadow-sm" style="background-color: #D4EDDA; border-color: #38A169; color: #155724;">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3" style="color: #38A169;"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <!-- Shipments Table Card -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden" style="border-top: 3px solid #0F2B4D;">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <table class="min-w-full divide-y" style="border-color: #E2E8F0;">
                    <thead style="background-color: #F1F4F9;">
                        <tr>
                            <th class="px-4 md:px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                <i class="fas fa-barcode mr-2" style="color: #0F2B4D;"></i>Tracking Number
                            </th>
                            <th class="px-4 md:px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                <i class="fas fa-info-circle mr-2" style="color: #0F2B4D;"></i>Status
                            </th>
                            <th class="hidden md:table-cell px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                <i class="fas fa-map-marker-alt mr-2" style="color: #0F2B4D;"></i>Origin
                            </th>
                            <th class="hidden md:table-cell px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                <i class="fas fa-flag-checkered mr-2" style="color: #0F2B4D;"></i>Destination
                            </th>
                            <th class="hidden lg:table-cell px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                <i class="fas fa-location-arrow mr-2" style="color: #0F2B4D;"></i>Current Location
                            </th>
                            <th class="px-4 md:px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #4A5568;">
                                <i class="fas fa-cog mr-2" style="color: #0F2B4D;"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y" style="border-color: #E2E8F0;">
                        @foreach($shipments as $shipment)
                        <tr class="hover:bg-opacity-50 transition-colors duration-150" style="background-color: #FFFFFF;" onmouseover="this.style.backgroundColor='#F4F6F9'" onmouseout="this.style.backgroundColor='#FFFFFF'">
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-bold" style="color: #0F2B4D;">
                                {{ $shipment->tracking_number }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($shipment->status == 'delivered') text-white @elseif($shipment->status == 'in_transit') text-white @elseif($shipment->status == 'pending') text-gray-800 @elseif($shipment->status == 'on_hold') text-white @endif"
                                    style="@if($shipment->status == 'delivered') background-color: #38A169; @elseif($shipment->status == 'in_transit') background-color: #C6A15B; @elseif($shipment->status == 'pending') background-color: #E2E8F0; @elseif($shipment->status == 'on_hold') background-color: #E53E3E; @endif">
                                    {{ ucfirst(str_replace('_', ' ', $shipment->status)) }}
                                </span>
                            </td>
                            <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap text-sm" style="color: #4A5568;">
                                {{ $shipment->origin }}
                            </td>
                            <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap text-sm" style="color: #4A5568;">
                                {{ $shipment->destination }}
                            </td>
                            <td class="hidden lg:table-cell px-6 py-4 whitespace-nowrap text-sm" style="color: #4A5568;">
                                {{ $shipment->current_location }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                                    <a href="{{ route('admin.shipments.show', $shipment) }}" 
                                       class="inline-flex items-center font-semibold transition-colors duration-150"
                                       style="color: #0F2B4D;"
                                       onmouseover="this.style.color='#0A1F3D'"
                                       onmouseout="this.style.color='#0F2B4D'">
                                        <i class="fas fa-eye mr-1"></i>
                                        <span class="sm:inline">View</span>
                                    </a>
                                    <a href="{{ route('admin.shipments.edit', $shipment) }}" 
                                       class="inline-flex items-center font-semibold transition-colors duration-150"
                                       style="color: #0F2B4D;"
                                       onmouseover="this.style.color='#0A1F3D'"
                                       onmouseout="this.style.color='#0F2B4D'">
                                        <i class="fas fa-edit mr-1"></i>
                                        <span class="sm:inline">Edit</span>
                                    </a>
                                    <form action="{{ route('admin.shipments.destroy', $shipment) }}" 
                                          method="POST" 
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center font-semibold transition-colors duration-150"
                                                style="color: #E53E3E;"
                                                onmouseover="this.style.color='#C53030'"
                                                onmouseout="this.style.color='#E53E3E'"
                                                onclick="return confirm('Are you sure you want to delete this shipment?')">
                                            <i class="fas fa-trash-alt mr-1"></i>
                                            <span class="sm:inline">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $shipments->links() }}
    </div>
</div>
@endsection 