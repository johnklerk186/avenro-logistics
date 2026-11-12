@extends('layouts.app')

@section('title', 'Our Services — Avenro Logistics')
@section('meta_description', 'Explore Avenro Logistics services: air freight, sea freight, ground freight, warehousing and pet relocation with real-time tracking.')

@section('content')
<!-- Hero -->
<section class="relative bg-navy-950 overflow-hidden">
    <img src="{{ asset('images/logistics-hero3.jpg') }}" alt="Avenro Logistics warehouse" class="absolute inset-0 w-full h-full object-cover opacity-30">
    <div class="absolute inset-0 bg-gradient-to-b from-navy-950/70 to-navy-950"></div>
    <div class="relative max-w-7xl mx-auto px-4 py-24 md:py-28 text-center">
        <p class="text-gold-400 font-semibold text-sm tracking-[0.25em] uppercase mb-4">Services</p>
        <h1 class="font-display text-4xl md:text-6xl font-extrabold text-white">Logistics solutions, end to end.</h1>
        <p class="mt-6 text-white/70 text-lg max-w-2xl mx-auto">Comprehensive freight, warehousing and relocation services tailored to your cargo and your timeline.</p>
    </div>
</section>

<!-- Services -->
<section class="py-20 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 space-y-16">
        @foreach($services as $i => $service)
        @php
            $imageUrls = [
                'air-freight' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1200&q=80',
                'sea-freight' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?w=1200&q=80',
                'ground-freight' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=1200&q=80',
                'warehousing' => 'https://images.unsplash.com/photo-1553413077-190dd305871c?w=1200&q=80',
                'pet-relocation' => 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=1200&q=80'
            ];
            $icons = [
                'air-freight' => 'fa-plane',
                'sea-freight' => 'fa-ship',
                'ground-freight' => 'fa-truck-fast',
                'warehousing' => 'fa-warehouse',
                'pet-relocation' => 'fa-paw',
            ];
        @endphp
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center reveal {{ $loop->even ? 'lg:flex-row-reverse' : '' }}">
            <div class="{{ $loop->even ? 'lg:order-2' : '' }}">
                <div class="rounded-2xl overflow-hidden shadow-soft">
                    <img src="{{ $imageUrls[$service['id']] ?? '' }}" alt="{{ $service['title'] }} services" class="w-full h-64 md:h-80 object-cover hover:scale-105 transition-transform duration-700">
                </div>
            </div>
            <div class="{{ $loop->even ? 'lg:order-1' : '' }}">
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-14 h-14 rounded-xl bg-navy-900 text-gold-400 flex items-center justify-center text-xl shrink-0"><i class="fas {{ $icons[$service['id']] ?? 'fa-box' }}"></i></div>
                    <h2 class="font-display text-2xl md:text-3xl font-bold text-navy-900">{{ $service['title'] }}</h2>
                </div>
                <p class="text-ink/70 leading-relaxed mb-6">{{ $service['description'] }}</p>
                @if(!empty($service['details']))
                <p class="text-ink/60 text-sm leading-relaxed mb-6">{{ $service['details'] }}</p>
                @endif
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-8">
                    @foreach($service['features'] as $feature)
                    <li class="flex items-start gap-3 text-ink/70 text-sm">
                        <i class="fas fa-check text-gold-600 mt-0.5"></i>
                        <span>{{ $feature }}</span>
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('contact.index') }}" class="avenro-btn avenro-btn-navy">Get a Quote <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-navy-950">
    <div class="max-w-4xl mx-auto px-4 text-center reveal">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-white">Not sure which service fits?</h2>
        <p class="mt-4 text-white/70">Tell us about your shipment and our team will recommend the most efficient solution.</p>
        <a href="{{ route('contact.index') }}" class="avenro-btn mt-8">Request a Quote <i class="fas fa-arrow-right"></i></a>
    </div>
</section>
@endsection
