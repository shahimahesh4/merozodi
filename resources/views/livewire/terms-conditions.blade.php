<div class="bg-slate-50 min-h-screen" x-data="{ activeSection: 'acceptance' }">
    
    <!-- Hero Header Banner with Authentic Nepali Marriage Background (Matching About Us) -->
    <section class="relative bg-cover bg-no-repeat text-white pt-12 sm:pt-16 lg:pt-20 pb-14 sm:pb-18 lg:pb-20 overflow-hidden mb-10" style="background-image: url('{{ asset('images/about-us-banner.png') }}'); background-position: right 15%;">
        <!-- Deep Multi-Layer Gradient Overlay (Dark on Left for Text, Crystal Clear on Right for Image) -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/85 via-45% to-transparent backdrop-blur-[0.5px]"></div>
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-rose-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-semibold text-rose-200/80 mb-5" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-house text-[11px]"></i> Home
                </a>
                <span class="text-rose-400/60">/</span>
                <span class="text-rose-200/90">Legal & Information</span>
                <span class="text-rose-400/60">/</span>
                <span class="text-white font-bold">Terms & Conditions</span>
            </nav>

            <div class="max-w-lg lg:max-w-xl xl:max-w-2xl">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight drop-shadow-md">
                    {{ $page->title ?? 'Terms & Conditions of Service' }}
                </h1>
                <p class="mt-4 text-xs sm:text-sm md:text-base text-slate-300 leading-relaxed drop-shadow-sm">
                    {{ $page->subtitle ?? 'Please read these terms carefully before accessing MeroZodi matrimonial matchmaking services. This agreement outlines member eligibility, code of conduct, payment terms, and legal rights.' }}
                </p>

                <!-- Action & Jurisdiction Badges Strip -->
                <div class="mt-7 flex flex-wrap items-center gap-3 sm:gap-4 text-xs font-bold text-slate-200">
                    <span class="flex items-center gap-1.5 bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/10 backdrop-blur-sm">
                        <i class="fa-solid fa-landmark text-amber-300"></i> Nepal Courts (Kathmandu)
                    </span>
                    <span class="flex items-center gap-1.5 bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/10 backdrop-blur-sm">
                        <i class="fa-solid fa-shield-halved text-emerald-400"></i> Verified Platform
                    </span>
                    <button onclick="window.print()" class="flex items-center gap-1.5 bg-white/10 hover:bg-white/20 text-white px-3.5 py-1.5 rounded-xl border border-white/20 backdrop-blur-sm transition cursor-pointer">
                        <i class="fa-solid fa-print text-rose-300"></i> Print Terms
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 sm:pb-16">

        <!-- 4 Key Takeaways Quick Scan Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:border-rose-200 transition">
                <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg mb-3">
                    <i class="fa-solid fa-heart-circle-check"></i>
                </div>
                <h2 class="text-xs font-black uppercase tracking-wider text-slate-900 mb-1">1. Genuine Matrimony</h2>
                <p class="text-xs text-slate-500 leading-relaxed">Exclusively for genuine marriage alliances. Zero tolerance for casual dating or commercial escorting.</p>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:border-indigo-200 transition">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg mb-3">
                    <i class="fa-solid fa-user-lock"></i>
                </div>
                <h2 class="text-xs font-black uppercase tracking-wider text-slate-900 mb-1">2. Age & Single Status</h2>
                <p class="text-xs text-slate-500 leading-relaxed">Minimum legal marriageable age (20+ for Nepal / 18+ internationally). Must be legally single or divorced.</p>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:border-emerald-200 transition">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg mb-3">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <h2 class="text-xs font-black uppercase tracking-wider text-slate-900 mb-1">3. Mandatory Identity Audit</h2>
                <p class="text-xs text-slate-500 leading-relaxed">Profiles undergo strict National ID / Passport / Citizenship verification to eliminate fake accounts.</p>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:border-amber-200 transition">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg mb-3">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <h2 class="text-xs font-black uppercase tracking-wider text-slate-900 mb-1">4. Transparent Payments</h2>
                <p class="text-xs text-slate-500 leading-relaxed">Instant activation via eSewa, Khalti, Fonepay, ConnectIPS. Subscriptions are non-refundable digital services.</p>
            </div>
        </div>

        <!-- Main Content 2-Column Layout with Sticky Sidebar Table of Contents -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Sticky Sidebar: Table of Contents (Desktop lg:col-span-4) -->
            <div class="lg:col-span-4 lg:sticky lg:top-24 space-y-6 order-2 lg:order-1">
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                        <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-list-ol text-rose-600"></i> Table of Contents
                        </h2>
                        <span class="text-[11px] text-slate-400 font-semibold">9 Sections</span>
                    </div>

                    <nav class="space-y-1 text-xs font-medium text-slate-600">
                        <a href="#acceptance" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition group">
                            <span class="w-5 h-5 rounded-full bg-slate-100 text-slate-500 group-hover:bg-rose-100 group-hover:text-rose-600 text-[10px] font-bold flex items-center justify-center">1</span>
                            <span>Acceptance of Agreement</span>
                        </a>
                        <a href="#eligibility" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition group">
                            <span class="w-5 h-5 rounded-full bg-slate-100 text-slate-500 group-hover:bg-rose-100 group-hover:text-rose-600 text-[10px] font-bold flex items-center justify-center">2</span>
                            <span>Eligibility & Criteria</span>
                        </a>
                        <a href="#conduct" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition group">
                            <span class="w-5 h-5 rounded-full bg-slate-100 text-slate-500 group-hover:bg-rose-100 group-hover:text-rose-600 text-[10px] font-bold flex items-center justify-center">3</span>
                            <span>Code of Conduct & Anti-Abuse</span>
                        </a>
                        <a href="#kyc" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition group">
                            <span class="w-5 h-5 rounded-full bg-slate-100 text-slate-500 group-hover:bg-rose-100 group-hover:text-rose-600 text-[10px] font-bold flex items-center justify-center">4</span>
                            <span>KYC Verification & Audit</span>
                        </a>
                        <a href="#subscriptions" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition group">
                            <span class="w-5 h-5 rounded-full bg-slate-100 text-slate-500 group-hover:bg-rose-100 group-hover:text-rose-600 text-[10px] font-bold flex items-center justify-center">5</span>
                            <span>Subscriptions & Payments</span>
                        </a>
                        <a href="#disclaimer" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition group">
                            <span class="w-5 h-5 rounded-full bg-slate-100 text-slate-500 group-hover:bg-rose-100 group-hover:text-rose-600 text-[10px] font-bold flex items-center justify-center">6</span>
                            <span>Matchmaking Disclaimer</span>
                        </a>
                        <a href="#termination" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition group">
                            <span class="w-5 h-5 rounded-full bg-slate-100 text-slate-500 group-hover:bg-rose-100 group-hover:text-rose-600 text-[10px] font-bold flex items-center justify-center">7</span>
                            <span>Account Termination</span>
                        </a>
                        <a href="#jurisdiction" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition group">
                            <span class="w-5 h-5 rounded-full bg-slate-100 text-slate-500 group-hover:bg-rose-100 group-hover:text-rose-600 text-[10px] font-bold flex items-center justify-center">8</span>
                            <span>Governing Law (Nepal)</span>
                        </a>
                        <a href="#contact-legal" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-rose-50 hover:text-rose-600 transition group">
                            <span class="w-5 h-5 rounded-full bg-slate-100 text-slate-500 group-hover:bg-rose-100 group-hover:text-rose-600 text-[10px] font-bold flex items-center justify-center">9</span>
                            <span>Legal Notices & Contact</span>
                        </a>
                    </nav>
                </div>

                <!-- Support & Grievance Contact Card -->
                <div class="bg-gradient-to-br from-indigo-900 to-slate-900 text-white rounded-3xl p-6 shadow-md relative overflow-hidden">
                    <div class="relative z-10 space-y-3">
                        <div class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-white text-base">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <h2 class="text-sm font-black">Need Legal Clarification?</h2>
                        <p class="text-xs text-indigo-200 leading-relaxed">
                            Our legal compliance officers and member support team are available to answer any questions regarding terms or membership policies.
                        </p>
                        <div class="pt-2">
                            <a href="{{ route('contact') }}" class="btn btn-sm bg-rose-600 hover:bg-rose-700 text-white font-bold border-none rounded-xl text-xs w-full shadow-sm">
                                <i class="fa-solid fa-envelope mr-1"></i> Contact Support Desk
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Navigation to Privacy Policy -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200/80 text-xs text-slate-600 space-y-2">
                    <span class="font-bold text-slate-800 block">Related Policies:</span>
                    <a href="{{ route('privacy') }}" class="flex items-center justify-between text-rose-600 hover:underline font-semibold">
                        <span><i class="fa-solid fa-shield-halved mr-1.5"></i> Data Privacy Policy</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Right: Spacious Main Legal Body Content (Desktop lg:col-span-8) -->
            <div class="lg:col-span-8 order-1 lg:order-2">
                @if($page)
                    <div class="bg-white rounded-3xl p-6 sm:p-10 lg:p-14 border border-slate-200/80 shadow-xs legal-prose">
                        {!! $page->content !!}
                    </div>
                @else
                    <div class="bg-white rounded-3xl p-16 text-center text-slate-400 border border-slate-200/80 shadow-xs">
                        <i class="fa-solid fa-file-contract text-5xl mb-4 text-slate-300"></i>
                        <h2 class="text-lg font-bold text-slate-700">Terms & Conditions Document Updating</h2>
                        <p class="text-xs mt-1">Our member agreement document is currently being updated by the legal division.</p>
                    </div>
                @endif

                <!-- Bottom Confirmation & Acceptance Bar -->
                <div class="mt-8 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="space-y-1 text-center sm:text-left">
                        <h2 class="text-sm font-black text-slate-900 flex items-center justify-center sm:justify-start gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-500"></i> Your Trust & Security is Our Mission
                        </h2>
                        <p class="text-xs text-slate-500">
                            By continuing to use MeroZodi, you agree to these terms. Explore thousands of verified matches safely.
                        </p>
                    </div>
                    <div class="flex items-center gap-3 shrink-0">
                        <a href="{{ route('browse') }}" class="btn btn-primary bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 border-none text-white rounded-xl text-xs font-bold px-6 shadow-md shadow-rose-200 tap-active">
                            Browse Matches Now
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

