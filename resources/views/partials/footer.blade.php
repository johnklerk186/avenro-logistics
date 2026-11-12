@php
    $siteName = $siteSettings->site_name ?? 'Avenro Logistics';
    $logoPath = $siteSettings && $siteSettings->site_logo ? '/' . ltrim($siteSettings->site_logo, '/') : 'images/logo.svg';
    $logoUrl = \App\Models\SiteSetting::getLogoUrl() ?? asset($logoPath);
    $contactEmail = $siteSettings->contact_email ?? 'info@avenrologistics.com';
    $contactPhone = $siteSettings->contact_phone ?? '';
    $footerText = $siteSettings->footer_text ?? null;
@endphp
<!-- Footer -->
<footer class="bg-navy-950 text-white/70">
    <div class="max-w-7xl mx-auto px-4 py-14">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- Brand -->
            <div>
                <div class="bg-white/95 rounded-lg inline-block px-4 py-2.5 mb-5">
                    <img src="{{ $logoUrl }}" alt="{{ $siteName }} Logo" class="h-11 w-auto">
                </div>
                <p class="text-sm leading-relaxed mb-5">
                    {{ $footerText ?: 'Avenro Logistics delivers dependable air, sea and ground freight, warehousing and tracked door-to-door shipping for businesses that demand precision.' }}
                </p>
                <div class="flex space-x-3">
                    <a href="#" aria-label="Facebook" class="w-9 h-9 rounded-full bg-white/10 hover:bg-gold-500 hover:text-navy-950 flex items-center justify-center transition-colors"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="X" class="w-9 h-9 rounded-full bg-white/10 hover:bg-gold-500 hover:text-navy-950 flex items-center justify-center transition-colors"><i class="fab fa-x-twitter"></i></a>
                    <a href="#" aria-label="Instagram" class="w-9 h-9 rounded-full bg-white/10 hover:bg-gold-500 hover:text-navy-950 flex items-center justify-center transition-colors"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn" class="w-9 h-9 rounded-full bg-white/10 hover:bg-gold-500 hover:text-navy-950 flex items-center justify-center transition-colors"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="font-display text-lg font-semibold text-white mb-5 tracking-wide">Company</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="/" class="hover:text-gold-400 transition-colors">Home</a></li>
                    <li><a href="/services" class="hover:text-gold-400 transition-colors">Services</a></li>
                    <li><a href="/about" class="hover:text-gold-400 transition-colors">About Us</a></li>
                    <li><a href="/contact" class="hover:text-gold-400 transition-colors">Contact</a></li>
                    <li><a href="/track" class="hover:text-gold-400 transition-colors">Track Shipment</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h3 class="font-display text-lg font-semibold text-white mb-5 tracking-wide">Our Services</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="/services" class="hover:text-gold-400 transition-colors">Air Freight</a></li>
                    <li><a href="/services" class="hover:text-gold-400 transition-colors">Sea Freight</a></li>
                    <li><a href="/services" class="hover:text-gold-400 transition-colors">Ground Freight</a></li>
                    <li><a href="/services" class="hover:text-gold-400 transition-colors">Warehousing</a></li>
                    <li><a href="/services" class="hover:text-gold-400 transition-colors">Pet Relocation</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="font-display text-lg font-semibold text-white mb-5 tracking-wide">Contact</h3>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-location-dot mt-0.5 text-gold-500"></i>
                        <span>{{ $siteSettings->address ?? 'Global Reach — Worldwide Services' }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-envelope text-gold-500"></i>
                        <a href="mailto:{{ $contactEmail }}" class="hover:text-gold-400 transition-colors">{{ $contactEmail }}</a>
                    </li>
                    @if($contactPhone)
                    <li class="flex items-center gap-3">
                        <i class="fas fa-phone text-gold-500"></i>
                        <a href="tel:{{ $contactPhone }}" class="hover:text-gold-400 transition-colors">{{ $contactPhone }}</a>
                    </li>
                    @endif
                    <li class="flex items-center gap-3">
                        <i class="fas fa-headset text-gold-500"></i>
                        <span>Customer Support</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 mt-12 pt-6 flex flex-col md:flex-row items-center justify-between gap-3 text-xs">
            <p>&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</p>
            <p class="text-white/50">International freight &amp; logistics, engineered for reliability.</p>
        </div>
    </div>
</footer>
