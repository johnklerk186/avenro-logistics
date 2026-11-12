@php
    $siteName = $siteSettings->site_name ?? 'Avenro Logistics';
    $logoPath = $siteSettings && $siteSettings->site_logo ? '/' . ltrim($siteSettings->site_logo, '/') : 'images/logo.svg';
    $logoUrl = \App\Models\SiteSetting::getLogoUrl() ?? asset($logoPath);
@endphp
<!-- Header -->
<header class="bg-white/95 backdrop-blur border-b border-line sticky top-0 z-50">
    <!-- Top utility bar -->
    <div class="hidden lg:block bg-navy-900 text-white/80 text-xs">
        <div class="max-w-7xl mx-auto px-4 py-2 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <span><i class="fas fa-envelope mr-2 text-gold-400"></i>{{ $siteSettings->contact_email ?? 'info@avenrologistics.com' }}</span>
                <span><i class="fas fa-phone mr-2 text-gold-400"></i>{{ $siteSettings->contact_phone ?? '' }}</span>
            </div>
            <div class="flex items-center gap-5">
                <a href="{{ route('track') }}" class="hover:text-gold-300 transition-colors">Track Shipment</a>
                <a href="{{ route('contact.index') }}" class="hover:text-gold-300 transition-colors">Get a Quote</a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="/" class="flex items-center">
                <img src="{{ $logoUrl }}" alt="{{ $siteName }} Logo" class="h-14 md:h-16 w-auto">
            </a>

            <!-- Mobile menu button -->
            <button id="mobile-menu-button" class="md:hidden text-navy-900 hover:text-gold-600 focus:outline-none p-2" aria-label="Toggle navigation">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex md:items-center">
                <div class="flex items-center gap-8">
                    <a href="/" class="text-ink/80 hover:text-navy-900 font-semibold text-sm tracking-wide transition-colors {{ request()->is('/') ? 'text-navy-900' : '' }}">Home</a>
                    <a href="/services" class="text-ink/80 hover:text-navy-900 font-semibold text-sm tracking-wide transition-colors {{ request()->is('services') ? 'text-navy-900' : '' }}">Services</a>
                    <a href="/about" class="text-ink/80 hover:text-navy-900 font-semibold text-sm tracking-wide transition-colors {{ request()->is('about') ? 'text-navy-900' : '' }}">About</a>
                    <a href="/contact" class="text-ink/80 hover:text-navy-900 font-semibold text-sm tracking-wide transition-colors {{ request()->is('contact') ? 'text-navy-900' : '' }}">Contact</a>
                    <a href="/track" class="avenro-btn avenro-btn-navy !py-2.5 !px-6 text-sm">
                        <i class="fas fa-location-dot"></i> Track Shipment
                    </a>
                </div>
            </nav>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="hidden md:hidden pb-5 border-t border-line">
            <nav class="flex flex-col pt-2">
                <a href="/" class="py-3 text-ink/80 hover:text-navy-900 font-semibold border-b border-line/60">Home</a>
                <a href="/services" class="py-3 text-ink/80 hover:text-navy-900 font-semibold border-b border-line/60">Services</a>
                <a href="/about" class="py-3 text-ink/80 hover:text-navy-900 font-semibold border-b border-line/60">About</a>
                <a href="/contact" class="py-3 text-ink/80 hover:text-navy-900 font-semibold border-b border-line/60">Contact</a>
                <a href="/track" class="avenro-btn avenro-btn-navy mt-4 justify-center"><i class="fas fa-location-dot"></i> Track Shipment</a>
            </nav>
        </div>
    </div>
</header>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
