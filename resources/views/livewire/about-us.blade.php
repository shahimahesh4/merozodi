@push('meta')
    <!-- Target SEO Keywords -->
    <meta name="keywords" content="About MeroZodi, Nepal Matrimony, Nepali Matchmaking Community, Verified Nepali Singles, Kundali Milan Nepal, Kathmandu Matrimonial, Nepali Diaspora Matchmaking Australia USA UK">

    <!-- Schema.org Structured Data for AboutPage & BreadcrumbList -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'AboutPage',
                '@id' => url('/about-us') . '/#webpage',
                'url' => url('/about-us'),
                'name' => $seoTitle ?? "About Us - Nepal's Leading Matrimonial & Matchmaking Platform | MeroZodi",
                'description' => $seoDescription ?? "Learn more about MeroZodi, Nepal's #1 trusted matrimonial platform connecting verified Nepali singles & families worldwide.",
                'isPartOf' => [
                    '@type' => 'WebSite',
                    '@id' => url('/') . '/#website',
                    'name' => 'MeroZodi Matrimony',
                    'url' => url('/'),
                ],
            ],
            [
                '@type' => 'BreadcrumbList',
                '@id' => url('/about-us') . '/#breadcrumb',
                'itemListElement' => [
                    [
                        '@type' => 'ListItem',
                        'position' => 1,
                        'name' => 'Home',
                        'item' => url('/'),
                    ],
                    [
                        '@type' => 'ListItem',
                        'position' => 2,
                        'name' => 'About Us',
                        'item' => url('/about-us'),
                    ],
                ],
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

<div class="bg-slate-50 min-h-screen">
    
    <!-- Hero Header Banner with Authentic Nepali Marriage Background -->
    <section class="relative bg-cover bg-no-repeat text-white pt-16 sm:pt-24 lg:pt-28 pb-24 sm:pb-32 lg:pb-36 overflow-hidden min-h-[460px] sm:min-h-[500px] lg:min-h-[520px] flex flex-col justify-center" style="background-image: url('{{ !empty($page?->banner_image) ? (str_starts_with($page->banner_image, 'http') || str_starts_with($page->banner_image, 'images/') ? asset($page->banner_image) : asset('storage/' . $page->banner_image)) : asset('images/about-us-banner.png') }}'); background-position: right 15%;">
        <!-- Deep Multi-Layer Gradient Overlay (Dark on Left for Text, Crystal Clear on Right for Image) -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/80 via-40% to-transparent backdrop-blur-[0.5px]"></div>
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-rose-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-semibold text-rose-200/80 mb-6" aria-label="Breadcrumb">
                <a wire:navigate href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-house text-[11px]"></i> Home
                </a>
                <span class="text-rose-400/60">/</span>
                <span class="text-white font-bold">About Us</span>
            </nav>

            <div class="max-w-lg lg:max-w-xl xl:max-w-2xl">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight drop-shadow-md">
                    Connecting Nepali Hearts & Families <span class="bg-gradient-to-r from-rose-400 via-pink-300 to-amber-300 bg-clip-text text-transparent">Worldwide</span>
                </h1>
                <p class="mt-4 text-xs sm:text-sm md:text-base text-slate-300 leading-relaxed drop-shadow-sm">
                    Bridging sacred Vedic marriage traditions with cutting-edge privacy, verified authenticity, and respectful matchmaking for singles across Nepal and the global diaspora.
                </p>

                <div class="mt-8 flex flex-wrap gap-3 sm:gap-4 text-xs font-bold text-slate-200">
                    <span class="flex items-center gap-1.5 bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/10 backdrop-blur-sm">
                        <i class="fa-solid fa-certificate text-emerald-400"></i> 100% ID Verified
                    </span>
                    <span class="flex items-center gap-1.5 bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/10 backdrop-blur-sm">
                        <i class="fa-solid fa-moon text-amber-300"></i> Vedic 36 Gun Milan
                    </span>
                    <span class="flex items-center gap-1.5 bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/10 backdrop-blur-sm">
                        <i class="fa-solid fa-globe text-indigo-400"></i> 35+ Diaspora Countries
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Numerical Highlights / Stats Grid -->
    <section class="bg-white py-6 sm:py-8 border border-slate-200/80 shadow-xl relative -mt-8 sm:-mt-12 z-20 max-w-6xl mx-auto rounded-3xl mx-4 sm:mx-6 lg:mx-auto">
        <div class="px-4 sm:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 text-center divide-y sm:divide-y-0 sm:divide-x divide-slate-100">
                <div class="p-2 sm:p-4">
                    <p class="text-3xl sm:text-4xl lg:text-5xl font-black text-rose-600 tracking-tight whitespace-nowrap">2,000+</p>
                    <p class="text-xs font-bold text-slate-800 uppercase tracking-wider mt-1.5 whitespace-nowrap">Verified Singles</p>
                    <p class="text-[11px] text-slate-500 mt-0.5 whitespace-nowrap">Across Nepal & Abroad</p>
                </div>
                <div class="p-2 sm:p-4 pt-4 sm:pt-4">
                    <p class="text-3xl sm:text-4xl lg:text-5xl font-black text-indigo-600 tracking-tight whitespace-nowrap">1,200+</p>
                    <p class="text-xs font-bold text-slate-800 uppercase tracking-wider mt-1.5 whitespace-nowrap">Happy Marriages</p>
                    <p class="text-[11px] text-slate-500 mt-0.5 whitespace-nowrap">Sacred Lifelong Unions</p>
                </div>
                <div class="p-2 sm:p-4 pt-4 sm:pt-4">
                    <p class="text-3xl sm:text-4xl lg:text-5xl font-black text-pink-600 tracking-tight whitespace-nowrap">35+</p>
                    <p class="text-xs font-bold text-slate-800 uppercase tracking-wider mt-1.5 whitespace-nowrap">Global Countries</p>
                    <p class="text-[11px] text-slate-500 mt-0.5 whitespace-nowrap">Nepal, AU, US, UK, CA, JP</p>
                </div>
                <div class="p-2 sm:p-4 pt-4 sm:pt-4">
                    <p class="text-3xl sm:text-4xl lg:text-5xl font-black text-emerald-600 tracking-tight whitespace-nowrap">100%</p>
                    <p class="text-xs font-bold text-slate-800 uppercase tracking-wider mt-1.5 whitespace-nowrap">KYC Verified & Safe</p>
                    <p class="text-[11px] text-slate-500 mt-0.5 whitespace-nowrap">Manual Human Audits</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story & Mission (2-Column Narrative with Visuals) -->
    <section class="py-14 sm:py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
            
            <!-- Left Text Content -->
            <div class="lg:col-span-7 space-y-5">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 leading-tight">
                    MeroZodi - Connecting Hearts Through Culture, Trust, and Tradition
                </h2>
                <div class="space-y-3.5 text-[15px] sm:text-base text-slate-600 leading-normal">
                    <p>
                        <strong>MeroZodi</strong> is Nepal’s premier matrimonial and matchmaking platform, thoughtfully designed for modern Nepali singles, Non-Resident Nepalis (NRNs), and families worldwide who value cultural harmony, genuine compatibility, and verified authenticity. Whether you are living in Kathmandu, Pokhara, or across the global Nepali diaspora in Australia, the United States, the United Kingdom, Canada, or Japan, MeroZodi bridges geographical distances to help you find your ideal lifelong partner.
                    </p>
                    <p>
                        In Nepali culture, marriage (<em>Biwaha</em>) is far more than a personal milestone—it is the sacred communion of two families, shared values, and enduring traditions. However, as our generation pursues international education, diverse careers, and independent lifestyles, traditional matchmaking methods often struggle to keep pace. Consequently, finding a compatible soulmate requires a contemporary, respectful, and technologically advanced approach that preserves our rich cultural heritage while prioritizing individual choice and mutual respect.
                    </p>
                    <p>
                        To ensure complete peace of mind, MeroZodi integrates comprehensive identity verification, authentic Vedic 36-Gun Kundali Milan, and strict privacy controls. Moreover, our platform empowers singles and parents alike to connect with confidence through encrypted messaging and secure 1-on-1 virtual dating, eliminating fake profiles and unwanted solicitations. By combining time-honored Nepali customs with modern matchmaking intelligence, MeroZodi provides a safe, dignified, and trustworthy space where lifelong love stories begin.
                    </p>
                </div>
            </div>

            <!-- Right Visual Image Card -->
            <div class="lg:col-span-5 relative">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-slate-900 aspect-4/5 group">
                    <img src="{{ asset('images/about-us-ceremony.jpg') }}" alt="Authentic Traditional Nepali Wedding Ceremony" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
                    
                    <!-- Floating Stat Badge 1 -->
                    <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-md p-3 rounded-2xl shadow-xl border border-white/40 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-rose-500 text-white flex items-center justify-center text-lg shadow-sm">
                            <i class="fa-solid fa-heart"></i>
                        </div>
                        <div>
                            <p class="text-xs font-black text-slate-900">1,200+ Couples</p>
                            <p class="text-[10px] text-rose-600 font-bold">Happily Married</p>
                        </div>
                    </div>

                    <!-- Floating Stat Badge 2 -->
                    <div class="absolute bottom-4 right-4 bg-white/95 backdrop-blur-md p-3 rounded-2xl shadow-xl border border-white/40 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center text-lg shadow-sm">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div>
                            <p class="text-xs font-black text-slate-900">100% ID Verified</p>
                            <p class="text-[10px] text-emerald-600 font-bold">Citizenship Audited</p>
                        </div>
                    </div>
                </div>

                <!-- Subtle Decorative Accent Glow -->
                <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-rose-500/20 rounded-full blur-3xl pointer-events-none -z-10"></div>
            </div>
        </div>
    </section>

    <!-- Why Thousands of Nepali Families Trust MeroZodi (4-Box Grid) -->
    <section class="py-14 sm:py-20 bg-white border-y border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl lg:max-w-5xl mx-auto mb-10 sm:mb-14">
                <div class="inline-flex items-center gap-1.5 bg-rose-50 border border-rose-200/60 text-rose-600 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-shield-heart text-rose-500"></i> Why Choose MeroZodi
                </div>
                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">Why Thousands of Nepali Families Trust MeroZodi</h3>
                <p class="text-sm sm:text-base text-slate-500 mt-2 max-w-2xl mx-auto">Built with uncompromising privacy, high-definition virtual dating, verified security, and seamless local payment options.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Box 1: Uncompromised Privacy -->
                <div class="p-6 sm:p-7 rounded-3xl bg-slate-50 border border-slate-200/80 space-y-3.5 hover:border-rose-300 hover:shadow-lg transition group">
                    <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center text-xl font-bold group-hover:scale-110 transition duration-300 shadow-xs">
                        <i class="fa-solid fa-user-lock"></i>
                    </div>
                    <h4 class="text-base font-black text-slate-900 group-hover:text-rose-600 transition">Uncompromised Privacy</h4>
                    <p class="text-sm sm:text-[15px] text-slate-600 leading-relaxed">
                        Control who views your phone number, photos, and horoscope. No unwanted calls or public exposure.
                    </p>
                </div>

                <!-- Box 2: End-to-End Encrypted Video Dating -->
                <div class="p-6 sm:p-7 rounded-3xl bg-slate-50 border border-slate-200/80 space-y-3.5 hover:border-indigo-300 hover:shadow-lg transition group">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-xl font-bold group-hover:scale-110 transition duration-300 shadow-xs">
                        <i class="fa-solid fa-video"></i>
                    </div>
                    <h4 class="text-base font-black text-slate-900 group-hover:text-indigo-600 transition">End-to-End Encrypted Video Dating</h4>
                    <p class="text-sm sm:text-[15px] text-slate-600 leading-relaxed">
                        Get to know your match in private, high-definition 1-on-1 virtual date rooms from the comfort of your home.
                    </p>
                </div>

                <!-- Box 3: Zero Fake Profiles Policy -->
                <div class="p-6 sm:p-7 rounded-3xl bg-slate-50 border border-slate-200/80 space-y-3.5 hover:border-emerald-300 hover:shadow-lg transition group">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl font-bold group-hover:scale-110 transition duration-300 shadow-xs">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h4 class="text-base font-black text-slate-900 group-hover:text-emerald-600 transition">Zero Fake Profiles Policy</h4>
                    <p class="text-sm sm:text-[15px] text-slate-600 leading-relaxed">
                        Dedicated moderation team reviewing user reports 24/7 with instant suspension of misleading accounts.
                    </p>
                </div>

                <!-- Box 4: Transparent Nepali Pricing -->
                <div class="p-6 sm:p-7 rounded-3xl bg-slate-50 border border-slate-200/80 space-y-3.5 hover:border-amber-300 hover:shadow-lg transition group">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl font-bold group-hover:scale-110 transition duration-300 shadow-xs">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <h4 class="text-base font-black text-slate-900 group-hover:text-amber-600 transition">Transparent Nepali Pricing</h4>
                    <p class="text-sm sm:text-[15px] text-slate-600 leading-relaxed">
                        Seamlessly upgrade membership via official local gateways including eSewa, Khalti, Fonepay, and ConnectIPS.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- High-Converting Bottom Parallax CTA Section -->
    <section class="relative bg-fixed bg-cover bg-center text-white py-16 sm:py-20 overflow-hidden" style="background-image: url('{{ asset('images/terms-conditions-banner.png') }}');">
        <!-- Parallax Dark Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-rose-950/90 to-slate-950/95 backdrop-blur-[2px]"></div>

        <div class="max-w-5xl lg:max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-6">
            <div class="inline-flex items-center gap-2 bg-rose-500/20 border border-rose-500/40 text-rose-300 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm backdrop-blur-md">
                <i class="fa-solid fa-heart-pulse"></i> Begin Your Sacred Journey
            </div>
            <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black tracking-tight leading-tight sm:whitespace-nowrap">
                Ready to Find Your Lifelong Soulmate?
            </h3>
            <p class="text-xs sm:text-sm md:text-base text-slate-300 max-w-xl mx-auto leading-relaxed">
                Join thousands of verified Nepali singles discovering meaningful marital harmony today. Free registration with full privacy control.
            </p>
            <div class="pt-2 flex flex-col sm:flex-row justify-center items-center gap-3.5">
                <a wire:navigate href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-3.5 bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white font-black text-xs sm:text-sm rounded-2xl shadow-xl shadow-rose-950 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 tap-active">
                    <i class="fa-solid fa-user-plus"></i> Register Free Today
                </a>
                <a wire:navigate href="{{ route('browse') }}" class="w-full sm:w-auto px-8 py-3.5 bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm rounded-2xl border border-white/20 backdrop-blur-md transition flex items-center justify-center gap-2 tap-active">
                    <i class="fa-solid fa-compass"></i> Browse Verified Matches
                </a>
            </div>
        </div>
    </section>

</div>
