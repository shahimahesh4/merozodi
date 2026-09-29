<div x-data="{ mobileFilterOpen: false }" class="py-4 md:py-10 bg-slate-50 min-h-[85vh]">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        
        <!-- Header & Quick Search Bar -->
        <div class="bg-white rounded-2xl md:rounded-3xl p-4 md:p-6 shadow-xs border border-slate-200/80 mb-4 md:mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
            <div>
                <h1 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight">Discover Matches</h1>
                <p class="text-xs text-slate-500 mt-0.5">Verified prospective Nepali brides & grooms</p>
            </div>

            <div class="flex items-center gap-2 w-full md:w-auto">
                <div class="relative flex-1 md:w-72">
                    <input type="text" wire:model.live.debounce.300ms="searchQuery" placeholder="Search by name, city..." class="input input-bordered input-sm w-full pl-9 rounded-xl text-xs bg-slate-50 md:bg-white">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-xs text-slate-400"></i>
                </div>
                
                <!-- Mobile Filter Trigger Button -->
                <button @click="mobileFilterOpen = true" class="btn btn-primary btn-sm rounded-xl text-xs font-bold md:hidden flex items-center gap-1.5 shadow-sm shadow-rose-200 tap-active">
                    <i class="fa-solid fa-sliders text-xs"></i> Filters
                </button>

                <button wire:click="resetFilters" class="btn btn-ghost btn-sm text-slate-400 hover:text-rose-600 text-xs hidden sm:inline-flex rounded-xl" title="Reset All Filters">
                    <i class="fa-solid fa-rotate-left"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-8">
            
            <!-- Desktop Filters Sidebar (Hidden on mobile) -->
            <div class="hidden lg:block lg:col-span-1 space-y-6">
                <div class="bg-white rounded-3xl p-6 shadow-xs border border-slate-200/80 space-y-5 sticky top-24">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <h3 class="font-bold text-sm text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-sliders text-rose-500"></i> Match Filters
                        </h3>
                        <button wire:click="resetFilters" class="text-[10px] uppercase font-bold text-rose-600 hover:underline">
                            Reset
                        </button>
                    </div>

                    <!-- Gender Toggle -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5">Looking For</label>
                        <div class="grid grid-cols-2 gap-2">
                            <button type="button" wire:click="$set('gender', 'female')" class="btn btn-sm {{ $gender === 'female' ? 'btn-primary shadow-sm' : 'btn-outline border-slate-200 text-slate-600' }} rounded-xl text-xs font-bold">
                                <i class="fa-solid fa-venus"></i> Brides
                            </button>
                            <button type="button" wire:click="$set('gender', 'male')" class="btn btn-sm {{ $gender === 'male' ? 'btn-primary shadow-sm' : 'btn-outline border-slate-200 text-slate-600' }} rounded-xl text-xs font-bold">
                                <i class="fa-solid fa-mars"></i> Grooms
                            </button>
                        </div>
                    </div>

                    <!-- Verified Only Toggle -->
                    <div class="p-3 bg-emerald-50/80 rounded-2xl border border-emerald-100 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-certificate text-emerald-600 text-sm"></i>
                            <span class="text-xs font-bold text-emerald-950">Verified Profiles Only</span>
                        </div>
                        <input type="checkbox" wire:model.live="verifiedOnly" class="checkbox checkbox-sm checkbox-success">
                    </div>

                    <!-- Profile Created By -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5">Profile Created By</label>
                        <select wire:model.live="profile_created_by" class="select select-bordered select-sm w-full rounded-xl text-xs">
                            <option value="">Any</option>
                            <option value="self">Self</option>
                            <option value="parents">Parents</option>
                            <option value="sibling">Sibling</option>
                            <option value="relative">Relative</option>
                            <option value="friend">Friend</option>
                        </select>
                    </div>

                    <!-- Marital Status -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5">Marital Status</label>
                        <select wire:model.live="marital_status" class="select select-bordered select-sm w-full rounded-xl text-xs">
                            <option value="">Any Status</option>
                            <option value="unmarried">Unmarried</option>
                            <option value="widow">Widow</option>
                            <option value="divorced">Divorced</option>
                            <option value="separated">Separated</option>
                        </select>
                    </div>

                    <!-- Religion -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5">Religion</label>
                        <select wire:model.live="religion" class="select select-bordered select-sm w-full rounded-xl text-xs">
                            <option value="">All Religions</option>
                            @foreach($religions as $r)
                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Caste -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5">Caste / Community</label>
                        <select wire:model.live="caste" class="select select-bordered select-sm w-full rounded-xl text-xs">
                            <option value="">All Castes</option>
                            @foreach($castes as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- City / Location -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5">Location</label>
                        <select wire:model.live="city" class="select select-bordered select-sm w-full rounded-xl text-xs">
                            <option value="">Any City / Country</option>
                            @foreach($cities as $ct)
                                <option value="{{ $ct->name }}">{{ $ct->name }} ({{ $ct->country }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Diet -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5">Diet</label>
                        <select wire:model.live="diet" class="select select-bordered select-sm w-full rounded-xl text-xs">
                            <option value="">Any Diet</option>
                            <option value="vegetarian">Vegetarian</option>
                            <option value="non_vegetarian">Non-Vegetarian</option>
                            <option value="vegan">Vegan</option>
                        </select>
                    </div>

                    <!-- Manglik -->
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1.5">Manglik Status</label>
                        <select wire:model.live="manglik" class="select select-bordered select-sm w-full rounded-xl text-xs">
                            <option value="">Any</option>
                            <option value="no">Non-Manglik</option>
                            <option value="yes">Manglik</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Profiles Grid Section -->
            <div class="col-span-1 lg:col-span-3">
                
                <!-- 5-Tier Discovery Horizontal Scrollable Bar on Mobile -->
                <div class="bg-white rounded-2xl md:rounded-3xl p-2 shadow-xs border border-slate-200/80 mb-5 flex items-center justify-between gap-2 overflow-x-auto no-scrollbar">
                    <div class="flex items-center gap-1.5 shrink-0">
                        <button wire:click="$set('tierTab', 'all')" class="px-3.5 py-1.5 md:px-4 md:py-2 rounded-xl md:rounded-2xl text-xs font-bold transition flex items-center gap-1.5 tap-active {{ $tierTab === 'all' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100' }}">
                            <i class="fa-solid fa-layer-group text-[11px]"></i> All
                        </button>
                        <button wire:click="$set('tierTab', 'mutual')" class="px-3.5 py-1.5 md:px-4 md:py-2 rounded-xl md:rounded-2xl text-xs font-bold transition flex items-center gap-1.5 tap-active {{ $tierTab === 'mutual' ? 'bg-gradient-to-r from-rose-600 to-pink-600 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100' }}">
                            <i class="fa-solid fa-heart-pulse text-[11px]"></i> Mutual Matches
                        </button>
                        <button wire:click="$set('tierTab', 'verified')" class="px-3.5 py-1.5 md:px-4 md:py-2 rounded-xl md:rounded-2xl text-xs font-bold transition flex items-center gap-1.5 tap-active {{ $tierTab === 'verified' ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100' }}">
                            <i class="fa-solid fa-certificate text-[11px]"></i> Verified
                        </button>
                        <button wire:click="$set('tierTab', 'newest')" class="px-3.5 py-1.5 md:px-4 md:py-2 rounded-xl md:rounded-2xl text-xs font-bold transition flex items-center gap-1.5 tap-active {{ $tierTab === 'newest' ? 'bg-indigo-600 text-white shadow-md' : 'text-slate-600 hover:bg-slate-100' }}">
                            <i class="fa-solid fa-wand-magic-sparkles text-[11px]"></i> Newest
                        </button>
                    </div>
                    <div class="text-[11px] text-slate-400 font-bold px-2 py-1 shrink-0">
                        {{ $profiles->total() }} Matches
                    </div>
                </div>

                @if(session()->has('success'))
                    <div class="alert alert-success shadow-lg rounded-2xl mb-5 text-xs sm:text-sm text-white font-semibold">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Profiles Cards -->
                <div wire:loading.class="opacity-50 pointer-events-none" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 md:gap-6 transition duration-200">
                    @forelse($profiles as $profile)
                        <div class="bg-white rounded-3xl overflow-hidden border border-slate-200/80 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                            
                            <div>
                                <!-- Image Container with App-like Gradient Header -->
                                <div class="relative h-64 sm:h-60 bg-slate-100 overflow-hidden cursor-pointer" wire:click="viewProfile({{ $profile->id }})">
                                    <img src="{{ $profile->avatar_url }}" alt="{{ $profile->name }}" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>

                                    <!-- Top Badges -->
                                    <div class="absolute top-3 left-3 flex gap-1.5">
                                        @if($profile->is_verified)
                                            <span class="bg-emerald-500 text-white text-[10px] font-black px-2.5 py-0.5 rounded-full shadow backdrop-blur-xs flex items-center gap-1">
                                                <i class="fa-solid fa-circle-check"></i> Verified
                                            </span>
                                        @endif
                                        @if($profile->is_premium)
                                            <span class="bg-amber-500 text-slate-950 text-[10px] font-black px-2.5 py-0.5 rounded-full shadow backdrop-blur-xs flex items-center gap-1">
                                                <i class="fa-solid fa-crown"></i> VIP
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Top Right: Online/Offline Badge + Like Heart Button -->
                                    <div class="absolute top-3 right-3 flex items-center gap-1.5">
                                        <!-- Facebook Style Online / Offline Indicator -->
                                        @if($profile->isOnline())
                                            <span class="bg-black/60 backdrop-blur-md text-white text-[10px] font-bold px-2 py-0.5 rounded-full border border-emerald-500/40 shadow-sm flex items-center gap-1.5" title="Online Now">
                                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 ring-2 ring-white"></span>
                                                <span class="text-emerald-300">Online</span>
                                            </span>
                                        @else
                                            <span class="bg-black/60 backdrop-blur-md text-slate-300 text-[10px] font-medium px-2 py-0.5 rounded-full border border-white/10 shadow-sm flex items-center gap-1.5" title="Offline">
                                                <span class="w-2.5 h-2.5 rounded-full bg-slate-400 ring-2 ring-white"></span>
                                                <span>Offline</span>
                                            </span>
                                        @endif

                                        <!-- Like Heart Button -->
                                        <button type="button" wire:click.stop="toggleLike({{ $profile->id }})" class="w-8 h-8 rounded-full bg-white/90 backdrop-blur text-slate-700 hover:text-rose-600 flex items-center justify-center shadow-md tap-active transition" aria-label="Shortlist Profile">
                                            <i class="fa-solid fa-heart text-xs {{ in_array($profile->id, $myLikes) ? 'text-rose-600' : 'text-slate-300' }}"></i>
                                        </button>
                                    </div>

                                    <!-- Bottom Info Overlay -->
                                    <div class="absolute bottom-3 left-3.5 right-3.5 text-white">
                                        <h3 class="text-base font-black truncate">{{ $profile->name }}, {{ $profile->age }}</h3>
                                        <p class="text-xs text-slate-300 truncate">
                                            <i class="fa-solid fa-location-dot text-rose-400 mr-1"></i> {{ $profile->profile->living_city ?? 'Kathmandu' }}, {{ $profile->profile->living_country ?? 'Nepal' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Metadata -->
                                <div class="p-4 space-y-2 text-xs text-slate-600">
                                    <div class="flex items-center justify-between pb-1.5 border-b border-slate-100">
                                        <span class="text-slate-400 font-medium">Community:</span>
                                        <span class="font-bold text-slate-800 truncate max-w-[160px]">{{ $profile->profile->caste->name ?? 'Nepali' }} ({{ $profile->profile->religion->name ?? 'Hindu' }})</span>
                                    </div>
                                    <div class="flex items-center justify-between pb-1.5 border-b border-slate-100">
                                        <span class="text-slate-400 font-medium">Profession:</span>
                                        <span class="font-bold text-slate-800 truncate max-w-[160px]">{{ $profile->education->designation ?? 'Professional' }}</span>
                                    </div>
                                    <div class="flex items-center justify-between pb-1.5 border-b border-slate-100">
                                        <span class="text-slate-400 font-medium">Education:</span>
                                        <span class="font-bold text-slate-800 truncate max-w-[160px]">{{ $profile->education->educationLevel->name ?? "Bachelor's" }}</span>
                                    </div>
                                    @if($profile->profile && $profile->profile->rashi)
                                        <div class="flex items-center justify-between">
                                            <span class="text-slate-400 font-medium">Rashi / Gotra:</span>
                                            <span class="font-bold text-indigo-700 bg-indigo-50 px-2 py-0.5 rounded-md text-[11px]">{{ $profile->profile->rashi }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Action Footer -->
                            <div class="p-4 pt-0 grid grid-cols-2 gap-2">
                                <a wire:navigate href="{{ route('profile.show', $profile->id) }}" class="btn btn-outline btn-sm rounded-xl text-xs font-bold border-slate-200 hover:bg-slate-900 hover:text-white flex items-center justify-center tap-active">
                                    Full Details
                                </a>

                                @php $connectStatus = $myConnects[$profile->id] ?? null; @endphp
                                @if($connectStatus === 'pending')
                                    <button disabled class="btn btn-sm rounded-xl text-xs font-bold bg-slate-100 text-slate-400">
                                        <i class="fa-solid fa-clock"></i> Sent
                                    </button>
                                @elseif($connectStatus === 'accepted')
                                    <a wire:navigate href="{{ route('messages', $profile->id) }}" class="btn btn-sm btn-success text-white rounded-xl text-xs font-bold tap-active">
                                        <i class="fa-solid fa-comment"></i> Chat
                                    </a>
                                @else
                                    <button type="button" wire:click="sendConnect({{ $profile->id }})" class="btn btn-sm rounded-xl text-xs font-bold bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white shadow-md shadow-rose-200 tap-active">
                                        <i class="fa-solid fa-user-plus"></i> Connect
                                    </button>
                                @endif
                            </div>

                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-slate-200/80 p-6">
                            <div class="w-16 h-16 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center text-2xl mx-auto mb-4">
                                <i class="fa-solid fa-user-slash"></i>
                            </div>
                            <h3 class="text-base font-black text-slate-800">No Matching Profiles Found</h3>
                            <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1">Try resetting your filters or selecting "All" to browse more members.</p>
                            <button wire:click="resetFilters" class="btn btn-sm btn-primary rounded-xl text-xs font-bold mt-4">
                                Clear All Filters
                            </button>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $profiles->links() }}
                </div>
            </div>

        </div>
    </div>

    <!-- Mobile Slide-Up Filter Bottom Sheet Modal -->
    <div x-show="mobileFilterOpen" 
         x-transition:enter="transition-opacity ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs md:hidden"
         style="display: none;"
         @click="mobileFilterOpen = false">
        
        <div x-show="mobileFilterOpen"
             x-transition:enter="transition ease-out duration-250 transform"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full"
             class="fixed inset-x-0 bottom-0 bg-white rounded-t-3xl max-h-[85vh] flex flex-col justify-between shadow-2xl z-50 overflow-hidden"
             @click.stop>
            
            <!-- Handle & Header -->
            <div class="p-4 border-b border-slate-100 flex items-center justify-between shrink-0 bg-slate-50/50">
                <div class="w-10 h-1 rounded-full bg-slate-300 mx-auto absolute left-1/2 -translate-x-1/2 top-2"></div>
                <h3 class="font-extrabold text-sm text-slate-900 flex items-center gap-2 mt-1">
                    <i class="fa-solid fa-sliders text-rose-500"></i> Match Filters
                </h3>
                <button wire:click="resetFilters" class="text-xs font-bold text-rose-600">Reset All</button>
            </div>

            <!-- Scrollable Form Inputs -->
            <div class="p-5 overflow-y-auto space-y-4 text-xs">
                
                <!-- Gender -->
                <div>
                    <label class="block font-bold uppercase text-slate-400 mb-1">Looking For</label>
                    <div class="grid grid-cols-2 gap-2">
                        <button type="button" wire:click="$set('gender', 'female')" class="btn btn-sm {{ $gender === 'female' ? 'btn-primary' : 'btn-outline border-slate-200' }} rounded-xl text-xs font-bold">
                            <i class="fa-solid fa-venus"></i> Brides
                        </button>
                        <button type="button" wire:click="$set('gender', 'male')" class="btn btn-sm {{ $gender === 'male' ? 'btn-primary' : 'btn-outline border-slate-200' }} rounded-xl text-xs font-bold">
                            <i class="fa-solid fa-mars"></i> Grooms
                        </button>
                    </div>
                </div>

                <!-- Verified Toggle -->
                <div class="p-3 bg-emerald-50 rounded-2xl border border-emerald-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-certificate text-emerald-600 text-sm"></i>
                        <span class="font-bold text-emerald-950">Verified Profiles Only</span>
                    </div>
                    <input type="checkbox" wire:model.live="verifiedOnly" class="checkbox checkbox-sm checkbox-success">
                </div>

                <!-- Profile Created By -->
                <div>
                    <label class="block font-bold uppercase text-slate-400 mb-1">Profile Created By</label>
                    <select wire:model.live="profile_created_by" class="select select-bordered select-sm w-full rounded-xl text-xs">
                        <option value="">Any</option>
                        <option value="self">Self</option>
                        <option value="parents">Parents</option>
                        <option value="sibling">Sibling</option>
                        <option value="relative">Relative</option>
                        <option value="friend">Friend</option>
                    </select>
                </div>

                <!-- Religion -->
                <div>
                    <label class="block font-bold uppercase text-slate-400 mb-1">Religion</label>
                    <select wire:model.live="religion" class="select select-bordered select-sm w-full rounded-xl text-xs">
                        <option value="">All Religions</option>
                        @foreach($religions as $r)
                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Caste -->
                <div>
                    <label class="block font-bold uppercase text-slate-400 mb-1">Caste / Community</label>
                    <select wire:model.live="caste" class="select select-bordered select-sm w-full rounded-xl text-xs">
                        <option value="">All Castes</option>
                        @foreach($castes as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Location -->
                <div>
                    <label class="block font-bold uppercase text-slate-400 mb-1">City / Country</label>
                    <select wire:model.live="city" class="select select-bordered select-sm w-full rounded-xl text-xs">
                        <option value="">Any Location</option>
                        @foreach($cities as $ct)
                            <option value="{{ $ct->name }}">{{ $ct->name }} ({{ $ct->country }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Diet -->
                <div>
                    <label class="block font-bold uppercase text-slate-400 mb-1">Diet Preference</label>
                    <select wire:model.live="diet" class="select select-bordered select-sm w-full rounded-xl text-xs">
                        <option value="">Any Diet</option>
                        <option value="vegetarian">Vegetarian</option>
                        <option value="non_vegetarian">Non-Vegetarian</option>
                    </select>
                </div>
            </div>

            <!-- Sticky Apply Button -->
            <div class="p-4 border-t border-slate-100 bg-white shrink-0">
                <button @click="mobileFilterOpen = false" class="btn btn-primary w-full rounded-xl font-bold text-xs shadow-md shadow-rose-200">
                    Show {{ $profiles->total() }} Matches
                </button>
            </div>
        </div>
    </div>

    <!-- Interactive Profile Detail Modal -->
    @if($selectedProfile)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-xs flex items-center justify-center p-3 sm:p-4">
            <div class="bg-white rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-slate-100 relative">
                
                <!-- Close button -->
                <button wire:click="closeProfileModal" class="absolute top-3 right-3 z-10 w-8 h-8 rounded-full bg-black/50 text-white hover:bg-black flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>

                <!-- Profile Cover & Avatar Header -->
                <div class="relative h-28 sm:h-32 bg-gradient-to-r from-rose-800 via-pink-800 to-indigo-900">
                    <div class="absolute bottom-3 left-4 sm:left-6 flex items-end gap-3 sm:gap-4 text-white">
                        <div class="relative shrink-0">
                            <img src="{{ $selectedProfile->avatar_url }}" alt="{{ $selectedProfile->name }}" class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl object-cover border-4 border-white shadow-lg">
                            @if($selectedProfile->isOnline())
                                <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-emerald-500 rounded-full ring-2 ring-white shadow-xs" title="Online Now"></span>
                            @else
                                <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-slate-400 rounded-full ring-2 ring-white shadow-xs" title="Offline"></span>
                            @endif
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <h2 class="text-base sm:text-xl font-black">{{ $selectedProfile->name }}, {{ $selectedProfile->age }}</h2>
                                @if($selectedProfile->is_verified)
                                    <span class="bg-emerald-500 text-white text-[9px] font-bold px-2 py-0.5 rounded-full"><i class="fa-solid fa-check"></i> Verified</span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-200 mt-0.5">
                                <i class="fa-solid fa-location-dot text-rose-400 mr-1"></i> {{ $selectedProfile->profile->living_city ?? 'Kathmandu' }}, {{ $selectedProfile->profile->living_country ?? 'Nepal' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-4 sm:p-5 space-y-4">
                    @if($selectedProfile->profile && $selectedProfile->profile->about_me)
                        <div>
                            <h4 class="text-[10px] font-bold uppercase text-slate-400 mb-1 tracking-wider">About Myself</h4>
                            <p class="text-xs sm:text-sm text-slate-700 bg-slate-50 p-3 sm:p-4 rounded-2xl border border-slate-100 leading-relaxed">
                                {{ $selectedProfile->profile->about_me }}
                            </p>
                        </div>
                    @endif

                    <!-- Cultural & Astrological Grid -->
                    <div>
                        <h4 class="text-[10px] font-bold uppercase text-slate-400 mb-1.5 tracking-wider">Cultural & Astrological Details</h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2.5 text-xs bg-slate-50 p-3 sm:p-4 rounded-2xl border border-slate-100">
                            <div><span class="text-slate-400 block text-[10px]">Religion:</span> <span class="font-bold text-slate-800">{{ $selectedProfile->profile->religion->name ?? 'Hindu' }}</span></div>
                            <div><span class="text-slate-400 block text-[10px]">Caste:</span> <span class="font-bold text-slate-800">{{ $selectedProfile->profile->caste->name ?? 'Brahmin' }}</span></div>
                            <div><span class="text-slate-400 block text-[10px]">Sub-Caste:</span> <span class="font-bold text-slate-800">{{ $selectedProfile->profile->sub_caste ?? 'N/A' }}</span></div>
                            <div><span class="text-slate-400 block text-[10px]">Rashi (Zodiac):</span> <span class="font-bold text-indigo-600">{{ $selectedProfile->profile->rashi ?? 'N/A' }}</span></div>
                            <div><span class="text-slate-400 block text-[10px]">Gotra:</span> <span class="font-bold text-slate-800">{{ $selectedProfile->profile->gotra ?? 'N/A' }}</span></div>
                            <div><span class="text-slate-400 block text-[10px]">Manglik:</span> <span class="font-bold text-slate-800 capitalize">{{ $selectedProfile->profile->manglik ?? 'Non-Manglik' }}</span></div>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="pt-2.5 border-t border-slate-100 flex justify-between items-center gap-2">
                        <a wire:navigate href="{{ route('profile.show', $selectedProfile->id) }}" class="btn btn-outline btn-sm rounded-xl text-xs font-bold">
                            View Full Profile
                        </a>
                        <div class="flex gap-2">
                            <button wire:click="closeProfileModal" class="btn btn-ghost btn-sm text-slate-500 rounded-xl text-xs font-bold">Close</button>
                            <button wire:click="sendConnect({{ $selectedProfile->id }})" class="btn btn-sm bg-rose-600 hover:bg-rose-700 text-white rounded-xl font-bold text-xs shadow-md shadow-rose-200">
                                <i class="fa-solid fa-heart mr-1"></i> Connect
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif
</div>
