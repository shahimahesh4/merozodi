<div wire:poll.10s class="py-4 md:py-10 bg-slate-50 min-h-[90vh]">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

        <!-- Flash messages -->
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

        <!-- Welcome Banner with Profile Status -->
        <div class="bg-gradient-to-r from-rose-600 via-pink-600 to-indigo-800 rounded-3xl p-5 md:p-8 text-white shadow-xl mb-6 md:mb-8 flex flex-col md:flex-row items-center justify-between gap-4 md:gap-6">
            <div class="flex items-center gap-3.5 sm:gap-5 w-full md:w-auto">
                <div class="relative shrink-0">
                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl object-cover ring-4 ring-white/30 shadow-lg">
                    <span class="absolute -top-1.5 -right-1.5 w-4 h-4 bg-emerald-500 rounded-full ring-2 ring-white shadow-xs" title="Online Now"></span>
                    @if($user->is_verified)
                        <div class="absolute -bottom-1 -right-1 bg-emerald-500 text-white p-1 rounded-lg ring-2 ring-white text-[9px]" title="ID Verified">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    @endif
                </div>
                <div class="truncate">
                    <h1 class="text-lg sm:text-2xl font-black flex items-center gap-2 truncate">
                        <span>Namaste, {{ $user->name }}!</span>
                        @if($user->is_premium)
                            <span class="bg-amber-400 text-slate-950 text-[10px] font-black px-2 py-0.5 rounded-full shrink-0">VIP</span>
                        @endif
                    </h1>
                    <p class="text-xs text-rose-100 mt-0.5 truncate">
                        Status: <span class="font-bold uppercase">{{ $user->status }}</span> &bull; ID: #MZ-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
                    </p>
                    <!-- Profile Completion Progress -->
                    <div class="mt-2 flex items-center gap-2">
                        <span class="text-rose-200 text-[11px] font-bold">Profile Completion:</span>
                        <div class="w-28 sm:w-36 bg-white/20 rounded-full h-2 overflow-hidden shadow-inner">
                            <div class="bg-amber-300 h-2 rounded-full transition-all duration-500" style="width: {{ $user->profile_completion_percentage }}%"></div>
                        </div>
                        <span class="font-black text-amber-300 text-xs">{{ $user->profile_completion_percentage }}%</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                @if(!$user->is_verified)
                    <a wire:navigate href="{{ route('my-kyc') }}" class="flex-1 sm:flex-none px-3.5 py-2 sm:py-2.5 rounded-xl bg-white/20 hover:bg-white/30 text-white text-xs font-bold backdrop-blur-xs transition flex items-center justify-center gap-1.5 border border-white/30 tap-active">
                        <i class="fa-solid fa-id-card"></i> Verify KYC
                    </a>
                @endif
                @if(!$user->is_premium)
                    <a wire:navigate href="{{ route('pricing') }}" class="flex-1 sm:flex-none px-4 py-2 sm:py-2.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 text-xs font-black shadow-lg transition flex items-center justify-center gap-1.5 tap-active">
                        <i class="fa-solid fa-crown text-amber-950"></i> Upgrade
                    </a>
                @endif
            </div>
        </div>

        <!-- Pending Admin Verification Alert (When not yet verified) -->
        @if(!$user->is_verified)
            <div class="mb-6 md:mb-8 p-5 sm:p-6 rounded-3xl bg-amber-50 border border-amber-200/90 text-amber-900 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl shrink-0 shadow-2xs">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="inline-flex items-center gap-1 text-[10px] font-black uppercase tracking-wider text-amber-800 bg-amber-200/70 px-2.5 py-0.5 rounded-full">
                                <i class="fa-solid fa-clock"></i> Verification In Progress
                            </span>
                            <span class="text-xs font-bold text-amber-900">Admin Review Pending</span>
                        </div>
                        <h3 class="text-base sm:text-lg font-black text-amber-950">Your Matrimonial Profile is Under Admin Review</h3>
                        <p class="text-xs sm:text-sm text-amber-800/90 mt-0.5 leading-relaxed">
                            To ensure 100% verified members, profiles are visible to prospective matches after admin approval. Submit your government ID or citizenship to fast-track verification!
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2 w-full md:w-auto shrink-0">
                    <a wire:navigate href="{{ route('my-kyc') }}" class="w-full md:w-auto px-5 py-2.5 bg-amber-600 hover:bg-amber-700 text-white text-xs font-black rounded-xl shadow-md transition flex items-center justify-center gap-1.5 tap-active">
                        <i class="fa-solid fa-id-card"></i> Submit KYC for Quick Verification
                    </a>
                </div>
            </div>
        @endif

        <!-- Metric Stat Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6 md:mb-8">
            <a wire:navigate href="{{ route('my-activity') }}" class="p-4 sm:p-5 bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-xs hover:border-rose-300 hover:shadow-md transition tap-active">
                <div class="flex justify-between items-start">
                    <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider">Connects</span>
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xs sm:text-sm font-bold">
                        <i class="fa-solid fa-ring"></i>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-black text-slate-900 mt-1.5 sm:mt-2">{{ $pendingReceivedRequests->count() }}</div>
                <span class="text-[10px] sm:text-[11px] text-rose-600 font-semibold mt-0.5 block truncate">Pending requests</span>
            </a>

            <a wire:navigate href="{{ route('my-activity') }}" class="p-4 sm:p-5 bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-xs hover:border-indigo-300 hover:shadow-md transition tap-active">
                <div class="flex justify-between items-start">
                    <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider">Visitors</span>
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xs sm:text-sm font-bold">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-black text-slate-900 mt-1.5 sm:mt-2">{{ $recentVisitors->count() }}</div>
                <span class="text-[10px] sm:text-[11px] text-indigo-600 font-semibold mt-0.5 block truncate">Profile views</span>
            </a>

            <a wire:navigate href="{{ route('my-activity') }}" class="p-4 sm:p-5 bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-xs hover:border-pink-300 hover:shadow-md transition tap-active">
                <div class="flex justify-between items-start">
                    <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider">Likes</span>
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-pink-50 text-pink-600 flex items-center justify-center text-xs sm:text-sm font-bold">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-black text-slate-900 mt-1.5 sm:mt-2">{{ $recentLikes->count() }}</div>
                <span class="text-[10px] sm:text-[11px] text-pink-600 font-semibold mt-0.5 block truncate">Shortlisted count</span>
            </a>

            <a wire:navigate href="{{ route('messages') }}" class="p-4 sm:p-5 bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-xs hover:border-emerald-300 hover:shadow-md transition tap-active">
                <div class="flex justify-between items-start">
                    <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider">Messages</span>
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs sm:text-sm font-bold">
                        <i class="fa-solid fa-comment-dots"></i>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-black text-slate-900 mt-1.5 sm:mt-2">{{ $unreadMessagesCount }}</div>
                <span class="text-[10px] sm:text-[11px] text-emerald-600 font-semibold mt-0.5 block truncate">Unread chats</span>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            
            <!-- Left 2 Cols: Main Activities & Handpicked Matches -->
            <div class="lg:col-span-2 space-y-6 md:space-y-8">
                
                <!-- Pending Connection Requests Section -->
                <div class="bg-white rounded-3xl p-5 sm:p-8 shadow-xs border border-slate-200/80">
                    <div class="flex items-center justify-between mb-4 sm:mb-6 pb-3 border-b border-slate-100">
                        <h2 class="text-sm sm:text-base font-black text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-envelope-open-text text-rose-600"></i> Connection Requests
                        </h2>
                        <a wire:navigate href="{{ route('my-activity') }}" class="text-xs font-bold text-rose-600 hover:underline">View All</a>
                    </div>

                    @if($pendingReceivedRequests->count() > 0)
                        <div class="space-y-3 sm:space-y-4">
                            @foreach($pendingReceivedRequests as $req)
                                <div class="p-3.5 sm:p-4 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-4">
                                    <div class="flex items-center gap-3 w-full sm:w-auto">
                                        <div class="relative shrink-0">
                                            <img src="{{ $req->sender->avatar_url }}" alt="{{ $req->sender->name }}" class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl object-cover shadow-xs">
                                            @if($req->sender->isOnline())
                                                <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-emerald-500 rounded-full ring-2 ring-white shadow-xs" title="Online Now"></span>
                                            @else
                                                <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-slate-400 rounded-full ring-2 ring-white shadow-xs" title="Offline"></span>
                                            @endif
                                        </div>
                                        <div class="truncate">
                                            <a wire:navigate href="{{ route('profile.show', $req->sender->id) }}" class="font-extrabold text-slate-900 text-xs sm:text-sm hover:text-rose-600 transition truncate block">
                                                {{ $req->sender->name }}, {{ $req->sender->age }}
                                            </a>
                                            <p class="text-[11px] text-slate-500 truncate">
                                                {{ $req->sender->profile?->living_city ?? 'Kathmandu' }} &bull; {{ $req->sender->profile?->caste?->name ?? 'Nepali' }}
                                            </p>
                                            @if($req->message)
                                                <p class="text-[11px] italic text-slate-600 mt-1 bg-white p-2 rounded-xl border border-slate-100 max-w-md">
                                                    "{{ $req->message }}"
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 w-full sm:w-auto justify-end shrink-0 pt-1 sm:pt-0">
                                        <button wire:click="acceptRequest({{ $req->id }})" class="btn btn-sm btn-primary rounded-xl text-xs font-bold bg-rose-600 border-none text-white hover:bg-rose-700 flex-1 sm:flex-none tap-active">
                                            <i class="fa-solid fa-check"></i> Accept
                                        </button>
                                        <button wire:click="declineRequest({{ $req->id }})" class="btn btn-sm btn-ghost text-slate-400 hover:text-slate-600 rounded-xl text-xs flex-1 sm:flex-none">
                                            Decline
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-6 sm:p-8 text-center text-slate-400 text-xs">
                            <i class="fa-regular fa-envelope text-3xl mb-2 block text-slate-300"></i>
                            No pending connection requests. Browse matches and send a connect!
                        </div>
                    @endif
                </div>

                <!-- Handpicked Recommended Matches (Swipeable on Mobile) -->
                <div class="bg-white rounded-3xl p-5 sm:p-8 shadow-xs border border-slate-200/80">
                    <div class="flex items-center justify-between mb-4 sm:mb-6 pb-3 border-b border-slate-100">
                        <h2 class="text-sm sm:text-base font-black text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i> Recommended Matches
                        </h2>
                        <a wire:navigate href="{{ route('browse', ['tierTab' => 'mutual']) }}" class="text-xs font-bold text-rose-600 hover:underline">Explore More</a>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4">
                        @foreach($recommendedProfiles as $p)
                            <div class="p-3 sm:p-4 rounded-2xl bg-slate-50 border border-slate-100 text-center space-y-2.5 group hover:border-rose-200 transition">
                                <a wire:navigate href="{{ route('profile.show', $p->id) }}" class="block">
                                    <div class="relative w-16 h-16 sm:w-20 sm:h-20 mx-auto">
                                        <img src="{{ $p->avatar_url }}" alt="{{ $p->name }}" class="w-full h-full rounded-2xl object-cover shadow-xs group-hover:scale-105 transition duration-300">
                                        @if($p->isOnline())
                                            <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-emerald-500 rounded-full ring-2 ring-white shadow-xs" title="Online Now"></span>
                                        @else
                                            <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-slate-400 rounded-full ring-2 ring-white shadow-xs" title="Offline"></span>
                                        @endif
                                    </div>
                                    <h3 class="font-extrabold text-slate-900 text-xs mt-2 group-hover:text-rose-600 truncate">{{ $p->name }}, {{ $p->age }}</h3>
                                    <p class="text-[10px] text-slate-500 truncate">{{ $p->profile?->living_city ?? 'Kathmandu' }}</p>
                                </a>
                                <a wire:navigate href="{{ route('profile.show', $p->id) }}" class="btn btn-outline btn-xs w-full rounded-xl text-[10px] font-bold border-slate-200 hover:bg-slate-900 hover:text-white tap-active">
                                    View Match
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- Right Col: Quick Navigation Menu & KYC Audit Banner -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Quick Navigation Links Card -->
                <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-xs border border-slate-200/80">
                    <h3 class="font-extrabold text-xs uppercase tracking-wider text-slate-400 mb-3 sm:mb-4">My Account & Tools</h3>
                    <nav class="space-y-1 text-xs font-bold text-slate-700">
                        <a wire:navigate href="{{ route('my-profile') }}" class="p-3 rounded-2xl hover:bg-slate-50 flex items-center justify-between group transition tap-active">
                            <span class="flex items-center gap-3"><i class="fa-solid fa-user-pen text-rose-500 w-4 text-center"></i> Edit Profile</span>
                            <i class="fa-solid fa-chevron-right text-slate-300 group-hover:translate-x-1 transition text-[10px]"></i>
                        </a>
                        <a wire:navigate href="{{ route('my-gallery') }}" class="p-3 rounded-2xl hover:bg-slate-50 flex items-center justify-between group transition tap-active">
                            <span class="flex items-center gap-3"><i class="fa-solid fa-images text-pink-500 w-4 text-center"></i> Photo Album</span>
                            <i class="fa-solid fa-chevron-right text-slate-300 group-hover:translate-x-1 transition text-[10px]"></i>
                        </a>
                        <a wire:navigate href="{{ route('my-kyc') }}" class="p-3 rounded-2xl hover:bg-slate-50 flex items-center justify-between group transition tap-active">
                            <span class="flex items-center gap-3"><i class="fa-solid fa-id-card-clip text-emerald-500 w-4 text-center"></i> KYC Document Verification</span>
                            <i class="fa-solid fa-chevron-right text-slate-300 group-hover:translate-x-1 transition text-[10px]"></i>
                        </a>
                        <a wire:navigate href="{{ route('my-activity') }}" class="p-3 rounded-2xl hover:bg-slate-50 flex items-center justify-between group transition tap-active">
                            <span class="flex items-center gap-3"><i class="fa-solid fa-chart-line text-indigo-500 w-4 text-center"></i> Activity & Likes</span>
                            <i class="fa-solid fa-chevron-right text-slate-300 group-hover:translate-x-1 transition text-[10px]"></i>
                        </a>
                        <a wire:navigate href="{{ route('messages') }}" class="p-3 rounded-2xl hover:bg-slate-50 flex items-center justify-between group transition tap-active">
                            <span class="flex items-center gap-3"><i class="fa-solid fa-comments text-amber-500 w-4 text-center"></i> Real-Time Chat Inbox</span>
                            <i class="fa-solid fa-chevron-right text-slate-300 group-hover:translate-x-1 transition text-[10px]"></i>
                        </a>
                        <a wire:navigate href="{{ route('pricing') }}" class="p-3 rounded-2xl hover:bg-slate-50 flex items-center justify-between group transition tap-active">
                            <span class="flex items-center gap-3"><i class="fa-solid fa-crown text-amber-500 w-4 text-center"></i> Membership Packages</span>
                            <i class="fa-solid fa-chevron-right text-slate-300 group-hover:translate-x-1 transition text-[10px]"></i>
                        </a>
                    </nav>
                </div>

                <!-- Recent Profile Visitors Mini Feed -->
                <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-xs border border-slate-200/80">
                    <div class="flex items-center justify-between mb-3 pb-3 border-b border-slate-100">
                        <h3 class="font-extrabold text-xs uppercase tracking-wider text-slate-400">Recent Visitors</h3>
                        <a wire:navigate href="{{ route('my-activity') }}" class="text-[11px] font-bold text-rose-600 hover:underline">All</a>
                    </div>
                    @if($recentVisitors->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentVisitors as $v)
                                <div class="flex items-center justify-between text-xs">
                                    <a wire:navigate href="{{ route('profile.show', $v->viewer->id) }}" class="flex items-center gap-2.5 hover:text-rose-600 transition tap-active">
                                        <div class="relative shrink-0">
                                            <img src="{{ $v->viewer->avatar_url }}" alt="{{ $v->viewer->name }}" class="w-8 h-8 rounded-xl object-cover">
                                            @if($v->viewer->isOnline())
                                                <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 bg-emerald-500 rounded-full ring-1 ring-white shadow-xs" title="Online Now"></span>
                                            @else
                                                <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 bg-slate-400 rounded-full ring-1 ring-white shadow-xs" title="Offline"></span>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-800 block truncate max-w-[120px]">{{ $v->viewer->name }}</span>
                                            <span class="text-[10px] text-slate-400">{{ $v->viewer->profile?->living_city ?? 'Nepal' }}</span>
                                        </div>
                                    </a>
                                    <span class="text-[10px] text-slate-400">{{ $v->last_viewed_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-slate-400 text-center py-4">No visitors yet</p>
                    @endif
                </div>

            </div>

        </div>

    </div>
</div>
