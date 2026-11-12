@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6" style="background-color: #F4F6F9;">
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6 bg-white rounded-lg shadow-md p-6" style="border-left: 4px solid #0F2B4D;">
            <div>
                <h1 class="text-3xl font-bold" style="color: #2D3748; font-family: 'Pathway Gothic One', sans-serif;">Create New Shipment</h1>
                <p class="text-sm mt-1" style="color: #718096;">Fill in the details to create a new shipment</p>
            </div>
            <a href="{{ route('admin.shipments.index') }}" 
               class="inline-flex items-center px-4 py-2 rounded-lg font-semibold transition-colors duration-150"
               style="color: #0F2B4D; border: 2px solid #0F2B4D;"
               onmouseover="this.style.backgroundColor='#F1F4F9'"
               onmouseout="this.style.backgroundColor='transparent'">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
        </div>

        @if($errors->any())
        <div class="border rounded-lg px-6 py-4 mb-6 shadow-sm" style="background-color: #FED7D7; border-color: #E53E3E; color: #742A2A;">
            <div class="flex items-start">
                <i class="fas fa-exclamation-circle mr-3 mt-1" style="color: #E53E3E;"></i>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                    <li class="font-medium">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        @php
            $currencyLabel = ($siteCurrency['label'] ?? ($siteCurrency['code'] ?? 'Currency'));
            $currencySymbol = ($siteCurrency['symbol'] ?? ($siteCurrency['code'] ?? ''));
        @endphp

        <!-- Form Card -->
        <form id="shipment-create-form" action="{{ route('admin.shipments.store') }}" method="POST" class="bg-white rounded-lg shadow-lg p-8" style="border-top: 3px solid #0F2B4D;">
            @csrf
            <div class="space-y-8">
                <h2 class="text-xl font-bold pb-3 border-b-2" style="color: #2D3748; border-color: #C6A15B; font-family: 'Pathway Gothic One', sans-serif;">
                    <i class="fas fa-box mr-2" style="color: #0F2B4D;"></i>Shipment Details
                </h2>

                <!-- Sender Information -->
                <div class="space-y-4">
                    <h2 class="text-xl font-bold pb-3 border-b-2" style="color: #2D3748; border-color: #C6A15B; font-family: 'Pathway Gothic One', sans-serif;">
                        <i class="fas fa-user mr-2" style="color: #0F2B4D;"></i>Sender Information
                    </h2>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Sender Name *</label>
                        <input type="text" name="sender_name" value="{{ old('sender_name') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Sender Email *</label>
                        <input type="email" name="sender_email" value="{{ old('sender_email') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Sender Phone *</label>
                        <input type="text" name="sender_phone" value="{{ old('sender_phone') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Sender Address *</label>
                        <textarea name="sender_address" rows="3"
                                  class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                                  style="border-color: #E2E8F0;"
                                  placeholder="Full address including street, city, state/province, postal code, country"
                                  onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                                  onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">{{ old('sender_address') }}</textarea>
                    </div>
                </div>

                <!-- Receiver Information -->
                <div class="space-y-4">
                    <h2 class="text-xl font-bold pb-3 border-b-2" style="color: #2D3748; border-color: #C6A15B; font-family: 'Pathway Gothic One', sans-serif;">
                        <i class="fas fa-user-check mr-2" style="color: #0F2B4D;"></i>Receiver Information
                    </h2>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Receiver Name *</label>
                        <input type="text" name="receiver_name" value="{{ old('receiver_name') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Receiver Email *</label>
                        <input type="email" name="receiver_email" value="{{ old('receiver_email') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Receiver Phone *</label>
                        <input type="text" name="receiver_phone" value="{{ old('receiver_phone') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Receiver Address *</label>
                        <textarea name="receiver_address" rows="3"
                                  class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                                  style="border-color: #E2E8F0;"
                                  placeholder="Full address including street, city, state/province, postal code, country"
                                  onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                                  onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">{{ old('receiver_address') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Package Information -->
            <div class="mt-8 space-y-6">
                <h2 class="text-xl font-bold pb-3 border-b-2" style="color: #2D3748; border-color: #C6A15B; font-family: 'Pathway Gothic One', sans-serif;">
                    <i class="fas fa-box-open mr-2" style="color: #0F2B4D;"></i>Package Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Package Name/Label *</label>
                        <input type="text" name="package_name" value="{{ old('package_name') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               placeholder="e.g., Electronics, Documents, Clothing"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Package Type *</label>
                        <select name="package_type"
                                class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                                style="border-color: #E2E8F0;"
                                onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                                onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                            <option value="" {{ old('package_type') == '' ? 'selected' : '' }}>Select Package Type</option>
                            <option value="Box" {{ old('package_type') == 'Box' ? 'selected' : '' }}>Box</option>
                            <option value="Envelope" {{ old('package_type') == 'Envelope' ? 'selected' : '' }}>Envelope</option>
                            <option value="Pallet" {{ old('package_type') == 'Pallet' ? 'selected' : '' }}>Pallet</option>
                            <option value="Crate" {{ old('package_type') == 'Crate' ? 'selected' : '' }}>Crate</option>
                            <option value="Bag" {{ old('package_type') == 'Bag' ? 'selected' : '' }}>Bag</option>
                            <option value="Other" {{ old('package_type') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Weight (kg) *</label>
                        <input type="number" step="0.01" name="weight" value="{{ old('weight') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Length (cm)</label>
                        <input type="number" step="0.01" name="dimensions[length]" value="{{ old('dimensions.length') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Width (cm)</label>
                        <input type="number" step="0.01" name="dimensions[width]" value="{{ old('dimensions.width') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Height (cm)</label>
                        <input type="number" step="0.01" name="dimensions[height]" value="{{ old('dimensions.height') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Declared Value ({{ $currencyLabel }})</label>
                        <input type="number" step="0.01" name="declared_value" value="{{ old('declared_value') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               placeholder="{{ $currencySymbol }}0.00"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Quantity</label>
                        <input type="number" min="1" name="qty" value="{{ old('qty', 1) }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Package Description</label>
                    <textarea name="package_description" rows="3"
                              class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                              style="border-color: #E2E8F0;"
                              placeholder="Detailed description of package contents"
                              onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                              onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">{{ old('package_description') }}</textarea>
                </div>
            </div>

            <!-- Shipment Details -->
            <div class="mt-8 space-y-6">
                <h2 class="text-xl font-bold pb-3 border-b-2" style="color: #2D3748; border-color: #C6A15B; font-family: 'Pathway Gothic One', sans-serif;">
                    <i class="fas fa-box mr-2" style="color: #0F2B4D;"></i>Shipment Details
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;"><i class="fas fa-map-marker-alt mr-1" style="color: #0F2B4D;"></i>Origin *</label>
                        <input type="text" name="origin" value="{{ old('origin') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               placeholder="City, Country"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;"><i class="fas fa-flag-checkered mr-1" style="color: #0F2B4D;"></i>Destination *</label>
                        <input type="text" name="destination" value="{{ old('destination') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               placeholder="City, Country"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Shipment Mode *</label>
                        <select name="shipping_type"
                                class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                                style="border-color: #E2E8F0;"
                                onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                                onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                            <option value="" {{ old('shipping_type') == '' ? 'selected' : '' }}>Select Transport Mode</option>
                            <option value="air" {{ old('shipping_type') == 'air' ? 'selected' : '' }}>Air Freight</option>
                            <option value="sea" {{ old('shipping_type') == 'sea' ? 'selected' : '' }}>Sea Freight</option>
                            <option value="road" {{ old('shipping_type') == 'road' ? 'selected' : '' }}>Road Transport</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #4A5568;"><i class="fas fa-calendar-alt mr-1" style="color: #0F2B4D;"></i>Estimated Delivery Date *</label>
                    <input type="date" name="estimated_delivery_date" value="{{ old('estimated_delivery_date') }}"
                           class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                           style="border-color: #E2E8F0;"
                           onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                           onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                </div>

                <div class="mt-4 p-4 rounded-lg" style="background-color: #F1F4F9; border: 1px solid #C6A15B;">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="show_map" 
                               id="show_map" 
                               value="1" 
                               {{ old('show_map', true) ? 'checked' : '' }}
                               class="h-5 w-5 rounded transition-all duration-150"
                               style="color: #0F2B4D; border-color: #0F2B4D;">
                        <label for="show_map" class="ml-3 block text-sm font-semibold" style="color: #2D3748;">
                            <i class="fas fa-map-marked-alt mr-1" style="color: #0F2B4D;"></i>Show tracking map on customer tracking page
                        </label>
                    </div>
                    <p class="mt-2 text-sm ml-8" style="color: #718096;">
                        When enabled, customers will see a map showing the shipment's journey on the tracking page.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Service Type</label>
                        <select name="service_type"
                                class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                                style="border-color: #E2E8F0;"
                                onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                                onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                            <option value="" {{ old('service_type') == '' ? 'selected' : '' }}>Select Service Type</option>
                            <option value="Warehousing" {{ old('service_type') == 'Warehousing' ? 'selected' : '' }}>Warehousing</option>
                            <option value="Pet Relocation" {{ old('service_type') == 'Pet Relocation' ? 'selected' : '' }}>Pet Relocation</option>
                            <option value="General Freight" {{ old('service_type') == 'General Freight' ? 'selected' : '' }}>General Freight</option>
                            <option value="Express Delivery" {{ old('service_type') == 'Express Delivery' ? 'selected' : '' }}>Express Delivery</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Carrier</label>
                        <select name="carrier"
                                class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                                style="border-color: #E2E8F0;"
                                onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                                onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                            <option value="" {{ old('carrier') == '' ? 'selected' : '' }}>Select Carrier</option>
                            <option value="FedEx" {{ old('carrier') == 'FedEx' ? 'selected' : '' }}>FedEx</option>
                            <option value="UPS" {{ old('carrier') == 'UPS' ? 'selected' : '' }}>UPS</option>
                            <option value="DHL" {{ old('carrier') == 'DHL' ? 'selected' : '' }}>DHL</option>
                            <option value="USPS" {{ old('carrier') == 'USPS' ? 'selected' : '' }}>USPS</option>
                            <option value="TNT" {{ old('carrier') == 'TNT' ? 'selected' : '' }}>TNT</option>
                            <option value="Aramex" {{ old('carrier') == 'Aramex' ? 'selected' : '' }}>Aramex</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Priority Level</label>
                        <select name="priority"
                                class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                                style="border-color: #E2E8F0;"
                                onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                                onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                            <option value="" {{ old('priority') == '' ? 'selected' : '' }}>Select Priority</option>
                            <option value="Standard" {{ old('priority') == 'Standard' ? 'selected' : '' }}>Standard</option>
                            <option value="Express" {{ old('priority') == 'Express' ? 'selected' : '' }}>Express</option>
                            <option value="Urgent" {{ old('priority') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Carrier Reference No. *</label>
                        <input type="text" name="carrier_reference_no" value="{{ old('carrier_reference_no') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               placeholder="e.g., 7122648472"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Product *</label>
                        <input type="text" name="product" value="{{ old('product') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               placeholder="e.g., Puppy, Electronics"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Payment Mode</label>
                        <select name="payment_mode"
                                class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                                style="border-color: #E2E8F0;"
                                onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                                onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                            <option value="" {{ old('payment_mode') == '' ? 'selected' : '' }}>Select Payment Mode</option>
                            <option value="Cash" {{ old('payment_mode') == 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="Credit Card" {{ old('payment_mode') == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                            <option value="Bank Transfer" {{ old('payment_mode') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                            <option value="PayPal" {{ old('payment_mode') == 'PayPal' ? 'selected' : '' }}>PayPal</option>
                            <option value="Chime" {{ old('payment_mode') == 'Chime' ? 'selected' : '' }}>Chime</option>
                            <option value="Zelle" {{ old('payment_mode') == 'Zelle' ? 'selected' : '' }}>Zelle</option>
                            <option value="Venmo" {{ old('payment_mode') == 'Venmo' ? 'selected' : '' }}>Venmo</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Total Freight ({{ $currencyLabel }})</label>
                        <input type="number" step="0.01" min="0" name="total_freight" value="{{ old('total_freight') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               placeholder="{{ $currencySymbol }}0.00"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Departure Time</label>
                        <input type="time" name="departure_time" value="{{ old('departure_time') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Pick-up Date</label>
                        <input type="date" name="pickup_date" value="{{ old('pickup_date') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Pick-up Time</label>
                        <input type="time" name="pickup_time" value="{{ old('pickup_time') }}"
                               class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                               style="border-color: #E2E8F0;"
                               onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                               onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Comments</label>
                    <textarea name="comments" rows="3"
                              class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                              style="border-color: #E2E8F0;"
                              placeholder="e.g., Please be at the pickup location on time"
                              onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                              onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">{{ old('comments') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2" style="color: #4A5568;">Special Instructions</label>
                    <textarea name="special_instructions" rows="3"
                              class="mt-1 block w-full rounded-lg border-2 shadow-sm px-4 py-2 transition-all duration-150"
                              style="border-color: #E2E8F0;"
                              placeholder="Any special handling instructions or notes"
                              oninput="document.getElementById('notes_mirror').value = this.value"
                              onfocus="this.style.borderColor='#0F2B4D'; this.style.boxShadow='0 0 0 3px rgba(15, 43, 77, 0.1)'"
                              onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none'">{{ old('special_instructions') }}</textarea>
                </div>

                <input type="hidden" id="notes_mirror" name="notes" value="{{ old('special_instructions') }}">
            </div>

            <div class="mt-8">
                <button type="submit" 
                        class="w-full px-6 py-4 rounded-lg font-bold text-lg transition-all duration-200 shadow-lg"
                        style="background-color: #0F2B4D; color: #FFFFFF; font-family: 'Pathway Gothic One', sans-serif;"
                        onmouseover="this.style.backgroundColor='#0A1F3D'; this.style.boxShadow='0 10px 25px rgba(15, 43, 77, 0.3)'"
                        onmouseout="this.style.backgroundColor='#0F2B4D'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                    <i class="fas fa-plus-circle mr-2"></i>Create Shipment
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('shipment-create-form');
    if (!form) return;

    var storageKey = 'admin.shipments.create.draft';

    function getFieldKey(el) {
        return el.name;
    }

    function isRestorable(el) {
        if (!el.name) return false;
        if (el.name === '_token') return false;
        return true;
    }

    function readDraft() {
        try {
            var raw = localStorage.getItem(storageKey);
            return raw ? JSON.parse(raw) : {};
        } catch (e) {
            return {};
        }
    }

    function writeDraft(data) {
        try {
            localStorage.setItem(storageKey, JSON.stringify(data));
        } catch (e) {
            // Ignore quota/security errors
        }
    }

    function captureDraft() {
        var data = readDraft();
        Array.prototype.forEach.call(form.elements, function (el) {
            if (!isRestorable(el)) return;
            var key = getFieldKey(el);

            if (el.type === 'checkbox' || el.type === 'radio') {
                data[key] = !!el.checked;
            } else {
                data[key] = el.value;
            }
        });
        writeDraft(data);
    }

    function restoreDraft() {
        var data = readDraft();
        Array.prototype.forEach.call(form.elements, function (el) {
            if (!isRestorable(el)) return;
            var key = getFieldKey(el);
            if (!(key in data)) return;

            if (el.type === 'checkbox' || el.type === 'radio') {
                if (!el.checked) {
                    el.checked = !!data[key];
                }
                return;
            }

            if (!el.value) {
                el.value = data[key] ?? '';
            }
        });

        var special = form.querySelector('[name="special_instructions"]');
        var notes = document.getElementById('notes_mirror');
        if (special && notes && !notes.value) {
            notes.value = special.value;
        }
    }

    restoreDraft();

    form.addEventListener('input', function (e) {
        if (!e.target || !isRestorable(e.target)) return;
        captureDraft();
    });

    form.addEventListener('change', function (e) {
        if (!e.target || !isRestorable(e.target)) return;
        captureDraft();
    });

    form.addEventListener('submit', function () {
        try {
            localStorage.removeItem(storageKey);
        } catch (e) {
            // ignore
        }
    });
});
</script>
@endsection