@extends('layouts.app')

@section('title', 'About Us — Avenro Logistics')
@section('meta_description', 'Learn about Avenro Logistics — our mission, values and commitment to dependable international freight and logistics services.')

@section('content')
<!-- Hero -->
<section class="relative bg-navy-950 overflow-hidden">
    <img src="{{ asset('images/logistics-hero2.jpeg') }}" alt="Avenro Logistics operations" class="absolute inset-0 w-full h-full object-cover opacity-30">
    <div class="absolute inset-0 bg-gradient-to-b from-navy-950/70 to-navy-950"></div>
    <div class="relative max-w-7xl mx-auto px-4 py-24 md:py-32 text-center">
        <p class="text-gold-400 font-semibold text-sm tracking-[0.25em] uppercase mb-4">About Avenro</p>
        <h1 class="font-display text-4xl md:text-6xl font-extrabold text-white">Precision in every shipment.</h1>
        <p class="mt-6 text-white/70 text-lg max-w-2xl mx-auto">Avenro Logistics is built on operational discipline, transparent tracking and a relentless focus on on-time delivery.</p>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-20 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-mist border border-line rounded-2xl p-10 reveal">
            <div class="w-14 h-14 rounded-xl bg-navy-900 text-gold-400 flex items-center justify-center text-xl mb-6"><i class="fas fa-bullseye"></i></div>
            <h2 class="font-display text-2xl font-bold text-navy-900 mb-4">Our Mission</h2>
            <p class="text-ink/70 leading-relaxed">To provide innovative and dependable logistics solutions that connect businesses globally — ensuring reliability, efficiency and excellence in every shipment we handle.</p>
        </div>
        <div class="bg-navy-900 rounded-2xl p-10 reveal" style="transition-delay:100ms">
            <div class="w-14 h-14 rounded-xl bg-gold-500 text-navy-950 flex items-center justify-center text-xl mb-6"><i class="fas fa-eye"></i></div>
            <h2 class="font-display text-2xl font-bold text-white mb-4">Our Vision</h2>
            <p class="text-white/70 leading-relaxed">To be a trusted international logistics partner, setting standards for service quality, transparency and customer satisfaction across every lane we serve.</p>
        </div>
    </div>
</section>

<!-- Core Values -->
<section class="py-20 md:py-24 bg-mist">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto reveal">
            <p class="text-gold-600 font-semibold text-sm tracking-[0.2em] uppercase mb-3">What We Stand For</p>
            <h2 class="font-display text-3xl md:text-5xl font-bold text-navy-900">Our Core Values</h2>
        </div>
        <div class="mt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['fa-handshake', 'Integrity', 'We conduct business with the highest ethical standards and complete transparency.'],
                ['fa-users', 'Customer Focus', 'Your success is our success — we go beyond expectations on every shipment.'],
                ['fa-leaf', 'Sustainability', 'We are committed to environmentally responsible logistics practices.'],
                ['fa-lightbulb', 'Innovation', 'We continuously adopt better systems to serve your supply chain.'],
            ] as $i => $v)
            <div class="bg-white rounded-2xl p-8 border border-line hover:shadow-soft hover:-translate-y-1 transition-all duration-300 text-center reveal" style="transition-delay: {{ $i * 80 }}ms">
                <div class="w-14 h-14 rounded-full bg-navy-900 text-gold-400 flex items-center justify-center text-xl mx-auto mb-5"><i class="fas {{ $v[0] }}"></i></div>
                <h3 class="font-display font-bold text-navy-900 mb-2">{{ $v[1] }}</h3>
                <p class="text-ink/60 text-sm leading-relaxed">{{ $v[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 text-center reveal">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-navy-900">Ready to work with Avenro?</h2>
        <p class="mt-4 text-ink/65 text-lg">Tell us about your shipping requirements and our team will respond with a tailored solution.</p>
        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact.index') }}" class="avenro-btn justify-center">Contact Us <i class="fas fa-arrow-right"></i></a>
            <a href="/services" class="avenro-btn avenro-btn-outline justify-center">View Services</a>
        </div>
    </div>
</section>
@endsection
