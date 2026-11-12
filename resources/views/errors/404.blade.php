@extends('layouts.app')

@section('title', '404 — Page Not Found | Avenro Logistics')

@section('content')
<section class="min-h-[70vh] flex items-center bg-mist">
    <div class="max-w-4xl mx-auto px-4 py-16 text-center">
        <p class="font-display font-extrabold text-[7rem] md:text-[10rem] leading-none text-navy-900/10 select-none">404</p>
        <div class="-mt-10 md:-mt-16 mb-6 flex justify-center items-center gap-5">
            <i class="fas fa-truck-fast text-5xl md:text-6xl text-navy-900"></i>
            <i class="fas fa-box-open text-4xl md:text-5xl text-gold-500"></i>
        </div>

        <h1 class="font-display text-3xl md:text-4xl font-bold text-navy-900">Page not found</h1>
        <p class="mt-3 text-ink/60 max-w-md mx-auto">The page you are looking for may have been moved or no longer exists.</p>

        <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/" class="avenro-btn avenro-btn-navy"><i class="fas fa-house"></i> Back to Home</a>
            <a href="/track" class="avenro-btn"><i class="fas fa-location-dot"></i> Track Shipment</a>
            <button onclick="history.back()" class="avenro-btn avenro-btn-outline"><i class="fas fa-arrow-left"></i> Go Back</button>
        </div>
    </div>
</section>
@endsection
