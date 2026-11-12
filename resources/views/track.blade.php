@extends('layouts.app')

@section('title', 'Track Shipment — Avenro Logistics')
@section('meta_description', 'Track your Avenro Logistics shipment in real time — status, location, timeline and estimated delivery.')

@section('content')
<!-- Hero -->
<section class="relative bg-navy-950 overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_20%,rgba(198,161,91,0.15),transparent_55%)]"></div>
    <div class="relative max-w-7xl mx-auto px-4 py-20 md:py-24 text-center">
        <p class="text-gold-400 font-semibold text-sm tracking-[0.25em] uppercase mb-4">Shipment Tracking</p>
        <h1 class="font-display text-4xl md:text-5xl font-extrabold text-white">Track your shipment</h1>
        <p class="mt-4 text-white/70 max-w-xl mx-auto">Enter your tracking number to view real-time status, location history and estimated delivery.</p>
    </div>
</section>

@if(!request('tracking_number'))
<!-- Tracking Form -->
<section class="py-16 bg-mist">
    <div class="max-w-md mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-soft border border-line p-8">
            <form action="{{ route('track') }}" method="GET" class="space-y-5">
                <div>
                    <label for="tracking_number" class="block text-sm font-semibold text-ink mb-2">
                        <i class="fas fa-magnifying-glass mr-2 text-gold-600"></i>Tracking Number
                    </label>
                    <input type="text" name="tracking_number" id="tracking_number" required
                           class="w-full px-4 py-3.5 rounded-lg border border-line focus:border-gold-500 focus:ring-2 focus:ring-gold-500/20 outline-none transition text-sm"
                           placeholder="e.g. AVN-000000" value="{{ request('tracking_number') }}">
                </div>

                @if(isset($error))
                <div class="p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm flex items-center gap-2">
                    <i class="fas fa-triangle-exclamation"></i> {{ $error }}
                </div>
                @endif

                <button type="submit" class="avenro-btn avenro-btn-navy w-full justify-center">
                    <i class="fas fa-location-dot"></i> Track Shipment
                </button>
            </form>
            <p class="mt-5 text-xs text-ink/50 text-center">Your tracking number is in your shipping confirmation email or receipt.</p>
        </div>
    </div>
</section>
@endif

