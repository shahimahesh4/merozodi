@push('meta')
    <!-- Target SEO Keywords -->
    <meta name="keywords" content="Nepali Matrimony, Nepal Matchmaking, Nepali Brides, Nepali Grooms, Kundali Milan, 36 Gun Milan, Kathmandu Matrimonial, Brahmin Matrimony, Chhetri Matrimony, Newar Matrimony, Gurung Matrimony, Rai Matrimony, Nepali Diaspora Australia, Nepali Matrimony USA, Nepali Matrimony UK">

    <!-- JSON-LD Structured Data for SEO -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'WebSite',
                '@id' => url('/') . '/#website',
                'url' => url('/'),
                'name' => 'MeroZodi Matrimony',
                'description' => "Nepal's Leading Matrimony & Matchmaking Platform",
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => 'MeroZodi',
                    'url' => url('/'),
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => asset('images/logo.png'),
                    ],
                ],
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => url('/browse') . '?searchQuery={search_term_string}',
                    'query-input' => 'required name=search_term_string',
                ],
            ],
            [
                '@type' => 'Organization',
                '@id' => url('/') . '/#organization',
                'name' => 'MeroZodi',
                'url' => url('/'),
                'logo' => asset('images/logo.png'),
                'sameAs' => [
                    'https://www.facebook.com/merozodi',
                    'https://www.instagram.com/merozodi',
                ],
                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'telephone' => '+977-1-4792000',
                    'contactType' => 'Customer Support',
                    'areaServed' => ['NP', 'AU', 'US', 'CA', 'GB', 'AE'],
                    'availableLanguage' => ['Nepali', 'English'],
                ],
                'aggregateRating' => [
                    '@type' => 'AggregateRating',
                    'ratingValue' => '4.9',
                    'reviewCount' => '12450',
                    'bestRating' => '5',
                    'worstRating' => '1',
                ],
            ],
            [
                '@type' => 'FAQPage',
                '@id' => url('/') . '/#faq',
                'mainEntity' => [
                    [
                        '@type' => 'Question',
                        'name' => 'How does MeroZodi verify member profiles?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Every registered member on MeroZodi can submit government-issued identification (Nepali Citizenship, Passport, or Driving License). Our compliance team manually audits each document to ensure 100% authenticity and award the trusted Green Verified badge.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        'name' => 'How does the 36 Gun Milan Kundali calculator work?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'MeroZodi computes authentic Vedic Ashtakoota compatibility across 8 sacred parameters: Varna, Vashya, Tara, Yoni, Graha Maitri, Gana, Bhakoot, and Nadi totaling 36 points, alongside Manglik Dosha analysis for traditional Nepali families.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        'name' => 'Is my photo and contact information private?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Yes. MeroZodi features a Photo Privacy Shield that blurs your photos until you approve viewing requests. Furthermore, members can communicate via in-app encrypted messages and 1-on-1 private video calls without revealing personal phone numbers.',
                        ],
                    ],
                    [
                        '@type' => 'Question',
                        'name' => 'Can Non-Resident Nepalis (NRIs) living abroad join MeroZodi?',
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => 'Absolutely. Thousands of Nepali singles in Australia, the United States, Canada, the United Kingdom, and the Middle East actively use MeroZodi to connect with compatible partners sharing their cultural values.',
                        ],
                    ],
                ],
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

