<div class="bg-slate-50 min-h-screen" x-data="{ activeSection: 'introduction' }">
    
    <!-- Hero Header Banner with Authentic Privacy & Security Artwork -->
    <section class="relative bg-cover bg-no-repeat text-white pt-16 sm:pt-20 lg:pt-24 pb-20 sm:pb-28 lg:pb-32 overflow-hidden" style="background-image: url('{{ !empty($page?->banner_image) ? (str_starts_with($page->banner_image, 'http') || str_starts_with($page->banner_image, 'images/') ? asset($page->banner_image) : asset('storage/' . $page->banner_image)) : asset('images/privacy-policy-banner.png') }}'); background-position: center right;">
        <!-- Deep Multi-Layer Gradient Overlay (Dark on Left for Text, Crystal Clear on Right for Artwork) -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/70 via-50% to-transparent backdrop-blur-[0.5px]"></div>
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-rose-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-semibold text-rose-200/80 mb-5" aria-label="Breadcrumb">
                <a wire:navigate href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-house text-[11px]"></i> Home
                </a>
                <span class="text-rose-400/60">/</span>
                <span class="text-rose-200/90">Legal & Information</span>
                <span class="text-rose-400/60">/</span>
                <span class="text-white font-bold">Privacy Policy</span>
            </nav>

            <div class="max-w-lg lg:max-w-xl xl:max-w-2xl">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight drop-shadow-md">
                    {{ $page->title ?? 'Privacy Policy & Data Security' }}
                </h1>
                <p class="mt-4 text-xs sm:text-sm md:text-base text-slate-300 leading-relaxed drop-shadow-sm">
                    {{ $page->subtitle ?? 'Learn how MeroZodi safeguards your personal biodata, KYC citizenship verification, astrological Kundali information, and private communications.' }}
                </p>

                <!-- Action & Security Badges Strip -->
                <div class="mt-7 flex flex-wrap items-center gap-3 sm:gap-4 text-xs font-bold text-slate-200">
                    <span class="flex items-center gap-1.5 bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/10 backdrop-blur-sm">
                        <i class="fa-solid fa-lock text-emerald-400"></i> 256-Bit SSL Encrypted
                    </span>
                    <span class="flex items-center gap-1.5 bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/10 backdrop-blur-sm">
                        <i class="fa-solid fa-user-shield text-amber-300"></i> Data Protection Officer
                    </span>
                    <button onclick="window.print()" class="flex items-center gap-1.5 bg-white/10 hover:bg-white/20 text-white px-3.5 py-1.5 rounded-xl border border-white/20 backdrop-blur-sm transition cursor-pointer">
                        <i class="fa-solid fa-print text-rose-300"></i> Print Policy
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 sm:pb-16">

        <!-- 4 Key Data Safeguards Cards (Floating Overlay above Banner) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 relative -mt-10 sm:-mt-14 z-20 mb-10 sm:mb-12">
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xl hover:shadow-2xl hover:border-emerald-300 transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shadow-xs mb-4">
                    <i class="fa-solid fa-eye-slash"></i>
                </div>
                <h2 class="text-base font-black uppercase tracking-wider text-slate-900 mb-1.5">1. Contact Privacy</h2>
                <p class="text-sm text-slate-500 leading-relaxed">Your phone number and email are concealed until you accept a connection request.</p>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xl hover:shadow-2xl hover:border-indigo-300 transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl shadow-xs mb-4">
                    <i class="fa-solid fa-vault"></i>
                </div>
                <h2 class="text-base font-black uppercase tracking-wider text-slate-900 mb-1.5">2. Isolated KYC Vault</h2>
                <p class="text-sm text-slate-500 leading-relaxed">Citizenship and Passport documents are encrypted and never shown publicly.</p>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xl hover:shadow-2xl hover:border-rose-300 transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl shadow-xs mb-4">
                    <i class="fa-solid fa-ban"></i>
                </div>
                <h2 class="text-base font-black uppercase tracking-wider text-slate-900 mb-1.5">3. Zero Data Sales</h2>
                <p class="text-sm text-slate-500 leading-relaxed">We never sell, rent, or trade your personal profile data to third-party advertisers.</p>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xl hover:shadow-2xl hover:border-amber-300 transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shadow-xs mb-4">
                    <i class="fa-solid fa-trash-can"></i>
                </div>
                <h2 class="text-base font-black uppercase tracking-wider text-slate-900 mb-1.5">4. Right to Erasure</h2>
                <p class="text-sm text-slate-500 leading-relaxed">Delete your account anytime; all photos, messages, and biodata are purged in 48 hours.</p>
            </div>
        </div>

        <!-- Main Content 2-Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Sticky Sidebar: Table of Contents -->
            <div class="lg:col-span-4 lg:sticky lg:top-24 space-y-6 order-2 lg:order-1">
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                        <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-list-ol text-emerald-600"></i> Policy Sections
                        </h2>
                        <span class="text-[11px] text-slate-400 font-semibold">7 Sections</span>
                    </div>

                    <nav class="space-y-1.5 text-[15px] font-medium text-slate-700">
                        <a href="#introduction" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition group">
                            <span class="w-6 h-6 rounded-full bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-emerald-700 text-xs font-bold flex items-center justify-center shrink-0">1</span>
                            <span>Introduction & Scope</span>
                        </a>
                        <a href="#data-collected" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition group">
                            <span class="w-6 h-6 rounded-full bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-emerald-700 text-xs font-bold flex items-center justify-center shrink-0">2</span>
                            <span>Information We Collect</span>
                        </a>
                        <a href="#data-usage" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition group">
                            <span class="w-6 h-6 rounded-full bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-emerald-700 text-xs font-bold flex items-center justify-center shrink-0">3</span>
                            <span>How We Use Your Data</span>
                        </a>
                        <a href="#privacy-controls" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition group">
                            <span class="w-6 h-6 rounded-full bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-emerald-700 text-xs font-bold flex items-center justify-center shrink-0">4</span>
                            <span>Privacy & Visibility Controls</span>
                        </a>
                        <a href="#security-measures" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition group">
                            <span class="w-6 h-6 rounded-full bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-emerald-700 text-xs font-bold flex items-center justify-center shrink-0">5</span>
                            <span>Data Security Architecture</span>
                        </a>
                        <a href="#account-deletion" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition group">
                            <span class="w-6 h-6 rounded-full bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-emerald-700 text-xs font-bold flex items-center justify-center shrink-0">6</span>
                            <span>Account Erasure Rights</span>
                        </a>
                        <a href="#contact-dpo" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition group">
                            <span class="w-6 h-6 rounded-full bg-slate-100 text-slate-500 group-hover:bg-emerald-100 group-hover:text-emerald-700 text-xs font-bold flex items-center justify-center shrink-0">7</span>
                            <span>Data Protection Officer</span>
                        </a>
                    </nav>
                </div>

                <!-- DPO Assistance Card -->
                <div class="bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-3xl p-6 shadow-md relative overflow-hidden">
                    <div class="relative z-10 space-y-3">
                        <div class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-white text-base">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <h2 class="text-sm font-black">Data Privacy Officer (DPO)</h2>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            Have privacy concerns, KYC inquiries, or wish to exercise data rights? Reach out directly to our Data Protection Officer.
                        </p>
                        <div class="pt-2">
                            <a href="mailto:privacy@merozodi.com" class="btn btn-sm bg-emerald-600 hover:bg-emerald-700 text-white font-bold border-none rounded-xl text-xs w-full shadow-sm">
                                <i class="fa-solid fa-envelope mr-1"></i> privacy@merozodi.com
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Navigation to Terms -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200/80 text-xs text-slate-600 space-y-2">
                    <span class="font-bold text-slate-800 block">Related Documents:</span>
                    <a wire:navigate href="{{ route('terms') }}" class="flex items-center justify-between text-rose-600 hover:underline font-semibold">
                        <span><i class="fa-solid fa-scale-balanced mr-1.5"></i> Terms & Conditions</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Right: Spacious Main Legal Body Content -->
            <div class="lg:col-span-8 order-1 lg:order-2">
                @if($page)
                    <div class="bg-white rounded-3xl p-6 sm:p-8 lg:p-10 border border-slate-200/80 shadow-xs legal-prose">
                        {!! $page->content !!}
                    </div>
                @else
                    <div class="bg-white rounded-3xl p-16 text-center text-slate-400 border border-slate-200/80 shadow-xs">
                        <i class="fa-solid fa-file-shield text-5xl mb-4 text-slate-300"></i>
                        <h2 class="text-lg font-bold text-slate-700">Privacy Policy Updating</h2>
                        <p class="text-xs mt-1">Our data privacy disclosure is currently being updated by the legal division.</p>
                    </div>
                @endif

                <!-- Bottom Safe Matchmaking Notice -->
                <div class="mt-8 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="space-y-1 text-center sm:text-left">
                        <h2 class="text-sm font-black text-slate-900 flex items-center justify-center sm:justify-start gap-2">
                            <i class="fa-solid fa-lock text-emerald-500"></i> Privacy-First Matrimony
                        </h2>
                        <p class="text-xs text-slate-500">
                            Feel secure knowing your biodata and photos are protected by industry-standard encryption protocols.
                        </p>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <a wire:navigate href="{{ route('browse') }}" class="btn btn-primary bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 border-none text-white rounded-xl text-xs font-bold px-6 shadow-md shadow-rose-200 tap-active">
                            Explore Matches
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