@if(isset($shipment) && $success)
@php $currencySymbol = $siteCurrency['symbol'] ?? ($siteCurrency['code'] ?? ''); @endphp
<section class="py-16 bg-mist min-h-[50vh]">
    <div class="max-w-7xl mx-auto px-4">

        <!-- Status header -->
        <div class="bg-navy-900 rounded-2xl p-8 md:p-10 text-white shadow-soft mb-8 reveal">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <p class="text-gold-400 text-xs font-semibold tracking-[0.2em] uppercase mb-2">Tracking Number</p>
                    <h2 class="font-display text-2xl md:text-3xl font-bold">{{ $shipment->tracking_number }}</h2>
                    <div class="mt-4 inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold bg-gold-500/15 text-gold-300 border border-gold-500/40">
                        <i class="fas fa-circle text-[8px]"></i> {{ ucwords(str_replace('_', ' ', $shipment->status ?? 'N/A')) }}
                    </div>
                </div>
                <div class="text-left md:text-right">
                    <p class="text-white/60 text-sm">Estimated Delivery</p>
                    <p class="font-display text-xl font-bold text-gold-300">
                        {{ $shipment->estimated_delivery_date ? \Carbon\Carbon::parse($shipment->estimated_delivery_date)->format('M d, Y') : 'N/A' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Shipment details -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-2xl border border-line shadow-soft p-8 reveal">
                    <h3 class="font-display text-lg font-bold text-navy-900 mb-6 flex items-center gap-3">
                        <span class="w-9 h-9 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center text-sm"><i class="fas fa-box"></i></span>
                        Shipment Information
                    </h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                        @foreach([
                            'Origin' => $shipment->origin,
                            'Destination' => $shipment->destination,
                            'Package' => $shipment->package_name ?? $shipment->product,
                            'Carrier' => $shipment->carrier,
                            'Service Type' => $shipment->service_type,
                            'Priority' => $shipment->priority,
                            'Shipment Mode' => $shipment->shipment_mode,
                            'Carrier Ref.' => $shipment->carrier_reference_no,
                            'Payment Mode' => $shipment->payment_mode,
                        ] as $label => $value)
                        <div class="flex justify-between sm:block border-b border-line/70 pb-3">
                            <dt class="text-ink/50">{{ $label }}</dt>
                            <dd class="font-semibold text-ink mt-0.5">{{ $value ?? 'N/A' }}</dd>
                        </div>
                        @endforeach
                        <div class="flex justify-between sm:block border-b border-line/70 pb-3">
                            <dt class="text-ink/50">Weight</dt>
                            <dd class="font-semibold text-ink mt-0.5">{{ !is_null($shipment->weight) ? number_format((float) $shipment->weight, 2) . ' ' . ((float) $shipment->weight == 1.0 ? 'pound' : 'pounds') : 'N/A' }}</dd>
                        </div>
                        <div class="flex justify-between sm:block border-b border-line/70 pb-3">
                            <dt class="text-ink/50">Total Freight</dt>
                            <dd class="font-semibold text-ink mt-0.5">{{ !is_null($shipment->total_freight) ? $currencySymbol . number_format((float) $shipment->total_freight, 2) : 'N/A' }}</dd>
                        </div>
                        <div class="flex justify-between sm:block border-b border-line/70 pb-3">
                            <dt class="text-ink/50">Pick-up Date</dt>
                            <dd class="font-semibold text-ink mt-0.5">{{ $shipment->pickup_date ? \Carbon\Carbon::parse($shipment->pickup_date)->format('M d, Y') : 'N/A' }}</dd>
                        </div>
                        <div class="flex justify-between sm:block border-b border-line/70 pb-3">
                            <dt class="text-ink/50">Pick-up Time</dt>
                            <dd class="font-semibold text-ink mt-0.5">{{ $shipment->pickup_time ? \Carbon\Carbon::parse($shipment->pickup_time)->format('h:i a') : 'N/A' }}</dd>
                        </div>
                        <div class="flex justify-between sm:block border-b border-line/70 pb-3">
                            <dt class="text-ink/50">Departure</dt>
                            <dd class="font-semibold text-ink mt-0.5">{{ $shipment->departure_time ? \Carbon\Carbon::parse($shipment->departure_time)->format('M d, Y h:i a') : 'N/A' }}</dd>
                        </div>
                    </dl>
                    @if($shipment->comments)
                    <div class="mt-5 p-4 bg-mist rounded-lg">
                        <div class="text-ink/50 text-xs font-semibold uppercase tracking-wide mb-1">Comments</div>
                        <div class="text-ink/80 text-sm">{{ $shipment->comments }}</div>
                    </div>
                    @endif
                </div>

                <!-- Parties -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-2xl border border-line shadow-soft p-7 reveal">
                        <h3 class="font-display font-bold text-navy-900 mb-4 flex items-center gap-2"><i class="fas fa-user text-gold-600"></i> Sender</h3>
                        <dl class="space-y-2 text-sm">
                            <div class="flex justify-between gap-3"><dt class="text-ink/50">Name</dt><dd class="font-semibold text-ink text-right">{{ $shipment->sender_name }}</dd></div>
                            <div class="flex justify-between gap-3"><dt class="text-ink/50">Email</dt><dd class="font-semibold text-ink text-right break-all">{{ $shipment->sender_email }}</dd></div>
                            @if($shipment->sender_phone)<div class="flex justify-between gap-3"><dt class="text-ink/50">Phone</dt><dd class="font-semibold text-ink text-right">{{ $shipment->sender_phone }}</dd></div>@endif
                        </dl>
                        @if($shipment->sender_address)<p class="mt-3 text-xs text-ink/60 border-t border-line/70 pt-3">{{ $shipment->sender_address }}</p>@endif
                    </div>
                    <div class="bg-white rounded-2xl border border-line shadow-soft p-7 reveal" style="transition-delay:80ms">
                        <h3 class="font-display font-bold text-navy-900 mb-4 flex items-center gap-2"><i class="fas fa-user-check text-gold-600"></i> Receiver</h3>
                        <dl class="space-y-2 text-sm">
                            <div class="flex justify-between gap-3"><dt class="text-ink/50">Name</dt><dd class="font-semibold text-ink text-right">{{ $shipment->receiver_name }}</dd></div>
                            <div class="flex justify-between gap-3"><dt class="text-ink/50">Email</dt><dd class="font-semibold text-ink text-right break-all">{{ $shipment->receiver_email }}</dd></div>
                            @if($shipment->receiver_phone)<div class="flex justify-between gap-3"><dt class="text-ink/50">Phone</dt><dd class="font-semibold text-ink text-right">{{ $shipment->receiver_phone }}</dd></div>@endif
                        </dl>
                        @if($shipment->receiver_address)<p class="mt-3 text-xs text-ink/60 border-t border-line/70 pt-3">{{ $shipment->receiver_address }}</p>@endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <!-- Current status -->
                <div class="bg-white rounded-2xl border border-line shadow-soft p-7 reveal">
                    <h3 class="font-display font-bold text-navy-900 mb-5 flex items-center gap-2"><i class="fas fa-location-dot text-gold-600"></i> Current Status</h3>
                    @php $latestUpdate = $shipment->updates()->orderBy('created_at', 'desc')->first(); @endphp
                    <div class="bg-navy-900 rounded-xl p-6 text-center text-white">
                        <p class="font-display font-bold text-lg">{{ ucwords(str_replace('_', ' ', $shipment->status ?? 'N/A')) }}</p>
                        <p class="text-white/60 text-sm mt-1">{{ $latestUpdate?->location ?? ($shipment->origin ?? 'N/A') }}</p>
                        @if($latestUpdate)
                            <p class="text-white/40 text-xs mt-2">Updated {{ $latestUpdate->created_at->format('M d, Y H:i') }}</p>
                        @endif
                    </div>
                    @if(($shipment->status ?? '') !== 'Delivered')
                        <p class="mt-4 text-sm text-ink/60 flex items-center gap-2"><i class="fas fa-clock text-gold-600"></i> Est. delivery: <strong class="text-ink">{{ $shipment->estimated_delivery_date ? \Carbon\Carbon::parse($shipment->estimated_delivery_date)->format('M d, Y') : 'N/A' }}</strong></p>
                    @endif
                </div>

                <!-- Package -->
                <div class="bg-white rounded-2xl border border-line shadow-soft p-7 reveal" style="transition-delay:100ms">
                    <h3 class="font-display font-bold text-navy-900 mb-5 flex items-center gap-2"><i class="fas fa-box-open text-gold-600"></i> Package</h3>
                    <dl class="space-y-3 text-sm">
                        @if($shipment->package_name)<div class="flex justify-between gap-3"><dt class="text-ink/50">Name</dt><dd class="font-semibold text-ink text-right">{{ $shipment->package_name }}</dd></div>@endif
                        @if($shipment->package_type)<div class="flex justify-between gap-3"><dt class="text-ink/50">Type</dt><dd class="font-semibold text-ink text-right">{{ $shipment->package_type }}</dd></div>@endif
                        @if($shipment->qty)<div class="flex justify-between gap-3"><dt class="text-ink/50">Qty</dt><dd class="font-semibold text-ink text-right">{{ $shipment->qty }}</dd></div>@endif
                        @if($shipment->weight)<div class="flex justify-between gap-3"><dt class="text-ink/50">Weight</dt><dd class="font-semibold text-ink text-right">{{ number_format((float) $shipment->weight, 2) }} kg</dd></div>@endif
                        @if(!is_null($shipment->declared_value))<div class="flex justify-between gap-3"><dt class="text-ink/50">Declared Value</dt><dd class="font-semibold text-ink text-right">{{ $currencySymbol }}{{ number_format((float) $shipment->declared_value, 2) }}</dd></div>@endif
                        @if($shipment->product)<div class="flex justify-between gap-3"><dt class="text-ink/50">Product</dt><dd class="font-semibold text-ink text-right">{{ $shipment->product }}</dd></div>@endif
                    </dl>
                    @if($shipment->length || $shipment->width || $shipment->height)
                        <div class="mt-4 p-3 bg-mist rounded-lg text-xs text-ink/60">
                            Dimensions:
                            @if($shipment->length){{ $shipment->length }}cm @endif
                            @if($shipment->width)× {{ $shipment->width }}cm @endif
                            @if($shipment->height)× {{ $shipment->height }}cm @endif
                        </div>
                    @endif
                    @if($shipment->package_description)<p class="mt-3 text-xs text-ink/60">{{ $shipment->package_description }}</p>@endif
                    @if($shipment->special_instructions)
                        <div class="mt-3 p-3 bg-gold-300/20 border border-gold-500/30 rounded-lg text-xs text-ink/70"><strong>Special instructions:</strong> {{ $shipment->special_instructions }}</div>
                    @endif
                </div>

                <!-- Timeline -->
                <div class="bg-white rounded-2xl border border-line shadow-soft p-7 reveal" style="transition-delay:160ms">
                    <h3 class="font-display font-bold text-navy-900 mb-6 flex items-center gap-2"><i class="fas fa-timeline text-gold-600"></i> Tracking History</h3>
                    <div class="relative pl-6">
                        <div class="absolute left-[9px] top-2 bottom-2 w-px bg-line"></div>
                        @forelse($shipment->updates()->orderBy('created_at', 'desc')->get() as $update)
                        <div class="relative pb-6 last:pb-0">
                            <span class="absolute -left-6 top-1 w-[19px] h-[19px] rounded-full border-[3px] border-white bg-navy-900 ring-1 ring-line flex items-center justify-center"><i class="fas fa-check text-gold-400" style="font-size:8px"></i></span>
                            <p class="font-semibold text-ink text-sm">{{ ucfirst($update->description) }}</p>
                            <p class="text-ink/60 text-xs mt-0.5">{{ $update->location }}</p>
                            <div class="flex items-center gap-3 mt-1">
                                <span class="text-[11px] text-ink/40">{{ $update->created_at->format('M d, Y H:i') }}</span>
                                @if($update->description !== $update->status)
                                <span class="text-[11px] font-semibold text-gold-700 bg-gold-300/25 px-2 py-0.5 rounded-full">{{ ucwords(str_replace('_', ' ', $update->status)) }}</span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <i class="fas fa-clock text-ink/30 text-3xl mb-3 block"></i>
                            <p class="text-ink/60 text-sm">No tracking updates yet — they will appear as your shipment progresses.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('track') }}" class="avenro-btn avenro-btn-outline">Track Another Shipment</a>
        </div>
    </div>