<div>
    <!-- Parallax Hero Section with Matrimonial Search Widget -->
    <section class="relative bg-fixed bg-cover bg-center text-white overflow-hidden py-14 sm:py-20 lg:py-28" style="background-image: url('https://images.unsplash.com/photo-1519741497674-611481863552?w=1920&q=80');">
        <!-- Multi-Layer Deep Parallax Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-slate-950/95 via-slate-900/90 to-slate-950/95 backdrop-blur-[2px]"></div>
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#ec4899_1.5px,transparent_1.5px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-rose-500/25 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-indigo-500/25 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Hero Title & Subtitle -->
            <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
                <div class="inline-flex items-center gap-2 bg-rose-500/20 border border-rose-500/40 text-rose-300 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-4 shadow-sm backdrop-blur-md">
                    <i class="fa-solid fa-wand-magic-sparkles text-rose-400"></i> Nepal's #1 Matrimony & Matchmaking Platform
                </div>
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-tight drop-shadow-md">
                    Find Your Perfect Life Partner with <span class="bg-gradient-to-r from-rose-400 via-pink-300 to-amber-300 bg-clip-text text-transparent">Cultural Trust</span>
                </h1>
                <p class="mt-4 text-sm sm:text-base lg:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto drop-shadow-sm">
                    Connect with 100% ID-verified Nepali singles across Nepal, Australia, USA, UK, Canada, and 35+ countries. Authentic 36 Gun Milan, photo privacy shield, and secure video dating.
                </p>
            </div>

            <!-- Interactive Matrimonial Search Widget with Tabs -->
            <div class="max-w-4xl mx-auto bg-white/95 backdrop-blur-xl rounded-3xl p-5 sm:p-8 text-slate-800 shadow-2xl border border-white/30" x-data="{ mode: 'quick' }">
                
                <!-- Search Mode Tabs -->
                <div class="flex items-center gap-2 border-b border-slate-200/80 pb-3 mb-5">
                    <button type="button" @click="mode = 'quick'" :class="mode === 'quick' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100'" class="px-4 py-2 rounded-xl text-xs font-black transition flex items-center gap-2 tap-active">
                        <i class="fa-solid fa-magnifying-glass"></i> Quick Match Search
                    </button>
                    <button type="button" @click="mode = 'astrology'" :class="mode === 'astrology' ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100'" class="px-4 py-2 rounded-xl text-xs font-black transition flex items-center gap-2 tap-active">
                        <i class="fa-solid fa-moon text-amber-300"></i> Kundali & Milan Search
                    </button>
                </div>

                <form wire:submit="search">
                    <!-- Quick Mode Fields -->
                    <div x-show="mode === 'quick'" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 transition">
                        <!-- Looking for -->
                        <div>
                            <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5 flex items-center gap-1">
                                <i class="fa-solid fa-venus-mars text-rose-500"></i> Looking For
                            </label>
                            <select wire:model="lookingFor" class="select select-bordered select-sm sm:select-md w-full bg-slate-50 text-slate-800 font-bold focus:border-rose-500 rounded-xl text-xs sm:text-sm">
                                <option value="female">A Bride (Female)</option>
                                <option value="male">A Groom (Male)</option>
                            </select>
                        </div>

                        <!-- Religion -->
                        <div>
                            <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5 flex items-center gap-1">
                                <i class="fa-solid fa-om text-indigo-500"></i> Religion
                            </label>
                            <select wire:model="religion" class="select select-bordered select-sm sm:select-md w-full bg-slate-50 text-slate-800 font-bold focus:border-rose-500 rounded-xl text-xs sm:text-sm">
                                <option value="">All Religions</option>
                                @foreach($religions as $r)
                                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Caste -->
                        <div>
                            <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5 flex items-center gap-1">
                                <i class="fa-solid fa-users text-pink-500"></i> Caste / Community
                            </label>
                            <select wire:model="caste" class="select select-bordered select-sm sm:select-md w-full bg-slate-50 text-slate-800 font-bold focus:border-rose-500 rounded-xl text-xs sm:text-sm">
                                <option value="">All Castes</option>
                                @foreach($castes as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- City / Location -->
                        <div>
                            <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5 flex items-center gap-1">
                                <i class="fa-solid fa-location-dot text-emerald-500"></i> Location / City
                            </label>
                            <select wire:model="city" class="select select-bordered select-sm sm:select-md w-full bg-slate-50 text-slate-800 font-bold focus:border-rose-500 rounded-xl text-xs sm:text-sm">
                                <option value="">Any Location</option>
                                @foreach($cities as $ct)
                                    <option value="{{ $ct->name }}">{{ $ct->name }} ({{ $ct->country }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Astrology Mode Fields -->
                    <div x-show="mode === 'astrology'" x-cloak class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 transition">
                        <!-- Looking for -->
                        <div>
                            <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5 flex items-center gap-1">
                                <i class="fa-solid fa-venus-mars text-indigo-500"></i> Looking For
                            </label>
                            <select wire:model="lookingFor" class="select select-bordered select-sm sm:select-md w-full bg-slate-50 text-slate-800 font-bold focus:border-indigo-500 rounded-xl text-xs sm:text-sm">
                                <option value="female">A Bride (Female)</option>
                                <option value="male">A Groom (Male)</option>
                            </select>
                        </div>

                        <!-- Manglik Status -->
                        <div>
                            <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5 flex items-center gap-1">
                                <i class="fa-solid fa-fire text-amber-500"></i> Manglik Status
                            </label>
                            <select wire:model="manglik" class="select select-bordered select-sm sm:select-md w-full bg-slate-50 text-slate-800 font-bold focus:border-indigo-500 rounded-xl text-xs sm:text-sm">
                                <option value="">Any Status</option>
                                <option value="no">Non-Manglik</option>
                                <option value="yes">Manglik</option>
                            </select>
                        </div>

                        <!-- Keyword / Gotra / Rashi -->
                        <div>
                            <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5 flex items-center gap-1">
                                <i class="fa-solid fa-star-and-crescent text-purple-500"></i> Rashi / Gotra
                            </label>
                            <input type="text" wire:model="searchQuery" placeholder="e.g. Mesh, Kanya, Kashyap" class="input input-bordered input-sm sm:input-md w-full bg-slate-50 text-slate-800 font-bold focus:border-indigo-500 rounded-xl text-xs sm:text-sm">
                        </div>

                        <!-- Caste -->
                        <div>
                            <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5 flex items-center gap-1">
                                <i class="fa-solid fa-users text-pink-500"></i> Caste / Community
                            </label>
                            <select wire:model="caste" class="select select-bordered select-sm sm:select-md w-full bg-slate-50 text-slate-800 font-bold focus:border-indigo-500 rounded-xl text-xs sm:text-sm">
                                <option value="">All Castes</option>
                                @foreach($castes as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Age Range & Search Button -->
                    <div class="mt-5 flex flex-col sm:flex-row justify-between items-center gap-4 pt-4 border-t border-slate-100">
                        <div class="flex items-center gap-4 text-[11px] sm:text-xs text-slate-500 font-semibold">
                            <span class="flex items-center gap-1.5"><i class="fa-solid fa-id-card text-emerald-600"></i> Government ID Verified</span>
                            <span class="hidden md:flex items-center gap-1.5"><i class="fa-solid fa-shield-halved text-indigo-600"></i> Photo Privacy Shield</span>
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white font-black text-xs sm:text-sm rounded-xl sm:rounded-2xl shadow-lg shadow-rose-200 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 tap-active">
                            <i class="fa-solid fa-magnifying-glass"></i> Search Matches
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Key Stats Highlights -->
    <section class="bg-white py-6 sm:py-8 border-b border-slate-200/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 text-center">
                <div class="p-3 sm:p-4 rounded-2xl bg-slate-50/60 border border-slate-100">
                    <p class="text-2xl sm:text-4xl font-black text-rose-600">50,000+</p>
                    <p class="text-[10px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider mt-0.5 sm:mt-1">Verified Singles</p>
                </div>
                <div class="p-3 sm:p-4 rounded-2xl bg-slate-50/60 border border-slate-100">
                    <p class="text-2xl sm:text-4xl font-black text-indigo-600">12,000+</p>
                    <p class="text-[10px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider mt-0.5 sm:mt-1">Happy Couples</p>
                </div>
                <div class="p-3 sm:p-4 rounded-2xl bg-slate-50/60 border border-slate-100">
                    <p class="text-2xl sm:text-4xl font-black text-pink-600">35+ Countries</p>
                    <p class="text-[10px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider mt-0.5 sm:mt-1">Nepali Diaspora</p>
                </div>
                <div class="p-3 sm:p-4 rounded-2xl bg-slate-50/60 border border-slate-100">
                    <p class="text-2xl sm:text-4xl font-black text-emerald-600">100% Safe</p>
                    <p class="text-[10px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider mt-0.5 sm:mt-1">KYC Protected</p>
                </div>
            </div>
        </div>
    </section>



    <!-- Featured Verified Profiles (4 Columns Per Row) -->
    <section class="py-12 sm:py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-6 sm:mb-10">
                <div>
                    <h2 class="text-[10px] sm:text-xs font-black uppercase tracking-widest text-rose-600">Recently Active</h2>
                    <h3 class="text-xl sm:text-3xl font-black text-slate-900 mt-0.5">Featured Verified Matches</h3>
                </div>
                <a href="{{ route('browse') }}" class="text-xs sm:text-sm font-extrabold text-rose-600 hover:text-rose-700 flex items-center gap-1.5 tap-active shrink-0">
                    View All <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 sm:gap-6">
                @foreach($featuredProfiles as $profile)
                    <article class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-xs hover:shadow-xl transition-all duration-300 group flex flex-col justify-between">
                        <div>
                            <!-- Avatar Image with Badges -->
                            <div class="relative h-60 overflow-hidden bg-slate-100">
                                <img src="{{ $profile->avatar_url }}" alt="{{ $profile->name }} Matrimonial Profile" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>
                                
                                <div class="absolute top-3 left-3 flex gap-1.5">
                                    @if($profile->is_verified)
                                        <span class="bg-emerald-500 text-white text-[10px] font-black px-2.5 py-0.5 rounded-full shadow backdrop-blur-xs flex items-center gap-1">
                                            <i class="fa-solid fa-circle-check text-[10px]"></i> Verified
                                        </span>
                                    @endif
                                    @if($profile->is_premium)
                                        <span class="bg-amber-500 text-slate-950 text-[10px] font-black px-2.5 py-0.5 rounded-full shadow backdrop-blur-xs flex items-center gap-1">
                                            <i class="fa-solid fa-crown text-[10px]"></i> VIP
                                        </span>
                                    @endif
                                </div>

                                <!-- Top Right Status Badge -->
                                <div class="absolute top-3 right-3 flex items-center gap-1.5">
                                    @if($profile->isOnline())
                                        <span class="bg-black/60 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full border border-emerald-500/40 shadow-sm flex items-center gap-1.5" title="Online Now">
                                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 ring-2 ring-white animate-pulse"></span>
                                            <span class="text-emerald-300 font-bold">Online</span>
                                        </span>
                                    @else
                                        <span class="bg-black/60 backdrop-blur-md text-slate-300 text-[10px] font-medium px-2.5 py-0.5 rounded-full border border-white/10 shadow-sm flex items-center gap-1.5" title="Offline">
                                            <span class="w-2.5 h-2.5 rounded-full bg-slate-400 ring-2 ring-white"></span>
                                            <span>Offline</span>
                                        </span>
                                    @endif
                                </div>

                                <div class="absolute bottom-3 left-3.5 right-3.5 text-white">
                                    <h4 class="text-base font-black truncate">{{ $profile->name }}, {{ $profile->age }}</h4>
                                    <p class="text-xs text-slate-300 truncate">
                                        <i class="fa-solid fa-location-dot text-rose-400 mr-1"></i> {{ $profile->profile->living_city ?? 'Kathmandu' }}, {{ $profile->profile->living_country ?? 'Nepal' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Details list -->
                            <div class="p-3.5 sm:p-4 space-y-2 text-xs text-slate-600">
                                <div class="flex items-center justify-between pb-1.5 border-b border-slate-100">
                                    <span class="text-slate-400 font-medium shrink-0">Community:</span>
                                    <span class="font-bold text-slate-800 truncate text-right ml-2">{{ $profile->profile->caste->name ?? 'Nepali' }} ({{ $profile->profile->religion->name ?? 'Hindu' }})</span>
                                </div>
                                <div class="flex items-center justify-between pb-1.5 border-b border-slate-100">
                                    <span class="text-slate-400 font-medium shrink-0">Profession:</span>
                                    <span class="font-bold text-slate-800 truncate text-right ml-2">{{ $profile->education->designation ?? 'Professional' }}</span>
                                </div>
                                <div class="flex items-center justify-between pb-1.5 border-b border-slate-100">
                                    <span class="text-slate-400 font-medium shrink-0">Education:</span>
                                    <span class="font-bold text-slate-800 truncate text-right ml-2">{{ $profile->education->educationLevel->name ?? "Bachelor's Degree" }}</span>
                                </div>
                                @if($profile->profile && $profile->profile->rashi)
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-400 font-medium shrink-0">Astrology (Rashi):</span>
                                        <span class="font-bold text-indigo-700 bg-indigo-50 px-2 py-0.5 rounded text-[11px] truncate text-right ml-2">{{ $profile->profile->rashi }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Action buttons -->
                        <div class="p-3.5 sm:p-4 pt-0">
                            <a href="{{ route('profile.show', $profile->id) }}" class="w-full py-2.5 bg-slate-900 hover:bg-rose-600 text-white font-black text-xs rounded-xl transition flex items-center justify-center gap-2 tap-active shadow-xs">
                                <i class="fa-solid fa-heart text-xs text-rose-400"></i> View Full Profile & Connect
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How MeroZodi Works (3 Simple Steps) -->
    <section class="py-12 sm:py-20 bg-white border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-16">
                <h2 class="text-[10px] sm:text-xs font-black uppercase tracking-widest text-rose-600">Simple & Trustworthy</h2>
                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 mt-1">How MeroZodi Works in 3 Steps</h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-2">Designed specifically for Nepali singles and families seeking meaningful lifelong relationships.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-10 relative">
                <!-- Step 1 -->
                <div class="relative bg-slate-50 rounded-3xl p-6 sm:p-8 border border-slate-200/80 hover:border-rose-200 hover:shadow-lg transition group">
                    <div class="w-14 h-14 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center text-2xl font-black mb-6 group-hover:scale-110 transition duration-300 shadow-xs">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                    <span class="text-xs font-black text-rose-600 uppercase tracking-wider">Step 01</span>
                    <h4 class="text-lg font-black text-slate-900 mt-1 mb-2">Create & Verify Your Profile</h4>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Register your matrimonial profile, set preferences, and submit government ID/Citizenship to earn the trusted Green Verified badge.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="relative bg-slate-50 rounded-3xl p-6 sm:p-8 border border-slate-200/80 hover:border-indigo-200 hover:shadow-lg transition group">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-2xl font-black mb-6 group-hover:scale-110 transition duration-300 shadow-xs">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <span class="text-xs font-black text-indigo-600 uppercase tracking-wider">Step 02</span>
                    <h4 class="text-lg font-black text-slate-900 mt-1 mb-2">Discover Compatible Matches</h4>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Filter by caste, education, diaspora country, and compute instant 36 Gun Milan astrological compatibility with Vedic accuracy.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="relative bg-slate-50 rounded-3xl p-6 sm:p-8 border border-slate-200/80 hover:border-pink-200 hover:shadow-lg transition group">
                    <div class="w-14 h-14 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center text-2xl font-black mb-6 group-hover:scale-110 transition duration-300 shadow-xs">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <span class="text-xs font-black text-pink-600 uppercase tracking-wider">Step 03</span>
                    <h4 class="text-lg font-black text-slate-900 mt-1 mb-2">Connect & Video Date</h4>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Send connect requests, converse in encrypted private chat, and meet face-to-face via secure in-app video calls without exposing phone numbers.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Parallax Feature Spotlight: Vedic Kundali & 36 Gun Milan -->
    <section class="relative bg-fixed bg-cover bg-center text-white py-16 sm:py-24 overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1534447677768-be436bb09401?w=1920&q=80');">
        <!-- Parallax Deep Rose & Slate Luxury Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/96 via-rose-950/85 to-slate-950/96 backdrop-blur-[2px]"></div>
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#f43f5e_1.5px,transparent_1.5px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-rose-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                <div class="lg:col-span-7 space-y-4 sm:space-y-6">
                    <div class="inline-flex items-center gap-2 bg-rose-500/20 border border-rose-400/30 text-rose-200 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm backdrop-blur-md">
                        <i class="fa-solid fa-moon text-amber-300"></i> Traditional Astrological Harmony
                    </div>
                    <h3 class="text-2xl sm:text-4xl lg:text-5xl font-black leading-tight drop-shadow-md">
                        36 Gun Milan & Kundali Compatibility for <span class="bg-gradient-to-r from-rose-300 via-pink-200 to-amber-200 bg-clip-text text-transparent">Nepali Marriages</span>
                    </h3>
                    <p class="text-xs sm:text-base text-slate-300 leading-relaxed max-w-xl drop-shadow-sm">
                        Honor centuries-old Nepali wedding traditions with our authentic Ashtakoota Gun Milan engine. Calculate compatibility across Varna, Vashya, Tara, Yoni, Graha Maitri, Gana, Bhakoot, and Nadi with instant Manglik Dosha screening.
                    </p>
                    <div class="flex flex-wrap gap-2.5 sm:gap-3 text-xs font-bold text-white">
                        <span class="bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/15 backdrop-blur-md shadow-xs flex items-center"><i class="fa-solid fa-circle-check text-rose-400 mr-1.5"></i> Rashi Compatibility</span>
                        <span class="bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/15 backdrop-blur-md shadow-xs flex items-center"><i class="fa-solid fa-circle-check text-rose-400 mr-1.5"></i> Manglik Dosha Audit</span>
                        <span class="bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/15 backdrop-blur-md shadow-xs flex items-center"><i class="fa-solid fa-circle-check text-rose-400 mr-1.5"></i> Gotra Alignment</span>
                        <span class="bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/15 backdrop-blur-md shadow-xs flex items-center"><i class="fa-solid fa-circle-check text-rose-400 mr-1.5"></i> Ashtakoota Analysis</span>
                    </div>
                    <div class="pt-2 flex flex-col sm:flex-row gap-3 sm:gap-4">
                        <a href="{{ route('browse') }}" class="px-7 py-3.5 bg-gradient-to-r from-rose-600 via-pink-600 to-rose-600 hover:from-rose-700 hover:to-pink-700 text-white font-black text-xs sm:text-sm rounded-2xl shadow-xl shadow-rose-950/50 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 tap-active">
                            <i class="fa-solid fa-wand-magic-sparkles text-amber-300"></i> Explore Astrological Matches
                        </a>
                        <a href="{{ route('blog.detail', 'kundali-matching-gun-milan-modern-nepali-marriages') }}" class="px-6 py-3.5 bg-white/10 hover:bg-white/20 text-white font-bold text-xs sm:text-sm rounded-2xl border border-white/20 backdrop-blur-md transition flex items-center justify-center gap-2 tap-active">
                            <i class="fa-solid fa-book-open text-rose-300"></i> Gun Milan Guide
                        </a>
                    </div>
                </div>

                <!-- Glassmorphic Astrological Scorecard Mockup -->
                <div class="lg:col-span-5">
                    <div class="bg-white/10 backdrop-blur-2xl rounded-3xl p-6 sm:p-7 border border-white/20 shadow-2xl text-white relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 w-36 h-36 bg-rose-500/20 rounded-full blur-2xl pointer-events-none"></div>

                        <div class="flex items-center justify-between border-b border-white/15 pb-4 mb-4 relative z-10">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-2xl bg-rose-500/20 text-amber-300 border border-rose-400/30 flex items-center justify-center font-black text-lg shadow-inner">
                                    <i class="fa-solid fa-star-and-crescent"></i>
                                </div>
                                <div>
                                    <h4 class="font-black text-sm text-white">Milan Score Preview</h4>
                                    <p class="text-[11px] text-slate-300">Vedic Ashtakoota Milan</p>
                                </div>
                            </div>
                            <span class="bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-[10px] font-black px-3 py-1 rounded-full flex items-center gap-1.5 shadow-xs">
                                <i class="fa-solid fa-circle-check text-[10px]"></i> Utkrishta Milan
                            </span>
                        </div>

                        <!-- Score Ring Meter -->
                        <div class="text-center py-4 px-4 bg-white/10 backdrop-blur-md rounded-2xl border border-white/15 mb-4 shadow-inner relative z-10">
                            <span class="text-4xl sm:text-5xl font-black bg-gradient-to-r from-amber-200 via-rose-200 to-white bg-clip-text text-transparent">32</span> <span class="text-base sm:text-lg text-slate-300 font-bold">/ 36</span>
                            <p class="text-xs font-black text-emerald-400 mt-1 flex items-center justify-center gap-1.5">
                                <i class="fa-solid fa-wand-magic-sparkles text-[10px]"></i> Excellent Compatibility (88.8%)
                            </p>
                        </div>

                        <!-- Gun breakdown pills -->
                        <div class="grid grid-cols-2 gap-2.5 text-[11px] relative z-10">
                            <div class="bg-white/10 p-2.5 rounded-xl flex justify-between items-center border border-white/10 backdrop-blur-sm">
                                <span class="text-slate-300 font-medium">Nadi (Health):</span>
                                <span class="font-black text-emerald-400 bg-emerald-500/15 px-2 py-0.5 rounded-md text-[11px]">8 / 8</span>
                            </div>
                            <div class="bg-white/10 p-2.5 rounded-xl flex justify-between items-center border border-white/10 backdrop-blur-sm">
                                <span class="text-slate-300 font-medium">Bhakoot (Love):</span>
                                <span class="font-black text-emerald-400 bg-emerald-500/15 px-2 py-0.5 rounded-md text-[11px]">7 / 7</span>
                            </div>
                            <div class="bg-white/10 p-2.5 rounded-xl flex justify-between items-center border border-white/10 backdrop-blur-sm">
                                <span class="text-slate-300 font-medium">Gana (Temper):</span>
                                <span class="font-black text-emerald-400 bg-emerald-500/15 px-2 py-0.5 rounded-md text-[11px]">6 / 6</span>
                            </div>
                            <div class="bg-white/10 p-2.5 rounded-xl flex justify-between items-center border border-white/10 backdrop-blur-sm">
                                <span class="text-slate-300 font-medium">Graha Maitri:</span>
                                <span class="font-black text-amber-300 bg-amber-500/15 px-2 py-0.5 rounded-md text-[11px]">4 / 5</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Explore Matches by Community & Diaspora -->
    <section class="py-14 sm:py-20 bg-slate-50 border-b border-slate-200/80" x-data="{ activeExploreTab: 'caste' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-4xl mx-auto mb-8 sm:mb-12">
                <div class="inline-flex items-center gap-1.5 bg-rose-50 border border-rose-200/60 text-rose-600 px-3.5 py-1 rounded-full text-[11px] font-black uppercase tracking-widest mb-2 shadow-2xs">
                    <i class="fa-solid fa-wand-magic-sparkles text-rose-500"></i> Tailored Matchmaking
                </div>
                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 mt-1 md:whitespace-nowrap">Explore Matches by Community & Diaspora</h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-2 max-w-2xl mx-auto">Connect with verified Nepali singles based on caste heritage, international residence, or profession.</p>
            </div>

            <!-- Modern Interactive Tabs -->
            <div class="flex justify-center mb-8 sm:mb-10 overflow-x-auto no-scrollbar pb-1">
                <div class="inline-flex p-1.5 bg-white rounded-2xl shadow-xs border border-slate-200/80 gap-1.5">
                    <button type="button" @click="activeExploreTab = 'caste'" :class="activeExploreTab === 'caste' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100'" class="px-4 py-2.5 rounded-xl text-xs font-black transition flex items-center gap-2 tap-active shrink-0">
                        <i class="fa-solid fa-users text-rose-400"></i>
                        <span>Caste & Community</span>
                    </button>
                    <button type="button" @click="activeExploreTab = 'diaspora'" :class="activeExploreTab === 'diaspora' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100'" class="px-4 py-2.5 rounded-xl text-xs font-black transition flex items-center gap-2 tap-active shrink-0">
                        <i class="fa-solid fa-earth-asia text-indigo-400"></i>
                        <span>Global Diaspora Hubs</span>
                    </button>
                    <button type="button" @click="activeExploreTab = 'profession'" :class="activeExploreTab === 'profession' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100'" class="px-4 py-2.5 rounded-xl text-xs font-black transition flex items-center gap-2 tap-active shrink-0">
                        <i class="fa-solid fa-briefcase text-amber-400"></i>
                        <span>By Profession</span>
                    </button>
                    <button type="button" @click="activeExploreTab = 'religion'" :class="activeExploreTab === 'religion' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100'" class="px-4 py-2.5 rounded-xl text-xs font-black transition flex items-center gap-2 tap-active shrink-0">
                        <i class="fa-solid fa-om text-purple-400"></i>
                        <span>By Religion</span>
                    </button>
                </div>
            </div>

            <!-- Tab 1: Caste & Community Grid -->
            <div x-show="activeExploreTab === 'caste'" class="transition-all duration-300">
                @php
                    $castesList = [
                        ['name' => 'Brahmin', 'icon' => 'fa-om', 'bg' => 'bg-rose-50 text-rose-600', 'count' => '12,500+'],
                        ['name' => 'Chhetri', 'icon' => 'fa-shield-halved', 'bg' => 'bg-indigo-50 text-indigo-600', 'count' => '14,200+'],
                        ['name' => 'Newar', 'icon' => 'fa-monument', 'bg' => 'bg-amber-50 text-amber-600', 'count' => '8,900+'],
                        ['name' => 'Gurung', 'icon' => 'fa-mountain-sun', 'bg' => 'bg-emerald-50 text-emerald-600', 'count' => '6,400+'],
                        ['name' => 'Magar', 'icon' => 'fa-feather-pointed', 'bg' => 'bg-pink-50 text-pink-600', 'count' => '7,100+'],
                        ['name' => 'Rai', 'icon' => 'fa-sun', 'bg' => 'bg-orange-50 text-orange-600', 'count' => '5,300+'],
                        ['name' => 'Tamang', 'icon' => 'fa-dharmachakra', 'bg' => 'bg-cyan-50 text-cyan-600', 'count' => '6,800+'],
                        ['name' => 'Tharu', 'icon' => 'fa-seedling', 'bg' => 'bg-teal-50 text-teal-600', 'count' => '4,200+'],
                        ['name' => 'Marwadi', 'icon' => 'fa-gem', 'bg' => 'bg-purple-50 text-purple-600', 'count' => '3,100+'],
                        ['name' => 'Yadav', 'icon' => 'fa-landmark', 'bg' => 'bg-blue-50 text-blue-600', 'count' => '3,800+'],
                        ['name' => 'Sherpa', 'icon' => 'fa-mountain', 'bg' => 'bg-sky-50 text-sky-600', 'count' => '2,400+'],
                        ['name' => 'Thakuri', 'icon' => 'fa-crown', 'bg' => 'bg-rose-50 text-rose-600', 'count' => '2,900+'],
                    ];
                @endphp
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5">
                    @foreach($castesList as $caste)
                        <a href="{{ route('browse') }}?searchQuery={{ urlencode($caste['name']) }}" class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 hover:border-rose-300 shadow-xs hover:shadow-md transition-all duration-300 group flex items-center justify-between tap-active">
                            <div class="flex items-center gap-3.5">
                                <div class="w-11 h-11 rounded-xl {{ $caste['bg'] }} flex items-center justify-center text-lg font-bold group-hover:scale-110 transition duration-300">
                                    <i class="fa-solid {{ $caste['icon'] }}"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-black text-slate-800 group-hover:text-rose-600 transition">{{ $caste['name'] }} Matrimony</h4>
                                    <span class="text-[11px] text-slate-400 font-semibold">{{ $caste['count'] }} Profiles</span>
                                </div>
                            </div>
                            <div class="w-7 h-7 rounded-full bg-slate-50 group-hover:bg-rose-600 group-hover:text-white flex items-center justify-center text-slate-400 text-xs transition duration-300">
                                <i class="fa-solid fa-arrow-right"></i>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Tab 2: Global Diaspora Hubs Grid -->
            <div x-show="activeExploreTab === 'diaspora'" x-cloak class="transition-all duration-300">
                @php
                    $diasporaHubs = [
                        [
                            'country' => 'Nepal',
                            'code' => 'np',
                            'cities' => 'Kathmandu, Pokhara, Chitwan, Lalitpur',
                            'count' => '28,000+ Singles',
                            'flag' => 'https://flagcdn.com/w80/np.png',
                            'param' => 'city=Kathmandu'
                        ],
                        [
                            'country' => 'Australia',
                            'code' => 'au',
                            'cities' => 'Sydney, Melbourne, Brisbane, Perth',
                            'count' => '6,500+ Singles',
                            'flag' => 'https://flagcdn.com/w80/au.png',
                            'param' => 'city=Sydney'
                        ],
                        [
                            'country' => 'United States',
                            'code' => 'us',
                            'cities' => 'Dallas, New York, California, Texas',
                            'count' => '5,800+ Singles',
                            'flag' => 'https://flagcdn.com/w80/us.png',
                            'param' => 'city=Dallas'
                        ],
                        [
                            'country' => 'Canada',
                            'code' => 'ca',
                            'cities' => 'Toronto, Calgary, Vancouver, Edmonton',
                            'count' => '3,900+ Singles',
                            'flag' => 'https://flagcdn.com/w80/ca.png',
                            'param' => 'city=Toronto'
                        ],
                        [
                            'country' => 'United Kingdom',
                            'code' => 'gb',
                            'cities' => 'London, Aldershot, Reading, Manchester',
                            'count' => '3,200+ Singles',
                            'flag' => 'https://flagcdn.com/w80/gb.png',
                            'param' => 'city=London'
                        ],
                        [
                            'country' => 'UAE & Middle East',
                            'code' => 'ae',
                            'cities' => 'Dubai, Abu Dhabi, Doha, Kuwait',
                            'count' => '2,800+ Singles',
                            'flag' => 'https://flagcdn.com/w80/ae.png',
                            'param' => 'city=Dubai'
                        ],
                        [
                            'country' => 'Japan',
                            'code' => 'jp',
                            'cities' => 'Tokyo, Osaka, Nagoya, Fukuoka',
                            'count' => '1,900+ Singles',
                            'flag' => 'https://flagcdn.com/w80/jp.png',
                            'param' => 'searchQuery=Japan'
                        ],
                        [
                            'country' => 'Europe',
                            'code' => 'eu',
                            'cities' => 'Germany, Finland, Poland, Portugal',
                            'count' => '1,400+ Singles',
                            'flag' => 'https://flagcdn.com/w80/eu.png',
                            'param' => 'searchQuery=Europe'
                        ],
                    ];
                @endphp
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5">
                    @foreach($diasporaHubs as $hub)
                        <a href="{{ route('browse') }}?{{ $hub['param'] }}" class="bg-white p-5 rounded-2xl border border-slate-200/80 hover:border-indigo-300 shadow-xs hover:shadow-md transition-all duration-300 group flex flex-col justify-between tap-active">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $hub['flag'] }}" alt="{{ $hub['country'] }} Flag" class="w-8 h-8 rounded-full object-cover border border-slate-200 shadow-2xs">
                                    <div>
                                        <h4 class="text-sm font-black text-slate-900 group-hover:text-indigo-600 transition">{{ $hub['country'] }}</h4>
                                        <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">{{ $hub['count'] }}</span>
                                    </div>
                                </div>
                                <div class="w-6 h-6 rounded-full bg-slate-50 group-hover:bg-indigo-600 group-hover:text-white flex items-center justify-center text-slate-400 text-xs transition duration-300">
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </div>
                            </div>
                            <p class="text-xs text-slate-500 line-clamp-1 border-t border-slate-100 pt-2.5">
                                <i class="fa-solid fa-location-dot text-rose-500 mr-1 text-[11px]"></i> {{ $hub['cities'] }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Tab 3: Profession Grid -->
            <div x-show="activeExploreTab === 'profession'" x-cloak class="transition-all duration-300">
                @php
                    $professions = [
                        ['title' => 'Software & IT Engineers', 'icon' => 'fa-laptop-code', 'bg' => 'bg-indigo-50 text-indigo-600', 'desc' => 'Developers, Architects & Data Scientists', 'count' => '8,200+'],
                        ['title' => 'Doctors & Healthcare', 'icon' => 'fa-user-doctor', 'bg' => 'bg-rose-50 text-rose-600', 'desc' => 'Physicians, Surgeons, Dentists & Pharma', 'count' => '4,500+'],
                        ['title' => 'Chartered Accountants & Finance', 'icon' => 'fa-chart-pie', 'bg' => 'bg-emerald-50 text-emerald-600', 'desc' => 'CA, ACCA, Bankers & Financial Analysts', 'count' => '3,600+'],
                        ['title' => 'Civil Services & Public Bureau', 'icon' => 'fa-building-columns', 'bg' => 'bg-amber-50 text-amber-600', 'desc' => 'Government Officers, Diplomats & Law', 'count' => '2,100+'],
                        ['title' => 'Engineers & Architects', 'icon' => 'fa-compass-drafting', 'bg' => 'bg-cyan-50 text-cyan-600', 'desc' => 'Civil, Mechanical & Structural Specialists', 'count' => '5,400+'],
                        ['title' => 'Registered Nurses & Medics', 'icon' => 'fa-notes-medical', 'bg' => 'bg-pink-50 text-pink-600', 'desc' => 'Hospital Nurses & Allied Health Staff', 'count' => '4,800+'],
                        ['title' => 'Business Owners & Founders', 'icon' => 'fa-briefcase', 'bg' => 'bg-purple-50 text-purple-600', 'desc' => 'Entrepreneurs, Exporters & Traders', 'count' => '3,100+'],
                        ['title' => 'Professors & Academics', 'icon' => 'fa-graduation-cap', 'bg' => 'bg-teal-50 text-teal-600', 'desc' => 'University Lecturers, Educators & Researchers', 'count' => '2,300+'],
                    ];
                @endphp
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5">
                    @foreach($professions as $prof)
                        <a href="{{ route('browse') }}?searchQuery={{ urlencode($prof['title']) }}" class="bg-white p-5 rounded-2xl border border-slate-200/80 hover:border-amber-300 shadow-xs hover:shadow-md transition-all duration-300 group flex flex-col justify-between tap-active">
                            <div class="flex items-start gap-3.5 mb-2">
                                <div class="w-11 h-11 rounded-xl {{ $prof['bg'] }} flex items-center justify-center text-lg font-bold shrink-0 group-hover:scale-110 transition duration-300">
                                    <i class="fa-solid {{ $prof['icon'] }}"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-black text-slate-900 group-hover:text-amber-600 transition leading-snug">{{ $prof['title'] }}</h4>
                                    <span class="text-[11px] font-bold text-slate-400">{{ $prof['count'] }} Profiles</span>
                                </div>
                            </div>
                            <p class="text-xs text-slate-500 line-clamp-1 border-t border-slate-100 pt-2.5">
                                {{ $prof['desc'] }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Tab 4: Religion Grid -->
            <div x-show="activeExploreTab === 'religion'" x-cloak class="transition-all duration-300">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
                    <a href="{{ route('browse') }}?searchQuery=Hindu" class="bg-white p-6 rounded-3xl border border-slate-200/80 hover:border-purple-300 shadow-xs hover:shadow-lg transition group text-center space-y-3 tap-active">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition duration-300">
                            <i class="fa-solid fa-om"></i>
                        </div>
                        <h4 class="text-base font-black text-slate-900 group-hover:text-purple-600 transition">Hindu Matrimony</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Vedic Kundali Milan, 36 Gun matching, Manglik dosha audit and Gotra alignment.</p>
                        <span class="inline-block text-xs font-black text-purple-600 group-hover:underline">Browse Hindu Singles <i class="fa-solid fa-arrow-right text-[10px]"></i></span>
                    </a>

                    <a href="{{ route('browse') }}?searchQuery=Buddhist" class="bg-white p-6 rounded-3xl border border-slate-200/80 hover:border-amber-300 shadow-xs hover:shadow-lg transition group text-center space-y-3 tap-active">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition duration-300">
                            <i class="fa-solid fa-dharmachakra"></i>
                        </div>
                        <h4 class="text-base font-black text-slate-900 group-hover:text-amber-600 transition">Buddhist Matrimony</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Newar, Tamang, Gurung, Sherpa Buddhist traditions and spiritual harmony.</p>
                        <span class="inline-block text-xs font-black text-amber-600 group-hover:underline">Browse Buddhist Singles <i class="fa-solid fa-arrow-right text-[10px]"></i></span>
                    </a>

                    <a href="{{ route('browse') }}?searchQuery=Kirat" class="bg-white p-6 rounded-3xl border border-slate-200/80 hover:border-emerald-300 shadow-xs hover:shadow-lg transition group text-center space-y-3 tap-active">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition duration-300">
                            <i class="fa-solid fa-sun"></i>
                        </div>
                        <h4 class="text-base font-black text-slate-900 group-hover:text-emerald-600 transition">Kirat Matrimony</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Rai, Limbu, Yakkha, Sunuwar cultural harmony and Mundhum traditions.</p>
                        <span class="inline-block text-xs font-black text-emerald-600 group-hover:underline">Browse Kirat Singles <i class="fa-solid fa-arrow-right text-[10px]"></i></span>
                    </a>

                    <a href="{{ route('browse') }}?searchQuery=Christian" class="bg-white p-6 rounded-3xl border border-slate-200/80 hover:border-rose-300 shadow-xs hover:shadow-lg transition group text-center space-y-3 tap-active">
                        <div class="w-14 h-14 mx-auto rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition duration-300">
                            <i class="fa-solid fa-cross"></i>
                        </div>
                        <h4 class="text-base font-black text-slate-900 group-hover:text-rose-600 transition">Christian & Others</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Church fellowship, mutual faith alignment, and Christian wedding ceremonies.</p>
                        <span class="inline-block text-xs font-black text-rose-600 group-hover:underline">Browse Faith Singles <i class="fa-solid fa-arrow-right text-[10px]"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose MeroZodi & Safety Pillars (Parallax Trust Section) -->
    <section class="relative bg-fixed bg-cover bg-center text-white py-16 sm:py-24 overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=1920&q=80');">
        <!-- Parallax Dark Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-slate-950/95 via-slate-900/90 to-slate-950/95 backdrop-blur-[2px]"></div>
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#ec4899_1.5px,transparent_1.5px)] [background-size:24px_24px] pointer-events-none"></div>
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-rose-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-16">
                <div class="inline-flex items-center gap-2 bg-rose-500/20 border border-rose-500/40 text-rose-300 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-3 shadow-sm backdrop-blur-md">
                    <i class="fa-solid fa-shield-halved text-rose-400"></i> Built for Nepal & Global Diaspora
                </div>
                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white mt-1 drop-shadow-md">Why Singles & Families Trust MeroZodi</h3>
                <p class="text-xs sm:text-sm text-slate-300 mt-2 leading-relaxed">Industry-grade security, manual KYC audits, and respectful cultural matchmaking.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="p-6 sm:p-7 rounded-3xl bg-white/95 backdrop-blur-xl border border-white/30 shadow-xl hover:shadow-2xl hover:-translate-y-1 transition duration-300 space-y-3.5 group">
                    <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center text-xl font-bold group-hover:scale-110 transition duration-300 shadow-xs">
                        <i class="fa-solid fa-id-card-clip"></i>
                    </div>
                    <h4 class="text-base font-black text-slate-900 group-hover:text-rose-600 transition">National ID & KYC Verification</h4>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Every profile undergoes citizenship and passport screening to eliminate fake accounts and guarantee trusted connections.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="p-6 sm:p-7 rounded-3xl bg-white/95 backdrop-blur-xl border border-white/30 shadow-xl hover:shadow-2xl hover:-translate-y-1 transition duration-300 space-y-3.5 group">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-xl font-bold group-hover:scale-110 transition duration-300 shadow-xs">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h4 class="text-base font-black text-slate-900 group-hover:text-indigo-600 transition">Photo Privacy Shield</h4>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Keep your photos private with blur protection and grant viewing permission only to prospective matches you approve.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="p-6 sm:p-7 rounded-3xl bg-white/95 backdrop-blur-xl border border-white/30 shadow-xl hover:shadow-2xl hover:-translate-y-1 transition duration-300 space-y-3.5 group">
                    <div class="w-12 h-12 rounded-2xl bg-pink-100 text-pink-600 flex items-center justify-center text-xl font-bold group-hover:scale-110 transition duration-300 shadow-xs">
                        <i class="fa-solid fa-video"></i>
                    </div>
                    <h4 class="text-base font-black text-slate-900 group-hover:text-pink-600 transition">1-on-1 Encrypted Video Dates</h4>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Meet virtually in secure private video rooms without sharing personal phone numbers, ideal for cross-border NRI dating.
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="p-6 sm:p-7 rounded-3xl bg-white/95 backdrop-blur-xl border border-white/30 shadow-xl hover:shadow-2xl hover:-translate-y-1 transition duration-300 space-y-3.5 group">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl font-bold group-hover:scale-110 transition duration-300 shadow-xs">
                        <i class="fa-solid fa-crown"></i>
                    </div>
                    <h4 class="text-base font-black text-slate-900 group-hover:text-amber-600 transition">Dedicated VIP Matchmakers</h4>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Get personalized assistance from seasoned matrimonial consultants who handpick matches for busy executives and families.
                    </p>
                </div>
            </div>
        </div>
    </section>



    <!-- Latest Matrimony Guides & Relationship Advice -->
    @if(count($latestBlogs) > 0)
        <section class="py-12 sm:py-16 bg-slate-50 border-t border-slate-200/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-8 sm:mb-12">
                    <div>
                        <h2 class="text-[10px] sm:text-xs font-black uppercase tracking-widest text-rose-600">Matrimony Insights</h2>
                        <h3 class="text-xl sm:text-3xl font-black text-slate-900 mt-0.5">Nepali Relationship & Marriage Guides</h3>
                    </div>
                    <a href="{{ route('blog') }}" class="text-xs sm:text-sm font-extrabold text-rose-600 hover:text-rose-700 flex items-center gap-1.5 tap-active shrink-0">
                        View All Articles <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($latestBlogs as $blog)
                        <article class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-xs hover:shadow-lg transition group flex flex-col justify-between">
                            <div>
                                <div class="relative h-48 overflow-hidden bg-slate-100">
                                    <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" loading="lazy" decoding="async" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1519741497674-611481863552?w=800&fit=crop';" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                </div>
                                <div class="p-5 space-y-2">
                                    <span class="text-[10px] font-black uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2.5 py-0.5 rounded-full">
                                        {{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Recent' }}
                                    </span>
                                    <h4 class="text-base font-black text-slate-900 group-hover:text-rose-600 transition leading-snug line-clamp-2">
                                        <a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->title }}</a>
                                    </h4>
                                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">
                                        {{ $blog->summary }}
                                    </p>
                                </div>
                            </div>
                            <div class="p-5 pt-0">
                                <a href="{{ route('blog.detail', $blog->slug) }}" class="text-xs font-black text-rose-600 hover:text-rose-700 flex items-center gap-1 tap-active">
                                    Read Full Article <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Parallax High-Converting CTA Banner -->
    <section class="relative bg-fixed bg-cover bg-center text-white py-16 sm:py-24 overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=1920&q=80');">
        <!-- Parallax Rose & Slate Luxury Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-rose-950/95 via-slate-950/90 to-indigo-950/95 backdrop-blur-[2px]"></div>
        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(#ec4899_1.5px,transparent_1.5px)] [background-size:20px_20px] pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-6">
            <div class="inline-flex items-center gap-2 bg-rose-500/20 border border-rose-500/40 text-rose-300 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm backdrop-blur-md">
                <i class="fa-solid fa-heart-pulse"></i> Begin Your Happily Ever After
            </div>
            <h2 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight drop-shadow-md">
                Your Soulmate is Just a Click Away
            </h2>
            <p class="text-sm sm:text-base text-slate-300 max-w-2xl mx-auto leading-relaxed drop-shadow-sm">
                Join over 50,000+ verified Nepali singles across Kathmandu, Sydney, Dallas, London, Toronto, and worldwide. Create your free matrimony profile today.
            </p>
            <div class="pt-4 flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-9 py-4 bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white font-black text-sm rounded-2xl shadow-xl shadow-rose-950 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 tap-active">
                    <i class="fa-solid fa-user-plus"></i> Register Free Today
                </a>
                <a href="{{ route('browse') }}" class="w-full sm:w-auto px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-bold text-sm rounded-2xl border border-white/20 backdrop-blur-md transition flex items-center justify-center gap-2 tap-active">
                    <i class="fa-solid fa-compass"></i> Browse Verified Matches
                </a>
            </div>
            <div class="pt-6 flex flex-wrap justify-center items-center gap-6 text-xs text-slate-400">
                <span class="flex items-center gap-1.5"><i class="fa-solid fa-circle-check text-emerald-400"></i> Free Registration</span>
                <span class="flex items-center gap-1.5"><i class="fa-solid fa-shield-halved text-emerald-400"></i> 100% Privacy Control</span>
                <span class="flex items-center gap-1.5"><i class="fa-solid fa-id-card text-emerald-400"></i> KYC ID Verified Members</span>
            </div>
        </div>
    </section>

    <!-- Frequently Asked Questions (SEO Rich Accordion) -->
    <section class="py-14 sm:py-20 bg-white border-t border-slate-200/80" x-data="{ activeFaq: 1 }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-14">
                <h2 class="text-[10px] sm:text-xs font-black uppercase tracking-widest text-rose-600">Got Questions?</h2>
                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 mt-1">Frequently Asked Questions</h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-2">Everything you need to know about Nepali matrimonial verification, Gun Milan, and privacy protection.</p>
            </div>

            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="border border-slate-200/80 rounded-2xl overflow-hidden transition" :class="activeFaq === 1 ? 'bg-slate-50/80 border-rose-200 shadow-sm' : 'bg-white'">
                    <button type="button" @click="activeFaq = (activeFaq === 1 ? null : 1)" class="w-full px-6 py-4 text-left font-black text-sm text-slate-900 flex justify-between items-center gap-4 tap-active">
                        <span>How does MeroZodi verify member profiles?</span>
                        <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition transform duration-300" :class="activeFaq === 1 ? 'rotate-180 text-rose-600' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 1" x-collapse>
                        <div class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                            Every registered member can submit a government-issued identification (Nepali Citizenship Certificate, Passport, or Driving License). Our dedicated verification team manually verifies documents against registered profile information to prevent fake accounts and ensure high-trust matchmaking.
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="border border-slate-200/80 rounded-2xl overflow-hidden transition" :class="activeFaq === 2 ? 'bg-slate-50/80 border-rose-200 shadow-sm' : 'bg-white'">
                    <button type="button" @click="activeFaq = (activeFaq === 2 ? null : 2)" class="w-full px-6 py-4 text-left font-black text-sm text-slate-900 flex justify-between items-center gap-4 tap-active">
                        <span>How does the 36 Gun Kundali Milan calculation work?</span>
                        <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition transform duration-300" :class="activeFaq === 2 ? 'rotate-180 text-rose-600' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 2" x-collapse>
                        <div class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                            MeroZodi computes authentic Vedic Ashtakoota compatibility based on your birth date, time, and planetary positions across 8 sacred parameters: Varna, Vashya, Tara, Yoni, Graha Maitri, Gana, Bhakoot, and Nadi (totaling 36 points), alongside Manglik Dosha analysis for traditional Nepali families.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="border border-slate-200/80 rounded-2xl overflow-hidden transition" :class="activeFaq === 3 ? 'bg-slate-50/80 border-rose-200 shadow-sm' : 'bg-white'">
                    <button type="button" @click="activeFaq = (activeFaq === 3 ? null : 3)" class="w-full px-6 py-4 text-left font-black text-sm text-slate-900 flex justify-between items-center gap-4 tap-active">
                        <span>Is my photo and contact information private?</span>
                        <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition transform duration-300" :class="activeFaq === 3 ? 'rotate-180 text-rose-600' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 3" x-collapse>
                        <div class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                            Yes! You have full control over your privacy. You can enable our Photo Privacy Shield to blur your gallery photos and grant viewing permissions only to members whose connect requests you accept. You can also video call and chat within the platform without exposing your personal phone number.
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="border border-slate-200/80 rounded-2xl overflow-hidden transition" :class="activeFaq === 4 ? 'bg-slate-50/80 border-rose-200 shadow-sm' : 'bg-white'">
                    <button type="button" @click="activeFaq = (activeFaq === 4 ? null : 4)" class="w-full px-6 py-4 text-left font-black text-sm text-slate-900 flex justify-between items-center gap-4 tap-active">
                        <span>Can Nepali singles living in Australia, USA, Canada, or UK join?</span>
                        <i class="fa-solid fa-chevron-down text-xs text-slate-400 transition transform duration-300" :class="activeFaq === 4 ? 'rotate-180 text-rose-600' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 4" x-collapse>
                        <div class="px-6 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                            Yes! A large portion of our member base resides across major diaspora cities like Sydney, Melbourne, Dallas, New York, Toronto, Calgary, and London. You can filter prospective brides and grooms by residency status, visa category, and country of residence.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
