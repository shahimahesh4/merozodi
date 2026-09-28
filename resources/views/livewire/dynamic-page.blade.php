<div class="bg-slate-50 min-h-screen">
    
    <!-- Hero Header Banner with Authentic Nepali Marriage Background (Matching About Us) -->
    <section class="relative bg-cover bg-no-repeat text-white pt-12 sm:pt-16 lg:pt-20 pb-14 sm:pb-18 lg:pb-20 overflow-hidden mb-10" style="background-image: url('{{ asset('images/about-us-banner.png') }}'); background-position: right 15%;">
        <!-- Deep Multi-Layer Gradient Overlay (Dark on Left for Text, Crystal Clear on Right for Image) -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/85 via-45% to-transparent backdrop-blur-[0.5px]"></div>
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-rose-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-semibold text-rose-200/80 mb-5" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-house text-[11px]"></i> Home
                </a>
                <span class="text-rose-400/60">/</span>
                <span class="text-white font-bold">{{ $page->title }}</span>
            </nav>

            <div class="max-w-lg lg:max-w-xl xl:max-w-2xl">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight drop-shadow-md">
                    {{ $page->title }}
                </h1>
                @if($page->subtitle)
                    <p class="mt-4 text-xs sm:text-sm md:text-base text-slate-300 leading-relaxed drop-shadow-sm">
                        {{ $page->subtitle }}
                    </p>
                @endif
                <div class="mt-7 flex flex-wrap items-center gap-3 sm:gap-4 text-xs font-bold text-slate-200">
                    <span class="flex items-center gap-1.5 bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/10 backdrop-blur-sm">
                        <i class="fa-solid fa-certificate text-emerald-400"></i> Official MeroZodi Policy
                    </span>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 sm:pb-16">

        <!-- Dynamic Body Content -->
        <div class="bg-white rounded-3xl p-6 sm:p-10 lg:p-12 border border-slate-200/80 shadow-xs legal-prose">
            {!! $page->content !!}
        </div>

    </div>
</div>
