<div wire:poll.10s class="py-10 bg-slate-50 min-h-[90vh]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900">Activity & Interaction Center</h1>
                <p class="text-xs text-slate-500 mt-1">Manage all your matrimonial connections, shortlisted profiles, and profile visitors</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline btn-sm rounded-xl text-xs font-bold border-slate-300">
                <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm mb-6 rounded-2xl text-white font-semibold">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('info'))
            <div class="alert alert-info shadow-sm mb-6 rounded-2xl text-white font-semibold">
                <i class="fa-solid fa-circle-info"></i>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        <!-- Tab Selector -->
        <div class="bg-white rounded-3xl p-2 shadow-xs border border-slate-200/80 mb-8 flex flex-wrap gap-2">
            <button wire:click="$set('activeTab', 'received_connects')" class="px-5 py-2.5 rounded-2xl text-xs font-bold transition flex items-center gap-2 {{ $activeTab === 'received_connects' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-50' }}">
                <i class="fa-solid fa-inbox"></i> Received Requests ({{ $receivedConnects->count() }})
            </button>
            <button wire:click="$set('activeTab', 'sent_connects')" class="px-5 py-2.5 rounded-2xl text-xs font-bold transition flex items-center gap-2 {{ $activeTab === 'sent_connects' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-50' }}">
                <i class="fa-solid fa-paper-plane"></i> Sent Requests ({{ $sentConnects->count() }})
            </button>
            <button wire:click="$set('activeTab', 'likes')" class="px-5 py-2.5 rounded-2xl text-xs font-bold transition flex items-center gap-2 {{ $activeTab === 'likes' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-50' }}">
                <i class="fa-solid fa-heart text-rose-500"></i> My Shortlist ({{ $likedProfiles->count() }})
            </button>
            <button wire:click="$set('activeTab', 'visitors')" class="px-5 py-2.5 rounded-2xl text-xs font-bold transition flex items-center gap-2 {{ $activeTab === 'visitors' ? 'bg-slate-900 text-white shadow-md' : 'text-slate-600 hover:bg-slate-50' }}">
                <i class="fa-solid fa-eye text-indigo-500"></i> Profile Visitors ({{ $profileVisitors->count() }})
            </button>
        </div>

        <!-- Tab Content Cards -->
        <div class="bg-white rounded-3xl p-6 md:p-8 shadow-xs border border-slate-200/80">
            
            <!-- Received Requests -->
            @if($activeTab === 'received_connects')
                <h2 class="text-base font-bold text-slate-900 mb-6">Received Connection Requests</h2>
                @if($receivedConnects->count() > 0)
                    <div class="space-y-4">
                        @foreach($receivedConnects as $rc)
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                                <div class="flex items-center gap-4 w-full md:w-auto">
                                    <div class="relative shrink-0">
                                        <img src="{{ $rc->sender->avatar_url }}" alt="{{ $rc->sender->name }}" class="w-14 h-14 rounded-2xl object-cover">
                                        @if($rc->sender->isOnline())
                                            <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-emerald-500 rounded-full ring-2 ring-white shadow-xs" title="Online Now"></span>
                                        @else
                                            <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-slate-400 rounded-full ring-2 ring-white shadow-xs" title="Offline"></span>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('profile.show', $rc->sender->id) }}" class="font-bold text-slate-900 text-sm hover:text-rose-600 transition">
                                            {{ $rc->sender->name }}, {{ $rc->sender->age }}
                                        </a>
                                        <p class="text-xs text-slate-500">
                                            {{ $rc->sender->profile?->living_city ?? 'Kathmandu' }} &bull; {{ $rc->sender->profile?->caste?->name ?? 'Nepali' }} &bull; Received {{ $rc->created_at->diffForHumans() }}
                                        </p>
                                        @if($rc->message)
                                            <p class="text-xs italic text-slate-600 mt-1 bg-white p-2 rounded-xl border border-slate-100 max-w-lg">
                                                "{{ $rc->message }}"
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 w-full md:w-auto justify-end">
                                    @if($rc->status === 'pending')
                                        <button wire:click="acceptConnect({{ $rc->id }})" class="btn btn-sm btn-primary rounded-xl text-xs font-bold bg-rose-600 border-none text-white hover:bg-rose-700">
                                            <i class="fa-solid fa-check"></i> Accept
                                        </button>
                                        <button wire:click="declineConnect({{ $rc->id }})" class="btn btn-sm btn-ghost text-slate-400 rounded-xl text-xs">
                                            Decline
                                        </button>
                                    @elseif($rc->status === 'accepted')
                                        <span class="badge badge-success text-white text-xs font-bold p-3">Connected</span>
                                        <a href="{{ route('messages.chat', $rc->sender->id) }}" class="btn btn-sm btn-outline rounded-xl text-xs font-bold">
                                            <i class="fa-solid fa-comments"></i> Chat
                                        </a>
                                    @else
                                        <span class="badge badge-ghost text-xs text-slate-400 p-3">Declined</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-12 text-center text-slate-400 text-xs">
                        <i class="fa-regular fa-envelope text-4xl mb-3 block text-slate-300"></i>
                        No connection requests received yet.
                    </div>
                @endif
            @endif

            <!-- Sent Requests -->
            @if($activeTab === 'sent_connects')
                <h2 class="text-base font-bold text-slate-900 mb-6">Sent Connection Requests</h2>
                @if($sentConnects->count() > 0)
                    <div class="space-y-4">
                        @foreach($sentConnects as $sc)
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                                <div class="flex items-center gap-4 w-full md:w-auto">
                                    <div class="relative shrink-0">
                                        <img src="{{ $sc->receiver->avatar_url }}" alt="{{ $sc->receiver->name }}" class="w-14 h-14 rounded-2xl object-cover">
                                        @if($sc->receiver->isOnline())
                                            <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-emerald-500 rounded-full ring-2 ring-white shadow-xs" title="Online Now"></span>
                                        @else
                                            <span class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-slate-400 rounded-full ring-2 ring-white shadow-xs" title="Offline"></span>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('profile.show', $sc->receiver->id) }}" class="font-bold text-slate-900 text-sm hover:text-rose-600 transition">
                                            {{ $sc->receiver->name }}, {{ $sc->receiver->age }}
                                        </a>
                                        <p class="text-xs text-slate-500">
                                            {{ $sc->receiver->profile?->living_city ?? 'Kathmandu' }} &bull; Sent {{ $sc->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 w-full md:w-auto justify-end">
                                    @if($sc->status === 'pending')
                                        <span class="badge badge-warning text-slate-900 text-xs font-bold p-3">Pending Response</span>
                                        <button wire:click="cancelSentConnect({{ $sc->id }})" wire:confirm="Cancel this connection request?" class="btn btn-sm btn-ghost text-slate-400 rounded-xl text-xs">
                                            Cancel
                                        </button>
                                    @elseif($sc->status === 'accepted')
                                        <span class="badge badge-success text-white text-xs font-bold p-3">Request Accepted!</span>
                                        <a href="{{ route('messages.chat', $sc->receiver->id) }}" class="btn btn-sm btn-primary rounded-xl text-xs font-bold bg-rose-600 border-none text-white">
                                            <i class="fa-solid fa-comments"></i> Start Chat
                                        </a>
                                    @else
                                        <span class="badge badge-ghost text-xs text-slate-400 p-3">Declined</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-12 text-center text-slate-400 text-xs">
                        <i class="fa-regular fa-paper-plane text-4xl mb-3 block text-slate-300"></i>
                        You have not sent any connection requests yet.
                    </div>
                @endif
            @endif

            <!-- Liked Profiles -->
            @if($activeTab === 'likes')
                <h2 class="text-base font-bold text-slate-900 mb-6">My Shortlisted & Favorite Profiles</h2>
                @if($likedProfiles->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($likedProfiles as $lp)
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-between group">
                                <div>
                                    <div class="relative w-full h-44 mb-3 overflow-hidden rounded-xl">
                                        <img src="{{ $lp->liked->avatar_url }}" alt="{{ $lp->liked->name }}" class="w-full h-full object-cover">
                                        @if($lp->liked->isOnline())
                                            <span class="absolute top-2.5 right-2.5 bg-black/60 backdrop-blur-md text-white text-[10px] font-bold px-2 py-0.5 rounded-full border border-emerald-500/40 shadow-sm flex items-center gap-1.5" title="Online Now">
                                                <span class="w-2 h-2 rounded-full bg-emerald-500 ring-1.5 ring-white"></span>
                                                <span class="text-emerald-300">Online</span>
                                            </span>
                                        @else
                                            <span class="absolute top-2.5 right-2.5 bg-black/60 backdrop-blur-md text-slate-300 text-[10px] font-medium px-2 py-0.5 rounded-full border border-white/10 shadow-sm flex items-center gap-1.5" title="Offline">
                                                <span class="w-2 h-2 rounded-full bg-slate-400 ring-1.5 ring-white"></span>
                                                <span>Offline</span>
                                            </span>
                                        @endif
                                    </div>
                                    <a href="{{ route('profile.show', $lp->liked->id) }}" class="font-bold text-slate-900 text-sm hover:text-rose-600 block">
                                        {{ $lp->liked->name }}, {{ $lp->liked->age }}
                                    </a>
                                    <p class="text-xs text-slate-500">
                                        {{ $lp->liked->profile?->caste?->name ?? 'Nepali' }} &bull; {{ $lp->liked->profile?->living_city ?? 'Kathmandu' }}
                                    </p>
                                </div>
                                <div class="mt-4 pt-3 border-t border-slate-200 flex items-center justify-between">
                                    <a href="{{ route('profile.show', $lp->liked->id) }}" class="btn btn-outline btn-xs rounded-xl font-bold">
                                        View Profile
                                    </a>
                                    <button wire:click="removeLike({{ $lp->id }})" class="text-xs text-rose-600 hover:underline">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-12 text-center text-slate-400 text-xs">
                        <i class="fa-regular fa-heart text-4xl mb-3 block text-slate-300"></i>
                        No shortlisted profiles yet. Click the heart icon on any profile to save it here!
                    </div>
                @endif
            @endif

            <!-- Profile Visitors -->
            @if($activeTab === 'visitors')
                <h2 class="text-base font-bold text-slate-900 mb-6">Who Viewed Your Profile</h2>
                @if($profileVisitors->count() > 0)
                    <div class="space-y-4">
                        @foreach($profileVisitors as $pv)
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="relative shrink-0">
                                        <img src="{{ $pv->viewer->avatar_url }}" alt="{{ $pv->viewer->name }}" class="w-12 h-12 rounded-2xl object-cover">
                                        @if($pv->viewer->isOnline())
                                            <span class="absolute -top-1 -right-1 w-3 h-3 bg-emerald-500 rounded-full ring-2 ring-white shadow-xs" title="Online Now"></span>
                                        @else
                                            <span class="absolute -top-1 -right-1 w-3 h-3 bg-slate-400 rounded-full ring-2 ring-white shadow-xs" title="Offline"></span>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('profile.show', $pv->viewer->id) }}" class="font-bold text-slate-900 text-sm hover:text-rose-600 transition">
                                            {{ $pv->viewer->name }}, {{ $pv->viewer->age }}
                                        </a>
                                        <p class="text-xs text-slate-500">
                                            {{ $pv->viewer->profile?->living_city ?? 'Kathmandu' }} &bull; Viewed {{ $pv->view_count }} times &bull; Last seen {{ $pv->last_viewed_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <a href="{{ route('profile.show', $pv->viewer->id) }}" class="btn btn-outline btn-sm rounded-xl text-xs font-bold">
                                    View Match
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-12 text-center text-slate-400 text-xs">
                        <i class="fa-regular fa-eye text-4xl mb-3 block text-slate-300"></i>
                        No visitors recorded yet. Complete your profile details to increase profile visibility!
                    </div>
                @endif
            @endif

        </div>

    </div>
</div>
