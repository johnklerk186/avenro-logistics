@extends('layouts.app')

@section('title', 'Tracking Results — Avenro Logistics')

@section('content')
<section class="py-16 bg-mist min-h-[50vh]">
    <div class="max-w-4xl mx-auto px-4">
        @if(isset($error))
            <div class="p-4 rounded-lg mb-8 bg-red-50 border border-red-200 text-red-700 text-sm flex items-center gap-2">
                <i class="fas fa-triangle-exclamation"></i> {{ $error }}
            </div>
        @endif

        @if(isset($shipment) && $success)
            <div class="bg-white rounded-2xl border border-line shadow-soft overflow-hidden">
                <div class="bg-navy-900 p-8 text-white">
                    <p class="text-gold-400 text-xs font-semibold tracking-[0.2em] uppercase mb-2">Tracking Number</p>
                    <h3 class="font-display text-2xl md:text-3xl font-bold">{{ $shipment->tracking_number }}</h3>
                    <div class="mt-4 flex flex-wrap items-center gap-4">
                        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold bg-gold-500/15 text-gold-300 border border-gold-500/40">
                            {{ ucfirst($shipment->status) }}
                        </span>
                        <span class="text-white/60 text-sm">Est. delivery: <strong class="text-gold-300">{{ $shipment->estimated_delivery_date->format('M d, Y') }}</strong></span>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <h4 class="font-display font-bold text-navy-900 mb-2">Origin</h4>
                            <p class="text-ink/70">{{ $shipment->origin }}</p>
                        </div>
                        <div>
                            <h4 class="font-display font-bold text-navy-900 mb-2">Destination</h4>
                            <p class="text-ink/70">{{ $shipment->destination }}</p>
                        </div>
                    </div>

                    <h3 class="font-display font-bold text-navy-900 mb-6">Tracking Timeline</h3>
                    <div class="relative pl-6">
                        <div class="absolute left-[9px] top-2 bottom-2 w-px bg-line"></div>
                        @forelse($shipment->updates()->orderBy('created_at', 'desc')->get() as $update)
                            <div class="relative pb-6 last:pb-0">
                                <span class="absolute -left-6 top-1 w-[19px] h-[19px] rounded-full border-[3px] border-white bg-navy-900 ring-1 ring-line"></span>
                                <p class="font-semibold text-ink text-sm">{{ ucfirst($update->status) }}</p>
                                <p class="text-ink/70 text-sm">{{ $update->location }}</p>
                                <p class="text-ink/60 text-sm">{{ $update->description }}</p>
                                <p class="text-ink/40 text-xs mt-1">{{ $update->created_at->format('M d, Y H:i') }}</p>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-ink/60">No tracking updates available yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('track') }}" class="avenro-btn avenro-btn-navy justify-center">
                    <i class="fas fa-magnifying-glass"></i> Track Another Shipment
                </a>
                <a href="#" onclick="window.print()" class="avenro-btn avenro-btn-outline justify-center">
                    <i class="fas fa-print"></i> Print Details
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
