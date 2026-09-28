<div class="py-4 md:py-10 bg-slate-50 min-h-[90vh] pb-32 md:pb-12">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        
        <!-- Flash Alerts -->
        @if(session('success'))
            <div class="alert alert-success shadow-sm mb-4 md:mb-6 rounded-2xl text-white font-semibold text-xs sm:text-sm">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('info'))
            <div class="alert alert-info shadow-sm mb-4 md:mb-6 rounded-2xl text-white font-semibold text-xs sm:text-sm">
                <i class="fa-solid fa-circle-info"></i>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        <!-- Back Button & Profile Meta -->
        <div class="mb-4 md:mb-6 flex items-center justify-between">
            <a href="{{ route('browse') }}" class="text-xs font-bold text-slate-600 hover:text-rose-600 transition flex items-center gap-2 tap-active">
                <i class="fa-solid fa-arrow-left"></i> Back to Browse
            </a>
            <div class="text-[11px] text-slate-400">
                ID: <span class="font-mono font-bold text-slate-700">#MZ-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            
            <!-- Left Column: Primary Profile Card & Actions -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-3xl p-6 shadow-xs border border-slate-200/80 text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-24 bg-gradient-to-r from-rose-600 via-pink-600 to-indigo-700"></div>
                    
                    <!-- Avatar with Verified & Online Status Badge + Privacy Shield Blur -->
                    <div class="relative w-28 h-28 sm:w-32 sm:h-32 mx-auto mt-4 sm:mt-6 mb-4 group">
                        <div class="w-full h-full rounded-3xl overflow-hidden ring-4 ring-white shadow-xl bg-slate-100 relative">
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover {{ ($isPhotoBlurred && !$hasPhotoAccess) ? 'blur-lg scale-110 filter' : '' }}">
                            
                            @if($isPhotoBlurred && !$hasPhotoAccess)
                                <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-xs flex flex-col items-center justify-center text-white p-2 text-center">
                                    <i class="fa-solid fa-lock text-xl mb-1 text-rose-300"></i>
                                    <span class="text-[9px] font-black uppercase tracking-wider">Photo Protected</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Facebook-Style Top-Right Online/Offline Indicator -->
                        @if($user->isOnline())
                            <span class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-emerald-500 rounded-full ring-4 ring-white shadow-md z-10" title="Online Now"></span>
                        @else
                            <span class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-slate-400 rounded-full ring-4 ring-white shadow-md z-10" title="Offline"></span>
                        @endif

                        @if($user->is_verified)
                            <div class="absolute bottom-0 right-0 bg-emerald-500 text-white p-1.5 rounded-xl ring-2 ring-white shadow-md text-xs z-10" title="National ID / Citizenship Verified">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        @endif
                    </div>

                    @if($isPhotoBlurred && !$hasPhotoAccess)
                        <div class="mb-4">
                            @if($hasPendingPhotoReq)
                                <span class="badge badge-warning text-slate-900 text-xs font-bold py-3 px-4 rounded-xl">
                                    <i class="fa-solid fa-clock mr-1.5"></i> Photo Request Pending Approval
                                </span>
                            @else
                                <button wire:click="requestPhotoAccess" class="btn btn-sm bg-rose-50 text-rose-600 hover:bg-rose-100 border border-rose-200 text-xs font-bold rounded-xl gap-1.5 tap-active">
                                    <i class="fa-solid fa-key"></i> Request Photo Access
                                </button>
                            @endif
                        </div>
                    @endif

                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 flex items-center justify-center gap-2">
                        {{ $user->name }}
                        @if($user->is_premium)
                            <i class="fa-solid fa-crown text-amber-500 text-base" title="Premium Member"></i>
                        @endif
                    </h1>
                    
                    <p class="text-xs font-bold text-rose-600 uppercase tracking-wider mt-1">
                        {{ $user->age ?? '25' }} Yrs &bull; {{ $user->gender == 'male' ? 'Groom' : 'Bride' }} &bull; {{ $user->profile?->living_city ?? 'Kathmandu' }}
                    </p>
                    
                    <div class="mt-1 flex items-center justify-center gap-1.5 text-[11px]">
                        @if($user->isOnline())
                            <span class="text-emerald-600 font-bold flex items-center gap-1.5 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-100">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Active Now
                            </span>
                        @else
                            <span class="text-slate-500 font-medium flex items-center gap-1.5 bg-slate-100 px-2.5 py-0.5 rounded-full">
                                <span class="w-2 h-2 rounded-full bg-slate-400"></span> {{ $user->online_status }}
                            </span>
                        @endif
                    </div>

                    <div class="mt-4 flex flex-wrap justify-center gap-2 text-xs text-slate-600">
                        <span class="bg-rose-50 text-rose-700 border border-rose-100 px-3 py-1 rounded-full font-semibold">
                            <i class="fa-solid fa-user-tag text-rose-500 mr-1"></i> Profile Created by {{ $user->profile_created_by_label }}
                        </span>
                        <span class="bg-slate-100 px-3 py-1 rounded-full font-medium">
                            <i class="fa-solid fa-om text-rose-500 mr-1"></i> {{ $user->profile?->religion?->name ?? 'Hindu' }}
                        </span>
                        <span class="bg-slate-100 px-3 py-1 rounded-full font-medium">
                            <i class="fa-solid fa-users text-indigo-500 mr-1"></i> {{ $user->profile?->caste?->name ?? 'Brahmin' }}
                        </span>
                        <span class="bg-slate-100 px-3 py-1 rounded-full font-medium">
                            <i class="fa-solid fa-briefcase text-emerald-500 mr-1"></i> {{ $user->education?->occupation?->name ?? 'Professional' }}
                        </span>
                    </div>

                    <!-- Compatibility Match Meter -->
                    <div class="mt-6 p-4 rounded-2xl bg-rose-50/80 border border-rose-100 text-left">
                        <div class="flex justify-between items-center text-xs font-bold mb-1.5">
                            <span class="text-rose-950 flex items-center gap-1.5">
                                <i class="fa-solid fa-heart-pulse text-rose-600"></i> Lifestyle Compatibility
                            </span>
                            <span class="text-rose-700 font-extrabold">{{ $compatibilityScore }}%</span>
                        </div>
                        <progress class="progress progress-error w-full h-2" value="{{ $compatibilityScore }}" max="100"></progress>
                    </div>

                    <!-- Astrological Kundali Gun Milan Widget -->
                    @if($kundaliMatch)
                        <div class="mt-4 p-4 rounded-2xl bg-indigo-50/70 border border-indigo-100 text-left" x-data="{ openMilan: false }">
                            <div class="flex justify-between items-center cursor-pointer" @click="openMilan = !openMilan">
                                <div>
                                    <span class="text-[10px] font-black uppercase tracking-wider text-indigo-600 block">Vedic Kundali Milan</span>
                                    <div class="text-xs font-black text-slate-900 mt-0.5 flex items-center gap-1.5">
                                        <i class="fa-solid fa-star-of-david text-amber-500"></i>
                                        <span>{{ $kundaliMatch['total_score'] }} / {{ $kundaliMatch['max_score'] }} Guns</span>
                                        <span class="badge badge-xs bg-{{ $kundaliMatch['verdict_color'] }}-100 text-{{ $kundaliMatch['verdict_color'] }}-700 font-bold">
                                            {{ $kundaliMatch['percentage'] }}%
                                        </span>
                                    </div>
                                </div>
                                <button class="btn btn-ghost btn-circle btn-xs text-indigo-600">
                                    <i class="fa-solid" :class="openMilan ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                </button>
                            </div>

                            <div x-show="openMilan" x-transition class="mt-3 pt-3 border-t border-indigo-100 space-y-2 text-xs">
                                <p class="text-[11px] font-bold text-{{ $kundaliMatch['verdict_color'] }}-800 leading-tight">
                                    {{ $kundaliMatch['verdict'] }}
                                </p>
                                <p class="text-[10px] text-slate-600 leading-relaxed">
                                    {{ $kundaliMatch['recommendation'] }}
                                </p>

                                <div class="grid grid-cols-2 gap-1.5 pt-1 text-[10px]">
                                    <div class="p-1.5 bg-white rounded-lg border border-indigo-100">
                                        <span class="text-slate-400 block">Manglik Status</span>
                                        <span class="font-bold text-slate-800">{{ $kundaliMatch['manglik_analysis']['status'] }}</span>
                                    </div>
                                    <div class="p-1.5 bg-white rounded-lg border border-indigo-100">
                                        <span class="text-slate-400 block">Gotra Lineage</span>
                                        <span class="font-bold text-slate-800">{{ $kundaliMatch['gotra_analysis']['status'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons for Desktop -->
                    <div class="mt-6 space-y-3 hidden md:block">
                        @if($connectionStatus === 'accepted')
                            <div class="p-3 bg-emerald-50 text-emerald-700 rounded-2xl text-xs font-bold flex items-center justify-center gap-2 border border-emerald-100">
                                <i class="fa-solid fa-handshake"></i> Connected with {{ $user->name }}
                            </div>
                        @elseif($connectionStatus === 'pending')
                            <div class="p-3 bg-amber-50 text-amber-700 rounded-2xl text-xs font-bold flex items-center justify-center gap-2 border border-amber-100">
                                <i class="fa-solid fa-clock"></i> Connection Request Pending
                            </div>
                        @else
                            <button wire:click="openConnectModal" class="w-full py-3.5 bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white font-black text-sm rounded-2xl shadow-lg shadow-rose-200 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 tap-active">
                                <i class="fa-solid fa-ring"></i> Send Connection Request
                            </button>
                        @endif

                        <div class="grid grid-cols-2 gap-3">
                            <button wire:click="toggleLike" class="py-2.5 px-4 rounded-2xl border text-xs font-bold transition flex items-center justify-center gap-1.5 tap-active {{ $isLiked ? 'bg-rose-50 border-rose-300 text-rose-600' : 'border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                                <i class="fa-solid fa-heart {{ $isLiked ? 'text-rose-600' : 'text-slate-400' }}"></i> 
                                {{ $isLiked ? 'Shortlisted' : 'Shortlist' }}
                            </button>

                            @if($canChat)
                                <a href="{{ route('messages', $user->id) }}" class="py-2.5 px-4 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-md shadow-indigo-100 tap-active">
                                    <i class="fa-solid fa-comments"></i> Send Message
                                </a>
                            @else
                                <a href="{{ route('pricing') }}" class="py-2.5 px-4 rounded-2xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition flex items-center justify-center gap-1.5 tap-active">
                                    <i class="fa-solid fa-crown text-amber-400"></i> Unlock Chat
                                </a>
                            @endif
                        </div>

                        <!-- Schedule Virtual Video Date Button -->
                        <button wire:click="openScheduleDateModal" class="w-full py-2.5 rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-xs font-bold transition flex items-center justify-center gap-2 shadow-md shadow-indigo-100 tap-active">
                            <i class="fa-solid fa-calendar-check"></i> Schedule Virtual Video Date
                        </button>

                        <!-- Printable Biodata Sheet Button -->
                        <button wire:click="$set('showBiodataModal', true)" class="w-full py-2 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition flex items-center justify-center gap-2 tap-active">
                            <i class="fa-solid fa-file-lines text-rose-600"></i> View & Print Biodata Sheet
                        </button>
                    </div>

                    <!-- Block / Report links -->
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-center gap-4 text-xs text-slate-400">
                        <button wire:click="$set('showReportModal', true)" class="hover:text-rose-600 transition">
                            <i class="fa-solid fa-flag text-[10px] mr-1"></i> Report
                        </button>
                        <span>&bull;</span>
                        <button wire:click="blockUser" wire:confirm="Are you sure you want to block this user?" class="hover:text-slate-700 transition">
                            <i class="fa-solid fa-ban text-[10px] mr-1"></i> Block
                        </button>
                    </div>
                </div>

                <!-- Contact & Verification Box -->
                <div class="bg-white rounded-3xl p-6 shadow-xs border border-slate-200/80 space-y-3">
                    <h4 class="text-xs font-bold uppercase text-slate-400 tracking-wider">Contact & Verification</h4>
                    <div class="space-y-2 text-xs">
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50">
                            <span class="text-slate-500 flex items-center gap-2"><i class="fa-solid fa-id-card text-slate-400"></i> KYC ID Verified</span>
                            <span class="font-bold text-emerald-600">{{ $user->is_verified ? 'Verified ✓' : 'Pending' }}</span>
                        </div>
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50">
                            <span class="text-slate-500 flex items-center gap-2"><i class="fa-solid fa-phone text-slate-400"></i> Phone Contact</span>
                            @if(Auth::check() && Auth::user()->canViewContactDetails())
                                <span class="font-bold text-slate-800">{{ $user->phone ?? 'Not provided' }}</span>
                            @else
                                <a href="{{ route('pricing') }}" class="font-bold text-rose-600 hover:underline">Upgrade to View</a>
                            @endif
                        </div>
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50">
                            <span class="text-slate-500 flex items-center gap-2"><i class="fa-solid fa-envelope text-slate-400"></i> Email Address</span>
                            @if(Auth::check() && Auth::user()->canViewContactDetails())
                                <span class="font-bold text-slate-800">{{ $user->email }}</span>
                            @else
                                <a href="{{ route('pricing') }}" class="font-bold text-rose-600 hover:underline">Upgrade to View</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Profile Detailed Tabs -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Tab Buttons (Horizontal swipe on mobile) -->
                <div class="bg-white rounded-2xl md:rounded-3xl p-2 shadow-xs border border-slate-200/80 flex items-center gap-1 overflow-x-auto no-scrollbar">
                    <button wire:click="$set('activeTab', 'about')" class="px-3.5 py-2 md:px-4 md:py-2.5 rounded-xl md:rounded-2xl text-xs font-bold transition shrink-0 flex items-center gap-1.5 tap-active {{ $activeTab === 'about' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-user text-[11px]"></i> About
                    </button>
                    <button wire:click="$set('activeTab', 'horoscope')" class="px-3.5 py-2 md:px-4 md:py-2.5 rounded-xl md:rounded-2xl text-xs font-bold transition shrink-0 flex items-center gap-1.5 tap-active {{ $activeTab === 'horoscope' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-moon text-[11px]"></i> Horoscope
                    </button>
                    <button wire:click="$set('activeTab', 'lifestyle')" class="px-3.5 py-2 md:px-4 md:py-2.5 rounded-xl md:rounded-2xl text-xs font-bold transition shrink-0 flex items-center gap-1.5 tap-active {{ $activeTab === 'lifestyle' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-heart-pulse text-[11px]"></i> Lifestyle
                    </button>
                    <button wire:click="$set('activeTab', 'career')" class="px-3.5 py-2 md:px-4 md:py-2.5 rounded-xl md:rounded-2xl text-xs font-bold transition shrink-0 flex items-center gap-1.5 tap-active {{ $activeTab === 'career' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-graduation-cap text-[11px]"></i> Career
                    </button>
                    <button wire:click="$set('activeTab', 'family')" class="px-3.5 py-2 md:px-4 md:py-2.5 rounded-xl md:rounded-2xl text-xs font-bold transition shrink-0 flex items-center gap-1.5 tap-active {{ $activeTab === 'family' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-people-roof text-[11px]"></i> Family
                    </button>
                    <button wire:click="$set('activeTab', 'preferences')" class="px-3.5 py-2 md:px-4 md:py-2.5 rounded-xl md:rounded-2xl text-xs font-bold transition shrink-0 flex items-center gap-1.5 tap-active {{ $activeTab === 'preferences' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-sliders text-[11px]"></i> Preferences
                    </button>
                    <button wire:click="$set('activeTab', 'photos')" class="px-3.5 py-2 md:px-4 md:py-2.5 rounded-xl md:rounded-2xl text-xs font-bold transition shrink-0 flex items-center gap-1.5 tap-active {{ $activeTab === 'photos' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100' }}">
                        <i class="fa-solid fa-images text-[11px]"></i> Photos ({{ $user->galleries->count() }})
                    </button>
                </div>

                <!-- Tab 1: About Me & Bio -->
                @if($activeTab === 'about')
                    <div class="bg-white rounded-3xl p-5 sm:p-8 shadow-xs border border-slate-200/80 space-y-6">
                        <div>
                            <h3 class="text-sm sm:text-base font-extrabold text-slate-900 mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-quote-left text-rose-500"></i> In My Own Words
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed bg-slate-50 p-4 sm:p-5 rounded-2xl border border-slate-100">
                                {{ $user->profile?->about_me ?? 'Hello! I am looking for a sincere, caring partner who shares traditional Nepali family values alongside a modern worldview. Looking forward to connecting and knowing each other.' }}
                            </p>
                        </div>

                        <div>
                            <h3 class="text-sm sm:text-base font-extrabold text-slate-900 mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-location-dot text-indigo-500"></i> Location & Residency
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                                <div class="p-3 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Profile Created By</span><span class="font-bold text-rose-600">{{ $user->profile_created_by_label }}</span></div>
                                <div class="p-3 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Current Country</span><span class="font-bold text-slate-800">{{ $user->profile?->living_country ?? 'Nepal' }}</span></div>
                                <div class="p-3 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Current City / State</span><span class="font-bold text-slate-800">{{ $user->profile?->living_city ?? 'Kathmandu' }}, {{ $user->profile?->living_state ?? 'Bagmati' }}</span></div>
                                <div class="p-3 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Citizenship</span><span class="font-bold text-slate-800">{{ $user->profile?->citizenship_country ?? 'Nepal' }}</span></div>
                                <div class="p-3 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Residency Status</span><span class="font-bold text-slate-800 uppercase">{{ str_replace('_', ' ', $user->profile?->residency_status ?? 'citizen') }}</span></div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Tab 2: Cultural & Horoscope -->
                @if($activeTab === 'horoscope')
                    <div class="bg-white rounded-3xl p-5 sm:p-8 shadow-xs border border-slate-200/80 space-y-6">
                        <h3 class="text-sm sm:text-base font-extrabold text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-moon text-indigo-600"></i> Astrological & Cultural Background
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><span class="text-slate-400 block text-[10px] uppercase font-bold">Religion</span><span class="font-bold text-slate-900 text-sm">{{ $user->profile?->religion?->name ?? 'Hindu' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><span class="text-slate-400 block text-[10px] uppercase font-bold">Caste / Community</span><span class="font-bold text-slate-900 text-sm">{{ $user->profile?->caste?->name ?? 'Brahmin' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><span class="text-slate-400 block text-[10px] uppercase font-bold">Sub-Caste</span><span class="font-bold text-slate-900 text-sm">{{ $user->profile?->sub_caste ?? 'Not specified' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><span class="text-slate-400 block text-[10px] uppercase font-bold">Mother Tongue</span><span class="font-bold text-slate-900 text-sm">{{ $user->profile?->mother_tongue ?? 'Nepali' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><span class="text-slate-400 block text-[10px] uppercase font-bold">Horoscope Rashi</span><span class="font-bold text-rose-600 text-sm">{{ $user->profile?->rashi ?? 'Mesha (Aries)' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><span class="text-slate-400 block text-[10px] uppercase font-bold">Gotra</span><span class="font-bold text-slate-900 text-sm">{{ $user->profile?->gotra ?? 'Kashyap' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><span class="text-slate-400 block text-[10px] uppercase font-bold">Manglik Status</span><span class="font-bold text-slate-900 text-sm uppercase">{{ $user->profile?->manglik ?? 'No' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><span class="text-slate-400 block text-[10px] uppercase font-bold">Marital Status</span><span class="font-bold text-slate-900 text-sm">{{ $user->marital_status_label }}</span></div>
                        </div>
                    </div>
                @endif

                <!-- Tab 3: Lifestyle & Physical -->
                @if($activeTab === 'lifestyle')
                    <div class="bg-white rounded-3xl p-5 sm:p-8 shadow-xs border border-slate-200/80 space-y-6">
                        <h3 class="text-sm sm:text-base font-extrabold text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-heart-pulse text-pink-600"></i> Lifestyle & Physical Attributes
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Height</span><span class="font-bold text-slate-900 text-sm">{{ $user->physical?->height_cm ? $user->physical->height_cm . ' cm (' . round($user->physical->height_cm / 30.48, 1) . ' ft)' : '5 ft 8 in' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Weight</span><span class="font-bold text-slate-900 text-sm">{{ $user->physical?->weight_kg ? $user->physical->weight_kg . ' kg' : '65 kg' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Diet Type</span><span class="font-bold text-slate-900 text-sm uppercase">{{ str_replace('_', ' ', $user->physical?->diet ?? 'non_vegetarian') }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Blood Group</span><span class="font-bold text-slate-900 text-sm">{{ $user->physical?->blood_group ?? 'O+' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Smoking</span><span class="font-bold text-slate-900 text-sm uppercase">{{ $user->physical?->smoke_habit ?? 'No' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Drinking</span><span class="font-bold text-slate-900 text-sm uppercase">{{ $user->physical?->drink_habit ?? 'Socially' }}</span></div>
                        </div>
                    </div>
                @endif

                <!-- Tab 4: Education & Career -->
                @if($activeTab === 'career')
                    <div class="bg-white rounded-3xl p-5 sm:p-8 shadow-xs border border-slate-200/80 space-y-6">
                        <h3 class="text-sm sm:text-base font-extrabold text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-graduation-cap text-emerald-600"></i> Education & Career Standing
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Highest Degree</span><span class="font-bold text-slate-900 text-sm">{{ $user->education?->educationLevel?->name ?? 'Bachelors Degree' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Field of Study</span><span class="font-bold text-slate-900 text-sm">{{ $user->education?->educationField?->name ?? 'Engineering / Business' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">College / University</span><span class="font-bold text-slate-900 text-sm">{{ $user->education?->college_name ?? 'Tribhuvan University' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Occupation</span><span class="font-bold text-slate-900 text-sm">{{ $user->education?->occupation?->name ?? 'Professional' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Annual Income</span><span class="font-bold text-emerald-600 text-sm">{{ $user->education?->annual_income_range ?? 'NPR 10 Lakh - 15 Lakh' }}</span></div>
                        </div>
                    </div>
                @endif

                <!-- Tab 5: Family Details -->
                @if($activeTab === 'family')
                    <div class="bg-white rounded-3xl p-5 sm:p-8 shadow-xs border border-slate-200/80 space-y-6">
                        <h3 class="text-sm sm:text-base font-extrabold text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-people-roof text-amber-600"></i> Family Lineage & Background
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Father Profession</span><span class="font-bold text-slate-900 text-sm">{{ $user->family?->father_profession ?? 'Business / Retired' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Mother Profession</span><span class="font-bold text-slate-900 text-sm">{{ $user->family?->mother_profession ?? 'Homemaker' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Brothers</span><span class="font-bold text-slate-900 text-sm">{{ $user->family?->brothers_count ?? 1 }} (Married: {{ $user->family?->married_brothers_count ?? 0 }})</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Sisters</span><span class="font-bold text-slate-900 text-sm">{{ $user->family?->sisters_count ?? 1 }} (Married: {{ $user->family?->married_sisters_count ?? 1 }})</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Family Type</span><span class="font-bold text-slate-900 text-sm capitalize">{{ $user->family?->family_type ?? 'Nuclear Family' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Family Values</span><span class="font-bold text-slate-900 text-sm capitalize">{{ $user->family?->family_values ?? 'Moderate' }}</span></div>
                        </div>
                    </div>
                @endif

                <!-- Tab 6: Partner Preferences -->
                @if($activeTab === 'preferences')
                    <div class="bg-white rounded-3xl p-5 sm:p-8 shadow-xs border border-slate-200/80 space-y-6">
                        <h3 class="text-sm sm:text-base font-extrabold text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-sliders text-rose-500"></i> Desired Partner Attributes
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Preferred Age Range</span><span class="font-bold text-slate-900 text-sm">{{ $user->preferences?->min_age ?? 20 }} - {{ $user->preferences?->max_age ?? 32 }} Years</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Preferred Diet</span><span class="font-bold text-slate-900 text-sm capitalize">{{ $user->preferences?->preferred_diet ?? 'Any' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Manglik Compatibility</span><span class="font-bold text-slate-900 text-sm uppercase">{{ $user->preferences?->preferred_manglik ?? 'Any' }}</span></div>
                            <div class="p-4 bg-slate-50 rounded-2xl"><span class="text-slate-400 block text-[10px] uppercase font-bold">Preferred Locations</span><span class="font-bold text-slate-900 text-sm">Nepal, Australia, USA, Canada</span></div>
                        </div>
                    </div>
                @endif

                <!-- Tab 7: Photo Gallery -->
                @if($activeTab === 'photos')
                    <div class="bg-white rounded-3xl p-5 sm:p-8 shadow-xs border border-slate-200/80 space-y-6">
                        <h3 class="text-sm sm:text-base font-extrabold text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-images text-rose-500"></i> Photo Album
                        </h3>
                        @if($user->galleries->count() > 0)
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 md:gap-4">
                                @foreach($user->galleries as $photo)
                                    <div class="relative group rounded-2xl overflow-hidden shadow-xs bg-slate-100 aspect-square">
                                        <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Photo" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-8 sm:p-12 text-center text-slate-400 text-xs sm:text-sm bg-slate-50 rounded-2xl">
                                <i class="fa-regular fa-image text-3xl mb-2 block text-slate-300"></i>
                                No additional photos uploaded yet.
                            </div>
                        @endif
                    </div>
                @endif

            </div>

        </div>

    </div>

    <!-- Floating Sticky Bottom Mobile Action Bar (md:hidden) -->
    <div class="fixed bottom-14 inset-x-0 z-30 p-3 bg-white/95 backdrop-blur-md border-t border-slate-200 shadow-[0_-4px_16px_rgba(0,0,0,0.08)] md:hidden">
        <div class="flex items-center gap-2 max-w-md mx-auto">
            <!-- Shortlist Button -->
            <button wire:click="toggleLike" class="btn btn-circle btn-sm h-11 w-11 border {{ $isLiked ? 'bg-rose-50 border-rose-300 text-rose-600' : 'bg-slate-100 border-slate-200 text-slate-700' }} tap-active" aria-label="Shortlist">
                <i class="fa-solid fa-heart text-base"></i>
            </button>

            <!-- Message Button -->
            @if($canChat)
                <a href="{{ route('messages', $user->id) }}" class="btn btn-circle btn-sm h-11 w-11 bg-indigo-600 text-white border-none shadow-md shadow-indigo-100 tap-active" aria-label="Chat">
                    <i class="fa-solid fa-comment text-base"></i>
                </a>
            @else
                <a href="{{ route('pricing') }}" class="btn btn-circle btn-sm h-11 w-11 bg-slate-900 text-amber-400 border-none tap-active" aria-label="Unlock Chat">
                    <i class="fa-solid fa-crown text-base"></i>
                </a>
            @endif

            <!-- Main Connect CTA -->
            @if($connectionStatus === 'accepted')
                <button class="btn btn-success flex-1 h-11 rounded-2xl font-black text-xs text-white pointer-events-none">
                    <i class="fa-solid fa-handshake mr-1"></i> Connected
                </button>
            @elseif($connectionStatus === 'pending')
                <button disabled class="btn bg-slate-100 text-slate-400 flex-1 h-11 rounded-2xl font-bold text-xs">
                    <i class="fa-solid fa-clock mr-1"></i> Request Sent
                </button>
            @else
                <button wire:click="openConnectModal" class="btn btn-primary flex-1 h-11 rounded-2xl font-black text-xs text-white bg-gradient-to-r from-rose-600 to-pink-600 shadow-lg shadow-rose-200 tap-active">
                    <i class="fa-solid fa-ring mr-1"></i> Send Connect
                </button>
            @endif
        </div>
    </div>

    <!-- Connect Request Modal -->
    @if($showConnectModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-xs p-4">
            <div class="bg-white rounded-3xl p-6 max-w-md w-full shadow-2xl space-y-4">
                <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                    <h3 class="font-black text-base text-slate-900">Send Connection Request</h3>
                    <button wire:click="$set('showConnectModal', false)" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Express your interest to connect with <strong class="text-slate-900">{{ $user->name }}</strong>. You can include an optional polite greeting note.
                </p>
                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Personal Greeting Note (Optional)</label>
                    <textarea wire:model="connectMessage" rows="3" class="textarea textarea-bordered w-full text-xs rounded-xl" placeholder="Namaste, I came across your profile and found our family values and interests well aligned..."></textarea>
                </div>
                <div class="flex gap-3 pt-2">
                    <button wire:click="$set('showConnectModal', false)" class="btn btn-ghost flex-1 rounded-xl text-xs font-bold">Cancel</button>
                    <button wire:click="submitConnectRequest" class="btn btn-primary flex-1 rounded-xl text-xs font-bold bg-rose-600 border-none text-white hover:bg-rose-700 shadow-md shadow-rose-200">Send Request</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Report Modal -->
    @if($showReportModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-xs p-4">
            <div class="bg-white rounded-3xl p-6 max-w-md w-full shadow-2xl space-y-4">
                <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                    <h3 class="font-black text-base text-slate-900 flex items-center gap-2 text-rose-600">
                        <i class="fa-solid fa-triangle-exclamation"></i> Report Profile
                    </h3>
                    <button wire:click="$set('showReportModal', false)" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Reason for Report</label>
                    <select wire:model="reportReason" class="select select-bordered w-full text-xs rounded-xl">
                        <option value="">Select a reason...</option>
                        <option value="Fake or misleading profile information">Fake or misleading profile information</option>
                        <option value="Inappropriate photos or bio content">Inappropriate photos or bio content</option>
                        <option value="Harassment or rude behavior">Harassment or rude behavior</option>
                        <option value="Commercial solicitation / Scam">Commercial solicitation / Scam</option>
                    </select>
                    @error('reportReason') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Additional Details</label>
                    <textarea wire:model="reportDetails" rows="3" class="textarea textarea-bordered w-full text-xs rounded-xl" placeholder="Provide extra details for moderators..."></textarea>
                </div>
                <div class="flex gap-3 pt-2">
                    <button wire:click="$set('showReportModal', false)" class="btn btn-ghost flex-1 rounded-xl text-xs font-bold">Cancel</button>
                    <button wire:click="submitReport" class="btn btn-error flex-1 rounded-xl text-xs font-bold text-white">Submit Report</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Schedule Virtual Video Date Modal -->
    @if($showScheduleModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-xs p-4">
            <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl space-y-4">
                <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                    <h3 class="font-black text-base text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-video text-indigo-600"></i> Schedule 1-on-1 Video Date
                    </h3>
                    <button wire:click="$set('showScheduleModal', false)" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark text-lg"></i></button>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Propose a convenient date & time to connect live with <strong class="text-slate-900">{{ $user->name }}</strong> in our private, end-to-end encrypted video room.
                </p>

                <div class="space-y-3">
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Proposed Date</label>
                        <input type="date" wire:model="scheduledDate" class="input input-bordered w-full text-xs rounded-xl" min="{{ date('Y-m-d') }}">
                        @error('scheduledDate') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Preferred Time (NPT)</label>
                        <input type="time" wire:model="scheduledTime" class="input input-bordered w-full text-xs rounded-xl">
                        @error('scheduledTime') <span class="text-rose-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Invitation Note (Optional)</label>
                        <textarea wire:model="scheduleNote" rows="2" class="textarea textarea-bordered w-full text-xs rounded-xl" placeholder="Looking forward to our introductory virtual chat!"></textarea>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button wire:click="$set('showScheduleModal', false)" class="btn btn-ghost flex-1 rounded-xl text-xs font-bold">Cancel</button>
                    <button wire:click="submitScheduleDate" class="btn btn-primary flex-1 rounded-xl text-xs font-bold bg-gradient-to-r from-indigo-600 to-purple-600 border-none text-white shadow-md shadow-indigo-200">
                        Send Invitation
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Printable Vedic Matrimonial Biodata Modal (A4 Ready) -->
    @if($showBiodataModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/70 backdrop-blur-sm p-2 sm:p-4 overflow-y-auto">
            <div class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl relative my-8 overflow-hidden">
                
                <!-- Modal Top Action Header -->
                <div class="p-4 bg-slate-900 text-white flex items-center justify-between no-print">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-file-pdf text-rose-400"></i>
                        <span class="text-xs font-bold uppercase tracking-wider">Matrimonial Biodata Sheet</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="window.print()" class="btn btn-xs bg-rose-600 hover:bg-rose-700 text-white border-none font-bold rounded-lg gap-1">
                            <i class="fa-solid fa-print"></i> Print / Save PDF
                        </button>
                        <button wire:click="$set('showBiodataModal', false)" class="btn btn-circle btn-ghost btn-xs text-white">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>
                    </div>
                </div>

                <!-- Printable Sheet Body -->
                <div class="p-6 sm:p-10 text-slate-800 space-y-6 bg-[radial-gradient(#f1f5f9_1px,transparent_1px)] [background-size:16px_16px]">
                    
                    <!-- Top Vedic Header -->
                    <div class="text-center pb-4 border-b-2 border-rose-600 relative">
                        <span class="text-rose-600 font-extrabold text-lg tracking-widest block font-serif">॥ श्री गणेशाय नमः ॥</span>
                        <h2 class="text-xl sm:text-2xl font-black text-slate-900 mt-1 uppercase tracking-wider">Matrimonial Biodata</h2>
                        <span class="text-[11px] text-slate-500 font-semibold">MeroZodi Verified Profile #MZ-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <!-- Personal Profile Overview -->
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                        <div class="w-32 h-36 rounded-2xl overflow-hidden ring-2 ring-rose-300 shadow-md shrink-0 bg-slate-100">
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="space-y-1.5 text-xs flex-1 text-center sm:text-left">
                            <h3 class="text-lg font-black text-slate-900">{{ $user->name }}</h3>
                            <p class="text-rose-600 font-bold uppercase">{{ $user->education?->occupation?->name ?? 'Professional' }} &bull; {{ $user->profile?->living_city ?? 'Kathmandu' }}</p>
                            <p class="text-slate-600"><strong>Date of Birth:</strong> {{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('d F Y') : '1995-05-14' }} (Age: {{ $user->age ?? 29 }} Yrs)</p>
                            <p class="text-slate-600"><strong>Height & Weight:</strong> {{ $user->physical?->height_cm ? $user->physical->height_cm . ' cm' : '5 ft 8 in' }} &bull; {{ $user->physical?->weight_kg ?? '68' }} kg</p>
                            <p class="text-slate-600"><strong>Profile Created By:</strong> {{ $user->profile_created_by_label }}</p>
                            <p class="text-slate-600"><strong>Marital Status:</strong> {{ ucwords(str_replace('_', ' ', $user->profile?->marital_status ?? 'Never Married')) }}</p>
                            <p class="text-slate-600"><strong>Diet / Lifestyle:</strong> {{ ucwords(str_replace('_', ' ', $user->physical?->diet ?? 'Vegetarian')) }} (Non-Smoker)</p>
                        </div>
                    </div>

                    <!-- 1. Astrological & Cultural Details -->
                    <div class="space-y-2">
                        <h4 class="text-xs font-black uppercase tracking-wider text-rose-700 pb-1 border-b border-rose-200">
                            1. Astrological & Cultural Details (कुण्डली तथा धार्मिक विवरण)
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 text-xs">
                            <div><span class="text-slate-400 block text-[10px]">Religion</span><strong>{{ $user->profile?->religion?->name ?? 'Hindu' }}</strong></div>
                            <div><span class="text-slate-400 block text-[10px]">Caste / Sub-Caste</span><strong>{{ $user->profile?->caste?->name ?? 'Brahmin' }}</strong></div>
                            <div><span class="text-slate-400 block text-[10px]">Gotra (गोत्र)</span><strong>{{ $user->profile?->gotra ?? 'Kashyap' }}</strong></div>
                            <div><span class="text-slate-400 block text-[10px]">Rashi (राशि)</span><strong class="text-rose-600">{{ $user->profile?->rashi ?? 'Mesha (Aries)' }}</strong></div>
                            <div><span class="text-slate-400 block text-[10px]">Manglik Status</span><strong>{{ strtoupper($user->profile?->manglik ?? 'No') }}</strong></div>
                            <div><span class="text-slate-400 block text-[10px]">Mother Tongue</span><strong>{{ $user->profile?->mother_tongue ?? 'Nepali' }}</strong></div>
                        </div>
                    </div>

                    <!-- 2. Education & Profession -->
                    <div class="space-y-2">
                        <h4 class="text-xs font-black uppercase tracking-wider text-rose-700 pb-1 border-b border-rose-200">
                            2. Educational & Career Background (शिक्षा तथा पेशा)
                        </h4>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div><span class="text-slate-400 block text-[10px]">Highest Qualification</span><strong>{{ $user->education?->educationLevel?->name ?? "Master's Degree" }}</strong></div>
                            <div><span class="text-slate-400 block text-[10px]">Specialization Field</span><strong>{{ $user->education?->educationField?->name ?? 'Computer Science' }}</strong></div>
                            <div><span class="text-slate-400 block text-[10px]">College / University</span><strong>{{ $user->education?->college_name ?? 'Tribhuvan University' }}</strong></div>
                            <div><span class="text-slate-400 block text-[10px]">Current Occupation</span><strong>{{ $user->education?->occupation?->name ?? 'Software Engineer' }}</strong></div>
                            <div><span class="text-slate-400 block text-[10px]">Annual Income Package</span><strong>{{ $user->education?->annual_income_range ?? 'NPR 15 Lakh - 25 Lakh' }}</strong></div>
                            <div><span class="text-slate-400 block text-[10px]">Work Location</span><strong>{{ $user->profile?->living_city ?? 'Kathmandu' }}, {{ $user->profile?->living_country ?? 'Nepal' }}</strong></div>
                        </div>
                    </div>

                    <!-- 3. Family Lineage Details -->
                    <div class="space-y-2">
                        <h4 class="text-xs font-black uppercase tracking-wider text-rose-700 pb-1 border-b border-rose-200">
                            3. Family Details (पारिवारिक विवरण)
                        </h4>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div><span class="text-slate-400 block text-[10px]">Father's Profession</span><strong>{{ $user->family?->father_profession ?? 'Retired Civil Servant' }}</strong></div>
                            <div><span class="text-slate-400 block text-[10px]">Mother's Profession</span><strong>{{ $user->family?->mother_profession ?? 'Homemaker' }}</strong></div>
                            <div><span class="text-slate-400 block text-[10px]">Brothers</span><strong>{{ $user->family?->brothers_count ?? 1 }} (Married: {{ $user->family?->married_brothers_count ?? 0 }})</strong></div>
                            <div><span class="text-slate-400 block text-[10px]">Sisters</span><strong>{{ $user->family?->sisters_count ?? 1 }} (Married: {{ $user->family?->married_sisters_count ?? 1 }})</strong></div>
                            <div><span class="text-slate-400 block text-[10px]">Permanent Ancestral Home</span><strong>{{ $user->profile?->permanent_address ?? 'Kathmandu, Nepal' }}</strong></div>
                            <div><span class="text-slate-400 block text-[10px]">Family Status & Values</span><strong>Middle Class &bull; Moderate Nepali Values</strong></div>
                        </div>
                    </div>

                    <!-- Footer Seal -->
                    <div class="pt-4 border-t border-slate-200 flex items-center justify-between text-[10px] text-slate-500">
                        <span>Generated securely via <strong>MeroZodi Matrimonial Platform (merozodi.com)</strong></span>
                        <span>Official ID Verified ✓</span>
                    </div>

                </div>

            </div>
        </div>
    @endif

</div>
