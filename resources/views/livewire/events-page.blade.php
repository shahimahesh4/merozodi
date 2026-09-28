<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Banner -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-rose-900 via-rose-800 to-amber-900 text-white p-8 md:p-12 mb-10 shadow-xl shadow-rose-950/20">
            <div class="relative z-10 w-full space-y-4">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-bold text-rose-200">
                    <i class="fa-solid fa-calendar-check text-rose-300"></i> Exclusive Community Meets
                </span>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight leading-tight">
                    Matrimonial Mixers & Virtual Speed Dating
                </h1>
                <p class="text-sm md:text-base text-rose-100/90 leading-relaxed font-normal">
                    Connect face-to-face in curated, private, and high-trust environments. Meet genuine verified singles who are ready for commitment.
                </p>
            </div>
            <div class="absolute -right-12 -bottom-12 opacity-10 text-white pointer-events-none text-9xl">
                <i class="fa-solid fa-champagne-glasses"></i>
            </div>
        </div>

        @if(session('event_success'))
            <div class="mb-8 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-sm text-emerald-950">RSVP Confirmed!</h4>
                        <p class="text-xs text-emerald-700">{{ session('event_success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Filter & Search Bar -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4 mb-8">
            <!-- Tabs -->
            <div class="flex items-center gap-2 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
                <button wire:click="$set('filterType', 'all')" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ $filterType === 'all' ? 'bg-rose-600 text-white shadow-md shadow-rose-200' : 'bg-slate-50 text-slate-600 hover:bg-slate-100' }}">
                    All Events
                </button>
                <button wire:click="$set('filterType', 'physical')" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ $filterType === 'physical' ? 'bg-rose-600 text-white shadow-md shadow-rose-200' : 'bg-slate-50 text-slate-600 hover:bg-slate-100' }}">
                    <i class="fa-solid fa-location-dot mr-1"></i> In-Person Mixers
                </button>
                <button wire:click="$set('filterType', 'virtual_meet')" class="px-4 py-2 rounded-xl text-xs font-bold transition {{ $filterType === 'virtual_meet' ? 'bg-rose-600 text-white shadow-md shadow-rose-200' : 'bg-slate-50 text-slate-600 hover:bg-slate-100' }}">
                    <i class="fa-solid fa-video mr-1"></i> Virtual Speed Meets
                </button>
            </div>

            <!-- Search -->
            <div class="relative w-full md:w-80">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search events by city, keyword..." class="input input-bordered input-sm w-full rounded-xl pl-9 text-xs">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            </div>
        </div>

        <!-- Events Grid -->
        @if($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col group">
                        <!-- Image Banner -->
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $event->banner_image ?? 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=800&fit=crop' }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                            
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 flex gap-2">
                                @if($event->type === 'virtual_meet')
                                    <span class="badge badge-info badge-sm font-black text-white px-2.5 py-1 text-[10px] shadow">
                                        <i class="fa-solid fa-video mr-1"></i> VIRTUAL MEET
                                    </span>
                                @else
                                    <span class="badge badge-warning badge-sm font-black text-slate-900 px-2.5 py-1 text-[10px] shadow">
                                        <i class="fa-solid fa-champagne-glasses mr-1"></i> IN-PERSON
                                    </span>
                                @endif
                            </div>

                            <div class="absolute bottom-3 left-3 right-3 text-white">
                                <div class="flex items-center gap-2 text-xs font-bold text-rose-300 mb-1">
                                    <i class="fa-regular fa-clock"></i>
                                    <span>{{ $event->event_datetime->format('l, M d, Y - h:i A') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                            <div>
                                <h3 class="text-lg font-black text-slate-900 line-clamp-2 leading-snug group-hover:text-rose-600 transition">
                                    {{ $event->title }}
                                </h3>
                                
                                <div class="flex items-center gap-2 text-xs text-slate-500 mt-2">
                                    <i class="fa-solid fa-location-dot text-rose-500 shrink-0"></i>
                                    <span class="truncate">{{ $event->location_venue ?? 'Online Private Room' }}</span>
                                </div>

                                <p class="text-xs text-slate-500 mt-3 line-clamp-3 leading-relaxed">
                                    {{ $event->description }}
                                </p>
                            </div>

                            <!-- Footer / Registration -->
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <div>
                                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Entry Fee</span>
                                    <span class="text-sm font-black text-slate-900">
                                        @if($event->entry_fee_npr > 0)
                                            NPR {{ number_format($event->entry_fee_npr, 0) }}
                                        @else
                                            <span class="text-emerald-600">FREE</span>
                                        @endif
                                    </span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <button wire:click="openEventDetails({{ $event->id }})" class="btn btn-ghost btn-sm text-xs font-bold rounded-xl text-slate-600">
                                        Details & FAQ
                                    </button>
                                    @if(in_array($event->id, $registeredEvents))
                                        <button class="btn btn-success btn-sm text-xs font-bold rounded-xl text-white pointer-events-none">
                                            <i class="fa-solid fa-circle-check mr-1"></i> Reserved
                                        </button>
                                    @else
                                        <button wire:click="registerForEvent({{ $event->id }})" class="btn btn-primary btn-sm text-xs font-bold rounded-xl shadow-md shadow-rose-200">
                                            RSVP Now
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $events->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-3xl border border-slate-100 shadow-sm">
                <div class="w-16 h-16 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center text-2xl mx-auto mb-4">
                    <i class="fa-solid fa-calendar-xmark"></i>
                </div>
                <h3 class="text-base font-black text-slate-800">No Matrimonial Events Found</h3>
                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Try clearing your search query or selecting "All Events" to view upcoming schedules.</p>
                <button wire:click="$set('filterType', 'all'); $set('search', '')" class="btn btn-neutral btn-sm rounded-xl text-xs font-bold mt-4">
                    Reset Filters
                </button>
            </div>
        @endif

        <!-- FAQ / Event Detail Modal -->
        @if($selectedEventForModal)
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 overflow-y-auto">
                <div class="bg-white rounded-3xl max-w-2xl w-full p-6 md:p-8 shadow-2xl relative my-8">
                    <button wire:click="closeEventModal" class="btn btn-circle btn-ghost btn-sm absolute right-4 top-4 text-slate-400 hover:text-slate-700">
                        <i class="fa-solid fa-xmark text-base"></i>
                    </button>

                    <div class="space-y-4">
                        <span class="badge badge-primary badge-sm font-bold uppercase text-[10px]">Event Overview</span>
                        <h2 class="text-xl font-black text-slate-900">{{ $selectedEventForModal->title }}</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-4 rounded-2xl bg-slate-50 text-xs">
                            <div>
                                <span class="text-slate-400 block text-[10px] uppercase font-bold">Schedule</span>
                                <span class="font-extrabold text-slate-800">{{ $selectedEventForModal->event_datetime->format('M d, Y - h:i A') }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px] uppercase font-bold">Venue</span>
                                <span class="font-extrabold text-slate-800 truncate block">{{ $selectedEventForModal->location_venue }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px] uppercase font-bold">Capacity</span>
                                <span class="font-extrabold text-slate-800">{{ $selectedEventForModal->max_participants ?? 'Unlimited' }} Participants</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px] uppercase font-bold">Entry Fee</span>
                                <span class="font-extrabold text-rose-600">
                                    {{ $selectedEventForModal->entry_fee_npr > 0 ? 'NPR ' . number_format($selectedEventForModal->entry_fee_npr, 2) : 'Free Registration' }}
                                </span>
                            </div>
                        </div>

                        <div class="text-xs text-slate-600 leading-relaxed">
                            <h4 class="font-extrabold text-slate-900 mb-1">About this Event:</h4>
                            <p>{{ $selectedEventForModal->description }}</p>
                        </div>

                        @if($selectedEventForModal->faqs->count() > 0)
                            <div class="pt-4 border-t border-slate-100">
                                <h4 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider mb-3">Frequently Asked Questions</h4>
                                <div class="space-y-2">
                                    @foreach($selectedEventForModal->faqs as $faq)
                                        <div class="collapse collapse-plus bg-slate-50 rounded-xl border border-slate-100">
                                            <input type="radio" name="event-accordion" />
                                            <div class="collapse-title text-xs font-bold text-slate-800 py-3">
                                                {{ $faq->question }}
                                            </div>
                                            <div class="collapse-content text-xs text-slate-600">
                                                <p>{{ $faq->answer }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="pt-4 flex justify-end gap-3">
                            <button wire:click="closeEventModal" class="btn btn-ghost btn-sm text-xs font-bold">Close</button>
                            @if(in_array($selectedEventForModal->id, $registeredEvents))
                                <button class="btn btn-success btn-sm text-xs font-bold text-white pointer-events-none">
                                    <i class="fa-solid fa-check mr-1"></i> Already Reserved
                                </button>
                            @else
                                <button wire:click="registerForEvent({{ $selectedEventForModal->id }})" class="btn btn-primary btn-sm text-xs font-bold shadow-md shadow-rose-200">
                                    Confirm RSVP & Reserve Spot
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