</section>

@if($shipment->show_map)
<!-- Live Tracking Map -->
<section class="pb-20 bg-mist">
    <div class="max-w-7xl mx-auto px-4">
        <div class="bg-white rounded-2xl border border-line shadow-soft p-8 reveal">
            <h3 class="font-display text-xl font-bold text-navy-900 mb-1 flex items-center gap-2"><i class="fas fa-map-location-dot text-gold-600"></i> Live Tracking Map</h3>
            <p class="text-ink/60 text-sm mb-6">Real-time location updates based on tracking history.</p>
            <div id="shipment-map" class="w-full h-96 rounded-xl overflow-hidden border border-line" style="min-height: 480px;"></div>
            <div class="mt-4 flex items-center justify-between text-sm text-ink/60">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Live tracking active</span>
                </div>
                <span id="last-update-time">Updating...</span>
            </div>
        </div>
    </div>
</section>
@endif
@else
<!-- Help -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-navy-900">How to track your shipment</h2>
        <p class="mt-3 text-ink/60">Three simple steps to live shipment updates</p>
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['fa-envelope', 'Find your number', 'Your tracking number is in the shipping confirmation email or receipt.'],
                ['fa-magnifying-glass', 'Enter it above', 'Type the tracking number into the search field and submit.'],
                ['fa-location-dot', 'Watch it move', 'View real-time status, location history and ETA.'],
            ] as $i => $s)
            <div class="reveal" style="transition-delay:{{ $i * 80 }}ms">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-navy-900 text-gold-400 flex items-center justify-center text-xl mb-4"><i class="fas {{ $s[0] }}"></i></div>
                <h3 class="font-display font-bold text-navy-900 mb-2">{{ $s[1] }}</h3>
                <p class="text-ink/60 text-sm">{{ $s[2] }}</p>
            </div>
            @endforeach
        </div>
        <a href="{{ route('contact.index') }}" class="avenro-btn avenro-btn-navy mt-12"><i class="fas fa-headset"></i> Contact Support</a>
    </div>
