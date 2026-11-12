@extends('layouts.app')

@section('title', 'Contact Us — Avenro Logistics')
@section('meta_description', 'Contact Avenro Logistics for quotes, shipment support and logistics inquiries.')

@section('content')
<!-- Hero -->
<section class="relative bg-navy-950 overflow-hidden">
    <img src="{{ asset('images/logistics-hero1.jpeg') }}" alt="Avenro Logistics" class="absolute inset-0 w-full h-full object-cover opacity-30">
    <div class="absolute inset-0 bg-gradient-to-b from-navy-950/70 to-navy-950"></div>
    <div class="relative max-w-7xl mx-auto px-4 py-24 md:py-28 text-center">
        <p class="text-gold-400 font-semibold text-sm tracking-[0.25em] uppercase mb-4">Contact</p>
        <h1 class="font-display text-4xl md:text-6xl font-extrabold text-white">Let’s move your cargo.</h1>
        <p class="mt-6 text-white/70 text-lg max-w-2xl mx-auto">Questions about a shipment, a quote or our services — our team is ready to help.</p>
    </div>
</section>

<!-- Contact -->
<section class="py-20 md:py-24 bg-mist">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-5 gap-10">

        <!-- Info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl p-8 border border-line shadow-soft reveal">
                <h2 class="font-display text-xl font-bold text-navy-900 mb-6">Get in Touch</h2>
                <div class="space-y-5">
                    @if($settings && $settings->contact_email)
                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center shrink-0"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h3 class="font-semibold text-ink text-sm">Email</h3>
                            <a href="mailto:{{ $settings->contact_email }}" class="text-ink/70 text-sm hover:text-gold-600 transition-colors">{{ $settings->contact_email }}</a>
                        </div>
                    </div>
                    @endif
                    @if($settings && $settings->contact_phone)
                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center shrink-0"><i class="fas fa-phone"></i></div>
                        <div>
                            <h3 class="font-semibold text-ink text-sm">Phone</h3>
                            <a href="tel:{{ $settings->contact_phone }}" class="text-ink/70 text-sm hover:text-gold-600 transition-colors">{{ $settings->contact_phone }}</a>
                        </div>
                    </div>
                    @endif
                    @if($settings && $settings->address)
                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center shrink-0"><i class="fas fa-location-dot"></i></div>
                        <div>
                            <h3 class="font-semibold text-ink text-sm">Address</h3>
                            <p class="text-ink/70 text-sm">{{ $settings->address }}</p>
                        </div>
                    </div>
                    @endif
                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center shrink-0"><i class="fas fa-headset"></i></div>
                        <div>
                            <h3 class="font-semibold text-ink text-sm">Support</h3>
                            <p class="text-ink/70 text-sm">Our team responds to all inquiries promptly during business hours.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-navy-900 rounded-2xl p-8 reveal" style="transition-delay:100ms">
                <h3 class="font-display font-bold text-white mb-2">Need to track a shipment?</h3>
                <p class="text-white/60 text-sm mb-5">Enter your tracking number for live status and location updates.</p>
                <a href="/track" class="avenro-btn justify-center w-full">Track Shipment <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- Form -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-2xl p-8 md:p-10 border border-line shadow-soft reveal">
                <h2 class="font-display text-2xl font-bold text-navy-900 mb-2">Send Us a Message</h2>
                <p class="text-ink/60 text-sm mb-8">Fill in the form and we will get back to you as soon as possible.</p>

                @if(session('success'))
                    <div class="mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center gap-2">
                        <i class="fas fa-circle-check"></i> {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-2" for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-line focus:border-gold-500 focus:ring-2 focus:ring-gold-500/20 outline-none transition text-sm"
                                   placeholder="Your full name">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-2" for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-line focus:border-gold-500 focus:ring-2 focus:ring-gold-500/20 outline-none transition text-sm"
                                   placeholder="you@example.com">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-2" for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-line focus:border-gold-500 focus:ring-2 focus:ring-gold-500/20 outline-none transition text-sm"
                                   placeholder="+1 000 000 0000">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-ink/80 mb-2" for="service_type">Service Interested In</label>
                            <select id="service_type" name="service_type"
                                    class="w-full px-4 py-3 rounded-lg border border-line focus:border-gold-500 focus:ring-2 focus:ring-gold-500/20 outline-none transition text-sm bg-white">
                                <option value="">Select a service</option>
                                <option value="air-freight" @selected(old('service_type')==='air-freight')>Air Freight</option>
                                <option value="sea-freight" @selected(old('service_type')==='sea-freight')>Sea Freight</option>
                                <option value="ground-freight" @selected(old('service_type')==='ground-freight')>Ground Freight</option>
                                <option value="warehousing" @selected(old('service_type')==='warehousing')>Warehousing</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-ink/80 mb-2" for="subject">Subject *</label>
                        <input type="text" id="subject" name="subject" required value="{{ old('subject') }}"
                               class="w-full px-4 py-3 rounded-lg border border-line focus:border-gold-500 focus:ring-2 focus:ring-gold-500/20 outline-none transition text-sm"
                               placeholder="What is this regarding?">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-ink/80 mb-2" for="message">Message *</label>
                        <textarea id="message" name="message" rows="6" required
                                  class="w-full px-4 py-3 rounded-lg border border-line focus:border-gold-500 focus:ring-2 focus:ring-gold-500/20 outline-none transition text-sm resize-y"
                                  placeholder="Tell us more about your inquiry...">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="avenro-btn avenro-btn-navy w-full md:w-auto justify-center">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
