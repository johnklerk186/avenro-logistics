@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6" style="background-color: #F4F6F9;">
    <div class="max-w-5xl mx-auto">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 bg-white rounded-lg shadow-md p-6 gap-4" style="border-left: 4px solid #0F2B4D;">
            <div>
                <h1 class="text-3xl font-bold" style="color: #2D3748; font-family: 'Pathway Gothic One', sans-serif;">Shipment Details</h1>
                <p class="text-sm mt-1" style="color: #718096;">View complete shipment information</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.shipments.edit', $shipment) }}" 
                   class="inline-flex items-center px-5 py-2 rounded-lg font-semibold transition-all duration-200 shadow-md"
                   style="background-color: #0F2B4D; color: #FFFFFF;"
                   onmouseover="this.style.backgroundColor='#0A1F3D'"
                   onmouseout="this.style.backgroundColor='#0F2B4D'">
                    <i class="fas fa-edit mr-2"></i>Edit Shipment
                </a>
                <a href="{{ route('admin.shipments.index') }}" 
                   class="inline-flex items-center px-4 py-2 rounded-lg font-semibold transition-colors duration-150"
                   style="color: #0F2B4D; border: 2px solid #0F2B4D;"
                   onmouseover="this.style.backgroundColor='#F1F4F9'"
                   onmouseout="this.style.backgroundColor='transparent'">
                    <i class="fas fa-arrow-left mr-2"></i>Back to List
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="border rounded-lg px-6 py-4 mb-6 shadow-sm" style="background-color: #D4EDDA; border-color: #38A169; color: #155724;">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3" style="color: #38A169;"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- Tracking Information Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6" style="border-top: 3px solid #0F2B4D;">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-2xl font-bold mb-2" style="color: #2D3748; font-family: 'Pathway Gothic One', sans-serif;">
                        <i class="fas fa-barcode mr-2" style="color: #0F2B4D;"></i>{{ $shipment->tracking_number }}
                    </h2>
                    <div class="flex items-center">
                        <span class="text-sm font-semibold mr-2" style="color: #4A5568;">Status:</span>
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($shipment->status == 'delivered') text-white @elseif($shipment->status == 'in_transit') text-white @elseif($shipment->status == 'pending') text-gray-800 @elseif($shipment->status == 'on_hold') text-white @endif"
                            style="@if($shipment->status == 'delivered') background-color: #38A169; @elseif($shipment->status == 'in_transit') background-color: #C6A15B; @elseif($shipment->status == 'pending') background-color: #E2E8F0; @elseif($shipment->status == 'on_hold') background-color: #E53E3E; @endif">
                            {{ ucfirst(str_replace('_', ' ', $shipment->status)) }}
                        </span>
                    </div>
                </div>
                <button type="button" 
                        onclick="document.getElementById('updateStatusModal').classList.remove('hidden')"
                        class="px-5 py-3 rounded-lg font-bold transition-all duration-200 shadow-md"
                        style="background-color: #0F2B4D; color: #FFFFFF; font-family: 'Pathway Gothic One', sans-serif;"
                        onmouseover="this.style.backgroundColor='#0A1F3D'; this.style.boxShadow='0 8px 20px rgba(15, 43, 77, 0.3)'"
                        onmouseout="this.style.backgroundColor='#0F2B4D'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                    <i class="fas fa-sync-alt mr-2"></i>Update Status
                </button>
            </div>
        </div>

        @php
            $siteCurrency = $siteCurrency ?? [];
            $currencySymbol = $siteCurrency['symbol'] ?? ($siteCurrency['code'] ?? '');
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Shipment Information -->
            <div class="bg-white rounded-lg shadow-lg p-6" style="border-left: 3px solid #0F2B4D;">
                <h3 class="text-xl font-bold mb-4 pb-2 border-b-2" style="color: #2D3748; border-color: #C6A15B; font-family: 'Pathway Gothic One', sans-serif;">
                    <i class="fas fa-box mr-2" style="color: #0F2B4D;"></i>Shipment Information
                </h3>
                <div style="margin-top: 20px;">
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Origin:</strong>
                        <span>{{ $shipment->origin }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Destination:</strong>
                        <span>{{ $shipment->destination }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Package:</strong>
                        <span>{{ $shipment->package_name ?? $shipment->product ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Status:</strong>
                        <span style="color: #0F2B4D; font-weight: bold;">{{ $shipment->status }}</span>
                    </div>
                    @if($shipment->carrier)
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Carrier:</strong>
                        <span>{{ $shipment->carrier }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Weight:</strong>
                        <span>{{ $shipment->weight }} kg</span>
                    </div>
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Shipment Mode:</strong>
                        <span>{{ $shipment->shipment_mode ?? ucfirst($shipment->shipping_type) }}</span>
                    </div>
                    @if($shipment->carrier_reference_no)
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Carrier Reference No.:</strong>
                        <span>{{ $shipment->carrier_reference_no }}</span>
                    </div>
                    @endif
                    @if($shipment->product)
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Product:</strong>
                        <span>{{ $shipment->product }}</span>
                    </div>
                    @endif
                    @if($shipment->qty)
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Qty:</strong>
                        <span>{{ $shipment->qty }}</span>
                    </div>
                    @endif
                    @if($shipment->payment_mode)
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Payment Mode:</strong>
                        <span>{{ $shipment->payment_mode }}</span>
                    </div>
                    @endif
                    @if(!is_null($shipment->total_freight))
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Total Freight:</strong>
                        <span>{{ $currencySymbol }}{{ number_format((float) $shipment->total_freight, 2) }}</span>
                    </div>
                    @endif
                    @if($shipment->estimated_delivery_date)
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Expected Delivery Date:</strong>
                        <span>{{ \Carbon\Carbon::parse($shipment->estimated_delivery_date)->format('Y-m-d') }}</span>
                    </div>
                    @endif
                    @if($shipment->departure_time)
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Departure Time:</strong>
                        <span>{{ \Carbon\Carbon::parse($shipment->departure_time)->format('H:i') }}</span>
                    </div>
                    @endif
                    @if($shipment->pickup_date)
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Pick-up Date:</strong>
                        <span>{{ \Carbon\Carbon::parse($shipment->pickup_date)->format('Y-m-d') }}</span>
                    </div>
                    @endif
                    @if($shipment->pickup_time)
                    <div class="flex justify-between py-2" style="border-color: #EEEEEE;">
                        <strong>Pick-up Time:</strong>
                        <span>{{ \Carbon\Carbon::parse($shipment->pickup_time)->format('H:i') }}</span>
                    </div>
                    @endif

                    @if($shipment->comments)
                    <div class="pt-3">
                        <strong>Comments:</strong>
                        <p class="mt-1" style="color: #555;">{{ $shipment->comments }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Current Status -->
            <div class="bg-white rounded-lg shadow-lg p-6" style="border-left: 3px solid #0F2B4D;">
                <h3 class="text-xl font-bold mb-4 pb-2 border-b-2" style="color: #2D3748; border-color: #C6A15B; font-family: 'Pathway Gothic One', sans-serif;">
                    <i class="fas fa-map-marker-alt mr-2" style="color: #0F2B4D;"></i>Current Status
                </h3>
                <div class="text-center" style="margin-top: 20px;">
                    <div class="p-5 mb-5" style="background: #0F2B4D; color: white;">
                        <h4 class="mb-2" style="color: white;">{{ $shipment->status }}</h4>
                        @if($shipment->updates->count() > 0)
                            <p class="m-0">{{ $shipment->updates->first()->location }}</p>
                            <small>Updated: {{ $shipment->updates->first()->created_at->format('M d, Y H:i') }}</small>
                        @endif
                    </div>
                    @if($shipment->status !== 'delivered' && $shipment->estimated_delivery_date)
                        <p style="color: #555555;">
                            <i class="fas fa-clock"></i>
                            Estimated delivery: {{ \Carbon\Carbon::parse($shipment->estimated_delivery_date)->format('M d, Y') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sender & Receiver Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-lg p-6" style="border-left: 3px solid #0F2B4D;">
                <h3 class="text-xl font-bold mb-4 pb-2 border-b-2" style="color: #2D3748; border-color: #C6A15B; font-family: 'Pathway Gothic One', sans-serif;">
                    <i class="fas fa-user mr-2" style="color: #0F2B4D;"></i>Sender Information
                </h3>
                <div style="margin-top: 20px;">
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;"><strong>Name:</strong><span>{{ $shipment->sender_name }}</span></div>
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;"><strong>Email:</strong><span>{{ $shipment->sender_email }}</span></div>
                    @if($shipment->sender_phone)
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;"><strong>Phone:</strong><span>{{ $shipment->sender_phone }}</span></div>
                    @endif
                    @if($shipment->sender_address)
                    <div class="py-2"><strong>Address:</strong><p class="mt-1" style="color: #555;">{{ $shipment->sender_address }}</p></div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6" style="border-left: 3px solid #0F2B4D;">
                <h3 class="text-xl font-bold mb-4 pb-2 border-b-2" style="color: #2D3748; border-color: #C6A15B; font-family: 'Pathway Gothic One', sans-serif;">
                    <i class="fas fa-user-check mr-2" style="color: #0F2B4D;"></i>Receiver Information
                </h3>
                <div style="margin-top: 20px;">
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;"><strong>Name:</strong><span>{{ $shipment->receiver_name }}</span></div>
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;"><strong>Email:</strong><span>{{ $shipment->receiver_email }}</span></div>
                    @if($shipment->receiver_phone)
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;"><strong>Phone:</strong><span>{{ $shipment->receiver_phone }}</span></div>
                    @endif
                    @if($shipment->receiver_address)
                    <div class="py-2"><strong>Address:</strong><p class="mt-1" style="color: #555;">{{ $shipment->receiver_address }}</p></div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Package Information -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6" style="border-left: 3px solid #0F2B4D;">
            <h3 class="text-xl font-bold mb-4 pb-2 border-b-2" style="color: #2D3748; border-color: #C6A15B; font-family: 'Pathway Gothic One', sans-serif;">
                <i class="fas fa-box-open mr-2" style="color: #0F2B4D;"></i>Package Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" style="margin-top: 20px;">
                <div>
                    @if($shipment->package_name)
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;"><strong>Package Name:</strong><span>{{ $shipment->package_name }}</span></div>
                    @endif
                    @if($shipment->package_type)
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;"><strong>Package Type:</strong><span>{{ $shipment->package_type }}</span></div>
                    @endif
                    <div class="flex justify-between py-2 border-b" style="border-color: #EEEEEE;"><strong>Weight:</strong><span>{{ $shipment->weight }} kg</span></div>
                    @if(!is_null($shipment->declared_value))
                    <div class="flex justify-between py-2" style="border-color: #EEEEEE;"><strong>Declared Value:</strong><span>{{ $currencySymbol }}{{ number_format((float) $shipment->declared_value, 2) }}</span></div>
                    @endif
                </div>
                <div>
                    @if($shipment->length || $shipment->width || $shipment->height)
                    <div class="py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Dimensions:</strong>
                        <p class="mt-1" style="color: #555;">
                            @if($shipment->length){{ $shipment->length }}cm @endif
                            @if($shipment->width)× {{ $shipment->width }}cm @endif
                            @if($shipment->height)× {{ $shipment->height }}cm @endif
                        </p>
                    </div>
                    @endif
                    @if($shipment->package_description)
                    <div class="py-2 border-b" style="border-color: #EEEEEE;">
                        <strong>Description:</strong>
                        <p class="mt-1" style="color: #555;">{{ $shipment->package_description }}</p>
                    </div>
                    @endif
                    @if($shipment->special_instructions)
                    <div class="py-2">
                        <strong>Special Instructions:</strong>
                        <p class="mt-1" style="color: #555;">{{ $shipment->special_instructions }}</p>
                    </div>
                    @elseif($shipment->notes)
                    <div class="py-2">
                        <strong>Special Instructions:</strong>
                        <p class="mt-1" style="color: #555;">{{ $shipment->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tracking History -->
        <div class="bg-white rounded-lg shadow-lg p-6" style="border-left: 3px solid #0F2B4D;">
            <h3 class="text-xl font-bold mb-6 pb-2 border-b-2" style="color: #2D3748; border-color: #C6A15B; font-family: 'Pathway Gothic One', sans-serif;">
                <i class="fas fa-history mr-2" style="color: #0F2B4D;"></i>Tracking History
            </h3>
            <div class="flow-root">
                <ul role="list" class="-mb-8">
                    @foreach($shipment->updates as $update)
                    <li>
                        <div class="relative pb-8">
                            @if(!$loop->last)
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5" style="background-color: #C6A15B;" aria-hidden="true"></span>
                            @endif
                            <div class="relative flex space-x-4">
                                <div>
                                    <span class="h-10 w-10 rounded-full flex items-center justify-center ring-4 shadow-md" style="background-color: #0F2B4D; ring-color: #F4F6F9;">
                                        <i class="fas fa-box text-white text-sm"></i>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex flex-col md:flex-row justify-between gap-2">
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold mb-1" style="color: #2D3748;">{{ $update->description }}</p>
                                        <p class="text-xs font-medium" style="color: #718096;">
                                            <i class="fas fa-map-marker-alt mr-1" style="color: #0F2B4D;"></i>{{ $update->location }}
                                        </p>
                                    </div>
                                    <div class="text-right text-sm whitespace-nowrap">
                                        <time datetime="{{ $update->created_at->format('Y-m-d H:i') }}" class="font-semibold block" style="color: #4A5568;">
                                            {{ $update->created_at->format('M d, Y H:i') }}
                                        </time>
                                        <p class="text-xs mt-1" style="color: #718096;">By: {{ $update->admin->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div id="updateStatusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-6 border-0 w-full max-w-md shadow-2xl rounded-xl bg-white" style="border-top: 4px solid #0F2B4D;">
        <div class="mt-3">
            <h3 class="text-2xl font-bold mb-6" style="color: #2D3748; font-family: 'Pathway Gothic One', sans-serif;">
                <i class="fas fa-sync-alt mr-2" style="color: #0F2B4D;"></i>Update Shipment Status
            </h3>
            
            @if ($errors->any())
            <div class="border rounded-lg px-4 py-3 mb-4" style="background-color: #FED7D7; border-color: #E53E3E; color: #742A2A;">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.shipments.update-status', $shipment) }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">
                        <i class="fas fa-info-circle mr-1" style="color: #0F2B4D;"></i>Status
                    </label>
                    <select name="status" 
                            class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                            style="border-color: #E2E8F0;"
                            onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                            onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                        <option value="pending" {{ $shipment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="picked_up" {{ $shipment->status == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                        <option value="in_transit" {{ $shipment->status == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                        <option value="out_for_delivery" {{ $shipment->status == 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                        <option value="delivered" {{ $shipment->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="on_hold" {{ $shipment->status == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                        <option value="cancelled" {{ $shipment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">
                        <i class="fas fa-map-marker-alt mr-1" style="color: #0F2B4D;"></i>Current Location
                    </label>
                    <input type="text" name="location" value="{{ old('location', $shipment->current_location) }}" 
                           class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                           style="border-color: #E2E8F0;"
                           onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                           onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'"
                           required>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">
                        <i class="fas fa-comment-alt mr-1" style="color: #0F2B4D;"></i>Description
                    </label>
                    <textarea name="description" rows="3" 
                              class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                              style="border-color: #E2E8F0;"
                              onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                              onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'"
                              placeholder="Enter update description"
                              required>{{ old('description') }}</textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="document.getElementById('updateStatusModal').classList.add('hidden')"
                            class="px-5 py-2 rounded-lg font-semibold transition-all duration-150"
                            style="background-color: #E2E8F0; color: #4A5568;"
                            onmouseover="this.style.backgroundColor='#CBD5E0'"
                            onmouseout="this.style.backgroundColor='#E2E8F0'">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-5 py-2 rounded-lg font-bold transition-all duration-200 shadow-md"
                            style="background-color: #0F2B4D; color: #FFFFFF; font-family: 'Pathway Gothic One', sans-serif;"
                            onmouseover="this.style.backgroundColor='#0A1F3D'; this.style.boxShadow='0 8px 20px rgba(15, 43, 77, 0.3)'"
                            onmouseout="this.style.backgroundColor='#0F2B4D'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                        <i class="fas fa-check mr-2"></i>Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 