</section>
@endif

@if(isset($shipment) && $success && $shipment->show_map)
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
<style>
    .custom-marker {
        background-color: #C6A15B;
        border: 3px solid #fff;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        transition: all 0.3s ease;
    }
    .custom-marker:hover { transform: scale(1.2); }
    .current-marker {
        background-color: #10B981;
        animation: pulse-marker 2s infinite;
    }
    @keyframes pulse-marker {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.3); opacity: 0.8; }
    }
    .leaflet-popup-content-wrapper { border-radius: 12px; }
    .route-line { stroke-dasharray: 10, 5; animation: dash 20s linear infinite; }
    @keyframes dash { to { stroke-dashoffset: -1000; } }
</style>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
<script src="https://unpkg.com/leaflet-polylinedecorator@1.6.0/dist/leaflet.polylineDecorator.js"></script>
<script>
    let map, markers = [], routeLine, currentMarker, markerCluster;

    function formatStatus(status) {
        return status.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
    }

    async function geocodeLocation(locationName) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(locationName)}&limit=1`);
            const data = await response.json();
            if (data && data.length > 0) {
                return { lat: parseFloat(data[0].lat), lng: parseFloat(data[0].lon) };
            }
        } catch (error) {
            console.error('Geocoding error:', error);
        }
        return null;
    }

    async function initMap() {
        const updates = {!! json_encode($shipment->updates()->orderBy('created_at', 'asc')->get()) !!};
        const originName = @json($shipment->origin);
        const destinationName = @json($shipment->destination);
        const mapElement = document.getElementById('shipment-map');
        if (!mapElement) return;

        mapElement.innerHTML = '<div class="flex items-center justify-center h-full bg-mist rounded-xl"><div class="text-center"><i class="fas fa-spinner fa-spin text-4xl text-gold-600 mb-3"></i><p class="text-ink/60">Loading map...</p><p class="text-xs text-ink/40 mt-2">Converting locations to coordinates</p></div></div>';

        const locations = [];
        for (const update of updates) {
            let lat = parseFloat(update.latitude);
            let lng = parseFloat(update.longitude);
            if (!lat || !lng || isNaN(lat) || isNaN(lng)) {
                const coords = await geocodeLocation(update.location);
                if (coords) { lat = coords.lat; lng = coords.lng; }
            }
            if (lat && lng && !isNaN(lat) && !isNaN(lng)) {
                locations.push({ lat, lng, description: update.description, location: update.location, status: update.status, timestamp: update.created_at });
            }
        }

        const originCoords = originName ? await geocodeLocation(originName) : null;
        const destinationCoords = destinationName ? await geocodeLocation(destinationName) : null;

        if (locations.length === 0 && !originCoords && !destinationCoords) {
            mapElement.innerHTML = '<div class="flex items-center justify-center h-full bg-mist rounded-xl"><div class="text-center"><i class="fas fa-map-marked-alt text-4xl text-ink/30 mb-3"></i><p class="text-ink/60">No tracking locations available</p></div></div>';
            return;
        }

        mapElement.innerHTML = '';

        map = L.map('shipment-map', {
            zoomControl: true, scrollWheelZoom: true, dragging: true, touchZoom: true,
            doubleClickZoom: true, boxZoom: true, keyboard: true, tap: true
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19, minZoom: 2
        }).addTo(map);

        markerCluster = L.markerClusterGroup({
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            maxClusterRadius: 50
        });

        const routeCoordinates = locations.map(loc => [loc.lat, loc.lng]);
        if (routeCoordinates.length > 1) {
            routeLine = L.polyline(routeCoordinates, {
                color: '#0F2B4D', weight: 4, opacity: 0.8, smoothFactor: 1, className: 'route-line'
            }).addTo(map);

            L.polylineDecorator(routeLine, {
                patterns: [{
                    offset: 0, repeat: 100,
                    symbol: L.Symbol.arrowHead({
                        pixelSize: 12, polygon: false,
                        pathOptions: { stroke: true, weight: 2, color: '#C6A15B' }
                    })
                }]
            }).addTo(map);
        }

        const addEndpointMarker = (coords, name, label, iconHtml) => {
            const icon = L.divIcon({
                className: 'custom-div-icon',
                html: `<div style="background-color: ${iconHtml}; width: 26px; height: 26px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;"><i class="fas ${label === 'Origin' ? 'fa-play' : 'fa-flag-checkered'}" style="color: white; font-size: 10px;"></i></div>`,
                iconSize: [26, 26], iconAnchor: [13, 13]
            });
            const m = L.marker([coords.lat, coords.lng], { icon, title: label })
                .bindPopup(`<div style="min-width:180px;"><strong style="color:#0B1F3D;">${label}</strong><br><span style="color:#475467;">${name}</span></div>`);
            markerCluster.addLayer(m);
            markers.push(m);
        };

        if (originCoords) addEndpointMarker(originCoords, originName, 'Origin', '#22c55e');
        if (destinationCoords) addEndpointMarker(destinationCoords, destinationName, 'Destination', '#ef4444');

        locations.forEach((location, index) => {
            const isCurrentLocation = index === locations.length - 1;
            const customIcon = L.divIcon({
                className: 'custom-div-icon',
                html: `<div class="custom-marker ${isCurrentLocation ? 'current-marker' : ''}" style="${isCurrentLocation ? 'width: 24px; height: 24px;' : ''}"></div>`,
                iconSize: [20, 20], iconAnchor: [10, 10]
            });
            const marker = L.marker([location.lat, location.lng], { icon: customIcon, title: location.description });

            const popupContent = `
                <div style="min-width: 200px;">
                    <div style="display: flex; align-items: center; margin-bottom: 8px;">
                        <i class="fas fa-map-marker-alt" style="color: #0F2B4D; margin-right: 8px;"></i>
                        <strong style="color: #0B1F3D; font-size: 15px;">${location.location}</strong>
                    </div>
                    <div style="margin-bottom: 6px;">
                        <span style="display: inline-block; padding: 3px 8px; background: #F4ECDC; color: #8A6A24; border-radius: 4px; font-size: 12px; font-weight: 600;">
                            ${formatStatus(location.status)}
                        </span>
                    </div>
                    <p style="color: #475467; margin: 6px 0; font-size: 13px;">${location.description}</p>
                    <p style="color: #98A2B3; font-size: 12px; margin-top: 6px;">
                        <i class="fas fa-clock" style="margin-right: 4px;"></i>
                        ${new Date(location.timestamp).toLocaleString('en-US', { month: 'short', day: 'numeric', year: 'numeric', hour: '2-digit', minute: '2-digit' })}
                    </p>
                    ${isCurrentLocation ? '<p style="color: #10B981; font-weight: 600; margin-top: 6px; font-size: 12px;"><i class="fas fa-circle" style="font-size: 8px; margin-right: 4px;"></i>Current Location</p>' : ''}
                </div>`;

            marker.bindPopup(popupContent, { maxWidth: 300 });
            if (isCurrentLocation) {
                currentMarker = marker;
                setTimeout(() => marker.openPopup(), 1000);
            }
            markerCluster.addLayer(marker);
            markers.push(marker);
        });

        map.addLayer(markerCluster);

        const allBoundsCoords = [];
        if (originCoords) allBoundsCoords.push([originCoords.lat, originCoords.lng]);
        if (destinationCoords) allBoundsCoords.push([destinationCoords.lat, destinationCoords.lng]);
        routeCoordinates.forEach(c => allBoundsCoords.push(c));
        if (allBoundsCoords.length > 0) {
            map.fitBounds(L.latLngBounds(allBoundsCoords), { padding: [50, 50] });
        }

        updateLastUpdateTime();
    }

    async function updateMapLocation(newLocation) {
        if (!map) return;
        if (!newLocation.lat || !newLocation.lng) {
            const coords = await geocodeLocation(newLocation.location);
            if (coords) { newLocation.lat = coords.lat; newLocation.lng = coords.lng; }
            else { console.error('Could not geocode location:', newLocation.location); return; }
        }

        if (currentMarker) {
            currentMarker.setIcon(L.divIcon({
                className: 'custom-div-icon',
                html: '<div class="custom-marker"></div>',
                iconSize: [20, 20], iconAnchor: [10, 10]
            }));
        }

        const newIcon = L.divIcon({
            className: 'custom-div-icon',
            html: '<div class="custom-marker current-marker" style="width: 24px; height: 24px;"></div>',
            iconSize: [24, 24], iconAnchor: [12, 12]
        });

        const marker = L.marker([newLocation.lat, newLocation.lng], { icon: newIcon });
        const popupContent = `
            <div style="min-width: 200px;">
                <div style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-map-marker-alt" style="color: #0F2B4D; margin-right: 8px;"></i>
                    <strong style="color: #0B1F3D; font-size: 15px;">${newLocation.location}</strong>
                </div>
                <div style="margin-bottom: 6px;">
                    <span style="display: inline-block; padding: 3px 8px; background: #F4ECDC; color: #8A6A24; border-radius: 4px; font-size: 12px; font-weight: 600;">
                        ${formatStatus(newLocation.status)}
                    </span>
                </div>
                <p style="color: #475467; margin: 6px 0; font-size: 13px;">${newLocation.description}</p>
                <p style="color: #10B981; font-weight: 600; margin-top: 6px; font-size: 12px;">
                    <i class="fas fa-circle" style="font-size: 8px; margin-right: 4px;"></i>Current Location
                </p>
            </div>`;

        marker.bindPopup(popupContent).openPopup();
        markerCluster.addLayer(marker);
        markers.push(marker);
        currentMarker = marker;

        if (!routeLine) {
            routeLine = L.polyline([[newLocation.lat, newLocation.lng]], {
                color: '#0F2B4D', weight: 4, opacity: 0.8, smoothFactor: 1, className: 'route-line'
            }).addTo(map);
        } else {
            const currentPath = routeLine.getLatLngs();
            currentPath.push([newLocation.lat, newLocation.lng]);
            routeLine.setLatLngs(currentPath);
        }

        map.flyTo([newLocation.lat, newLocation.lng], map.getZoom(), { duration: 1.5 });
        updateLastUpdateTime();
    }

    function updateLastUpdateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        const element = document.getElementById('last-update-time');
        if (element) element.textContent = `Last updated: ${timeString}`;
    }

    function listenForUpdates() {
        const trackingNumber = '{{ $shipment->tracking_number }}';
        const eventSource = new EventSource(`/tracking-updates/${trackingNumber}`);
        eventSource.onmessage = function(event) {
            const update = JSON.parse(event.data);
            updateMapLocation({
                lat: update.latitude ? parseFloat(update.latitude) : null,
                lng: update.longitude ? parseFloat(update.longitude) : null,
                location: update.location || 'Unknown',
                status: update.status || 'in_transit',
                description: update.description || 'Location update'
            });
        };
        eventSource.onerror = function() { eventSource.close(); };
    }

    document.addEventListener('DOMContentLoaded', function() {
        initMap();
        setTimeout(() => { if (map) listenForUpdates(); }, 1000);
    });
</script>
@endif
@endsection
