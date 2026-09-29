<div class="py-8 bg-slate-900 min-h-[90vh] text-white flex flex-col justify-between">
    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8">
        
        <!-- Video Room Top Control Bar -->
        <div class="bg-slate-800/90 backdrop-blur-md rounded-3xl p-4 md:px-6 mb-6 flex flex-col sm:flex-row items-center justify-between gap-4 border border-slate-700">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-rose-600 to-pink-500 flex items-center justify-center text-white shadow-md">
                    <i class="fa-solid fa-video"></i>
                </div>
                <div>
                    <h1 class="text-sm font-bold flex items-center gap-2">
                        1-on-1 Virtual Video Date
                        <span class="bg-emerald-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">Encrypted</span>
                    </h1>
                    <p class="text-[11px] text-slate-400 font-mono">Room: {{ $roomId }}</p>
                </div>
            </div>

            <!-- Call Timer & Exit Button -->
            <div class="flex items-center gap-4" x-data="{ seconds: 0, timer: null }" x-init="timer = setInterval(() => seconds++, 1000)" x-on:destroy="clearInterval(timer)">
                <div class="px-4 py-1.5 rounded-xl bg-slate-900/80 border border-slate-700 text-xs font-mono font-bold flex items-center gap-2 text-rose-400">
                    <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                    <span x-text="new Date(seconds * 1000).toISOString().substr(14, 5)">00:00</span>
                </div>
                <a wire:navigate href="{{ route('messages') }}" class="btn btn-error btn-sm rounded-xl text-xs font-bold text-white shadow-lg shadow-rose-900/50">
                    <i class="fa-solid fa-phone-slash"></i> Leave Date
                </a>
            </div>
        </div>

        <!-- Video Container -->
        <div class="bg-slate-950 rounded-3xl overflow-hidden border border-slate-800 shadow-2xl relative min-h-[600px] flex items-center justify-center" id="jitsi-container">
            <iframe 
                src="https://meet.jit.si/{{ $roomId }}#userInfo.displayName=%22{{ urlencode(auth()->user()->name) }}%22&config.prejoinPageEnabled=false" 
                allow="camera; microphone; fullscreen; display-capture; autoplay" 
                class="w-full h-[620px] rounded-3xl border-0"
            ></iframe>
        </div>

        <!-- Video Room Safety Notice -->
        <div class="mt-6 p-4 rounded-2xl bg-slate-800/60 border border-slate-700/60 text-center text-xs text-slate-400 flex items-center justify-center gap-2">
            <i class="fa-solid fa-shield-halved text-rose-500"></i>
            <span>MeroZodi virtual dates are peer-to-peer WebRTC encrypted. Never share financial or sensitive passwords on video calls.</span>
        </div>

    </div>
</div>
