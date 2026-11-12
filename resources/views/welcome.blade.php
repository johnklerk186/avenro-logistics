@extends('layouts.app')

@section('title', 'Avenro Logistics — Global Freight, Express & Warehousing Solutions')
@section('meta_description', 'Avenro Logistics provides international air, sea and ground freight, warehousing and real-time tracked shipping for businesses worldwide.')

@section('content')
<main>
    <!-- ============ HERO ============ -->
    <section class="relative overflow-hidden bg-navy-950">
        <div class="absolute inset-0">
            <img src="{{ asset('images/logistics-hero1.jpeg') }}" alt="Container ship at port" class="w-full h-full object-cover opacity-35">
            <div class="absolute inset-0 bg-gradient-to-r from-navy-950 via-navy-950/85 to-navy-900/40"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 pt-20 pb-24 md:pt-28 md:pb-32">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 border border-gold-500/40 text-gold-300 text-xs font-semibold tracking-[0.2em] uppercase px-4 py-2 rounded-full mb-8">
                    <i class="fas fa-globe"></i> International Logistics, Simplified
                </div>
                <h1 class="font-display text-4xl md:text-6xl font-extrabold text-white leading-[1.08] tracking-tight">
                    Freight that moves<br>
                    <span class="text-gold-400">the world forward.</span>
                </h1>
                <p class="mt-6 text-lg text-white/75 max-w-xl leading-relaxed">
                    Avenro Logistics connects businesses across borders with dependable air, sea and ground freight, secure warehousing and precision shipment tracking.
                </p>
                <div class="mt-9 flex flex-col sm:flex-row gap-4">
                    <a href="/services" class="avenro-btn avenro-btn-navy">Explore Services <i class="fas fa-arrow-right"></i></a>
                    <a href="/track" class="avenro-btn" style="background-color: transparent; color:#fff; border:2px solid rgba(255,255,255,0.4);">Track a Shipment</a>
                </div>
            </div>

            <!-- Tracking widget -->
            <div class="mt-14 max-w-xl bg-white rounded-2xl shadow-lift p-6 md:p-7">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-navy-900 text-gold-400 flex items-center justify-center"><i class="fas fa-location-dot"></i></div>
                    <div>
                        <h3 class="font-display font-bold text-navy-900">Track Your Shipment</h3>
                        <p class="text-xs text-ink/60">Real-time status, location and delivery updates</p>
                    </div>
                </div>
                <form action="{{ route('track') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                    <input type="text" name="tracking_number" required placeholder="Enter tracking number"
                           class="flex-1 px-4 py-3.5 rounded-lg border border-line focus:border-gold-500 focus:ring-2 focus:ring-gold-500/20 outline-none text-ink text-sm">
                    <button type="submit" class="avenro-btn avenro-btn-navy justify-center whitespace-nowrap">
                        <i class="fas fa-magnifying-glass"></i> Track Now
                    </button>
                </form>
            </div>
        </div>

        <!-- Hero image strip -->
        <div class="relative border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 py-6 grid grid-cols-3 gap-4">
                <img src="{{ asset('images/logistics-hero2.jpeg') }}" alt="Air cargo loading" class="hidden sm:block rounded-lg h-28 md:h-36 w-full object-cover opacity-80">
                <img src="{{ asset('images/logistics-hero3.jpg') }}" alt="Warehouse operations" class="rounded-lg h-28 md:h-36 w-full object-cover opacity-80">
                <img src="{{ asset('images/logistics-hero1.jpeg') }}" alt="Freight containers" class="hidden md:block rounded-lg h-28 md:h-36 w-full object-cover opacity-80">
            </div>
        </div>
    </section>

    <!-- ============ WHY AVENRO ============ -->
    <section class="py-20 md:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="max-w-2xl reveal">
                <p class="text-gold-600 font-semibold text-sm tracking-[0.2em] uppercase mb-3">Why Avenro</p>
                <h2 class="font-display text-3xl md:text-5xl font-bold text-navy-900 leading-tight">Logistics engineered around your cargo.</h2>
                <p class="mt-5 text-ink/70 text-lg leading-relaxed">
                    Every shipment is planned, tracked and delivered with operational discipline — from pickup to final proof of delivery.
                </p>
            </div>

            <div class="mt-14 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="group bg-mist rounded-2xl p-8 border border-line hover:border-gold-500/50 hover:shadow-soft transition-all duration-300 reveal">
                    <div class="w-14 h-14 rounded-xl bg-navy-900 text-gold-400 flex items-center justify-center text-xl mb-6 group-hover:bg-gold-500 group-hover:text-navy-950 transition-colors"><i class="fas fa-route"></i></div>
                    <h3 class="font-display font-bold text-xl text-navy-900 mb-3">End-to-End Visibility</h3>
                    <p class="text-ink/65 leading-relaxed">Track every milestone — pickup, transit, customs and delivery — through one consistent timeline.</p>
                </div>
                <div class="group bg-mist rounded-2xl p-8 border border-line hover:border-gold-500/50 hover:shadow-soft transition-all duration-300 reveal" style="transition-delay:80ms">
                    <div class="w-14 h-14 rounded-xl bg-navy-900 text-gold-400 flex items-center justify-center text-xl mb-6 group-hover:bg-gold-500 group-hover:text-navy-950 transition-colors"><i class="fas fa-shield-halved"></i></div>
                    <h3 class="font-display font-bold text-xl text-navy-900 mb-3">Secure Handling</h3>
                    <p class="text-ink/65 leading-relaxed">Careful packing standards, documented handovers and protected transport for high-value cargo.</p>
                </div>
                <div class="group bg-mist rounded-2xl p-8 border border-line hover:border-gold-500/50 hover:shadow-soft transition-all duration-300 reveal" style="transition-delay:160ms">
                    <div class="w-14 h-14 rounded-xl bg-navy-900 text-gold-400 flex items-center justify-center text-xl mb-6 group-hover:bg-gold-500 group-hover:text-navy-950 transition-colors"><i class="fas fa-headset"></i></div>
                    <h3 class="font-display font-bold text-xl text-navy-900 mb-3">Dedicated Support</h3>
                    <p class="text-ink/65 leading-relaxed">A responsive team for quotes, shipment planning and real-time logistics assistance.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ SERVICES ============ -->
    <section class="py-20 md:py-24 bg-navy-950 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.07]" style="background-image: radial-gradient(circle at 1px 1px, #C6A15B 1px, transparent 0); background-size: 32px 32px;"></div>
        <div class="relative max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 reveal">
                <div>
                    <p class="text-gold-400 font-semibold text-sm tracking-[0.2em] uppercase mb-3">What We Do</p>
                    <h2 class="font-display text-3xl md:text-5xl font-bold text-white">Global logistics solutions</h2>
                </div>
                <a href="/services" class="avenro-btn self-start md:self-auto">All Services <i class="fas fa-arrow-right"></i></a>
            </div>

            <div class="mt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <a href="/services" class="group bg-white/5 border border-white/10 rounded-2xl p-7 hover:bg-white/10 hover:border-gold-500/60 transition-all duration-300 reveal">
                    <i class="fas fa-plane text-2xl text-gold-400 mb-5 block"></i>
                    <h3 class="font-display font-bold text-white text-lg mb-2">Air Freight</h3>
                    <p class="text-white/60 text-sm leading-relaxed">Express and time-critical air cargo, door to door worldwide.</p>
                    <span class="inline-flex items-center text-gold-400 text-sm font-semibold mt-5 group-hover:gap-2 transition-all">Learn more <i class="fas fa-arrow-right text-xs"></i></span>
                </a>
                <a href="/services" class="group bg-white/5 border border-white/10 rounded-2xl p-7 hover:bg-white/10 hover:border-gold-500/60 transition-all duration-300 reveal" style="transition-delay:80ms">
                    <i class="fas fa-ship text-2xl text-gold-400 mb-5 block"></i>
                    <h3 class="font-display font-bold text-white text-lg mb-2">Sea Freight</h3>
                    <p class="text-white/60 text-sm leading-relaxed">FCL &amp; LCL container shipping with global port coverage.</p>
                    <span class="inline-flex items-center text-gold-400 text-sm font-semibold mt-5 group-hover:gap-2 transition-all">Learn more <i class="fas fa-arrow-right text-xs"></i></span>
                </a>
                <a href="/services" class="group bg-white/5 border border-white/10 rounded-2xl p-7 hover:bg-white/10 hover:border-gold-500/60 transition-all duration-300 reveal" style="transition-delay:160ms">
                    <i class="fas fa-truck-fast text-2xl text-gold-400 mb-5 block"></i>
                    <h3 class="font-display font-bold text-white text-lg mb-2">Ground Freight</h3>
                    <p class="text-white/60 text-sm leading-relaxed">GPS-equipped road transport for regional and cross-border loads.</p>
                    <span class="inline-flex items-center text-gold-400 text-sm font-semibold mt-5 group-hover:gap-2 transition-all">Learn more <i class="fas fa-arrow-right text-xs"></i></span>
                </a>
                <a href="/services" class="group bg-white/5 border border-white/10 rounded-2xl p-7 hover:bg-white/10 hover:border-gold-500/60 transition-all duration-300 reveal" style="transition-delay:240ms">
                    <i class="fas fa-warehouse text-2xl text-gold-400 mb-5 block"></i>
                    <h3 class="font-display font-bold text-white text-lg mb-2">Warehousing</h3>
                    <p class="text-white/60 text-sm leading-relaxed">Secure storage, inventory management and fulfilment support.</p>
                    <span class="inline-flex items-center text-gold-400 text-sm font-semibold mt-5 group-hover:gap-2 transition-all">Learn more <i class="fas fa-arrow-right text-xs"></i></span>
                </a>
            </div>
        </div>
    </section>

    <!-- ============ PROCESS ============ -->
    <section class="py-20 md:py-24 bg-mist">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center max-w-2xl mx-auto reveal">
                <p class="text-gold-600 font-semibold text-sm tracking-[0.2em] uppercase mb-3">How It Works</p>
                <h2 class="font-display text-3xl md:text-5xl font-bold text-navy-900">From quote to delivery in four steps</h2>
            </div>

            <div class="mt-14 grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                <div class="hidden md:block absolute top-10 left-[12%] right-[12%] h-px bg-gradient-to-r from-gold-500/10 via-gold-500/50 to-gold-500/10"></div>
                @foreach([
                    ['Request a Quote', 'Tell us what you are shipping, where it is going and when it needs to arrive.', 'fa-file-pen'],
                    ['We Plan & Book', 'Our team selects the optimal mode, carrier and schedule for your cargo.', 'fa-route'],
                    ['We Track & Move', 'Your shipment is collected, transported and monitored with live updates.', 'fa-location-dot'],
                    ['Delivered & Confirmed', 'Final handover with delivery confirmation and full documentation.', 'fa-circle-check'],
                ] as $step)
                <div class="text-center reveal">
                    <div class="w-20 h-20 mx-auto rounded-2xl bg-navy-900 text-gold-400 flex items-center justify-center text-2xl relative z-10 shadow-soft">
                        <i class="fas {{ $step[2] }}"></i>
                    </div>
                    <h3 class="font-display font-bold text-navy-900 mt-5 mb-2">{{ $step[0] }}</h3>
                    <p class="text-ink/60 text-sm leading-relaxed">{{ $step[1] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ============ TESTIMONIALS (real, admin-managed) ============ -->
    @if(isset($testimonials) && $testimonials->count())
    <section class="py-20 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center max-w-2xl mx-auto reveal">
                <p class="text-gold-600 font-semibold text-sm tracking-[0.2em] uppercase mb-3">Client Stories</p>
                <h2 class="font-display text-3xl md:text-5xl font-bold text-navy-900">What our customers say</h2>
            </div>
            <div class="mt-14 grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($testimonials as $t)
                <figure class="bg-mist border border-line rounded-2xl p-7 reveal">
                    <div class="text-gold-500 text-sm mb-4"><i class="fas fa-quote-left"></i></div>
                    <blockquote class="text-ink/75 leading-relaxed">{{ $t->content }}</blockquote>
                    <figcaption class="mt-6 font-display font-semibold text-navy-900">
                        @if($t->client_image)<img src="{{ $t->client_image }}" alt="{{ $t->client_name }}" class="w-10 h-10 rounded-full object-cover inline-block mr-3 align-middle">@endif
                        {{ $t->client_name }} <span class="block text-xs font-normal text-ink/50 font-sans">{{ $t->client_title }}</span>
                    </figcaption>
                </figure>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ============ CTA ============ -->
    <section class="py-20 bg-navy-900 relative overflow-hidden">
        <div class="absolute -right-24 -top-24 w-96 h-96 rounded-full bg-gold-500/10 blur-3xl"></div>
        <div class="absolute -left-24 -bottom-24 w-96 h-96 rounded-full bg-navy-600/40 blur-3xl"></div>
        <div class="relative max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-10">
            <div class="max-w-xl reveal">
                <h2 class="font-display text-3xl md:text-4xl font-bold text-white">Ready to ship with Avenro?</h2>
                <p class="mt-4 text-white/70">Get a tailored quote or track an existing shipment in seconds.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 reveal">
                <a href="/contact" class="avenro-btn justify-center">Request a Quote <i class="fas fa-arrow-right"></i></a>
                <a href="/track" class="avenro-btn avenro-btn-navy justify-center" style="background-color: transparent; color:#fff; border:2px solid rgba(255,255,255,0.35);">Track Shipment</a>
            </div>
        </div>
    </section>
</main>
@endsection
