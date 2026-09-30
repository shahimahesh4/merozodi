<div class="py-16 bg-slate-50 min-h-[85vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-4xl mx-auto mb-12 sm:mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-rose-600 bg-rose-50 px-3.5 py-1 rounded-full border border-rose-200/60 shadow-2xs inline-block mb-3">
                Transparent & Affordable Pricing
            </span>
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 md:whitespace-nowrap">Choose the Right Membership Plan</h1>
            <p class="text-xs sm:text-sm md:text-base text-slate-600 mt-2 max-w-2xl mx-auto">
                Upgrade to unlock direct phone numbers, instant messaging, 1-on-1 encrypted video calling, and profile boost.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            @foreach($plans as $plan)
                <div class="bg-white rounded-3xl p-8 border {{ $plan->is_popular ? 'border-2 border-rose-500 shadow-2xl relative' : 'border-slate-200/80 shadow-sm' }} flex flex-col justify-between transition duration-300 hover:shadow-xl">
                    
                    @if($plan->is_popular)
                        <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-rose-600 to-pink-600 text-white text-[11px] font-extrabold uppercase tracking-widest px-4 py-1 rounded-full shadow-md">
                            Most Popular Choice
                        </div>
                    @endif

                    <div>
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-slate-900">{{ $plan->name }}</h3>
                            <p class="text-xs text-slate-500 mt-1 min-h-[32px]">{{ $plan->description }}</p>
                        </div>

                        <!-- Price display -->
                        <div class="mb-6 pb-6 border-b border-slate-100">
                            @if($plan->price_npr == 0)
                                <div class="text-4xl font-extrabold text-slate-900">Free</div>
                                <span class="text-xs text-slate-400 font-medium">Forever free access</span>
                            @else
                                <div class="flex items-baseline gap-1">
                                    <span class="text-3xl md:text-4xl font-extrabold text-slate-900">NPR {{ number_format($plan->price_npr) }}</span>
                                </div>
                                <span class="text-xs text-slate-400 font-medium">+13% VAT Included ({{ $plan->duration_months }} Months Access)</span>
                            @endif
                        </div>

                        <!-- Features list -->
                        <ul class="space-y-3.5 text-xs text-slate-600 mb-8">
                            @if(is_array($plan->features_json))
                                @foreach($plan->features_json as $feature)
                                    <li class="flex items-center gap-2.5">
                                        <i class="fa-solid fa-circle-check text-rose-500 text-sm"></i>
                                        <span>{{ $feature }}</span>
                                    </li>
                                @endforeach
                            @endif

                            @if($plan->allows_direct_messaging)
                                <li class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-circle-check text-rose-500 text-sm"></i>
                                    <span>Real-Time WebSocket Chat</span>
                                </li>
                            @endif

                            @if($plan->allows_video_calling)
                                <li class="flex items-center gap-2.5">
                                    <i class="fa-solid fa-circle-check text-rose-500 text-sm"></i>
                                    <span>1-on-1 Encrypted Video Calling</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- Payment button -->
                    <div>
                        @if($plan->price_npr == 0)
                            <a wire:navigate href="{{ route('register') }}" class="btn btn-outline btn-block rounded-2xl text-xs font-bold border-slate-300 hover:bg-slate-900 hover:text-white tap-active">
                                Get Started Free
                            </a>
                        @else
                            <a wire:navigate href="{{ route('checkout', $plan->id) }}" class="btn btn-block rounded-2xl text-xs font-bold tap-active {{ $plan->is_popular ? 'bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white shadow-lg shadow-rose-200' : 'bg-slate-900 hover:bg-slate-800 text-white' }}">
                                <span class="hidden sm:inline">Upgrade via eSewa / Khalti / Fonepay</span>
                                <span class="sm:hidden">Upgrade Plan</span>
                            </a>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>

        <!-- Payment methods banner -->
        <div class="mt-16 text-center max-w-2xl mx-auto p-6 sm:p-8 bg-white rounded-3xl border border-slate-200/80 shadow-xs">
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4">Accepted Digital Payment Methods in Nepal</h4>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <div class="flex items-center justify-center p-2.5 rounded-2xl bg-slate-50 border border-slate-100 hover:border-emerald-300 hover:bg-emerald-50/40 transition">
                    <img src="{{ asset('images/payments/esewa.svg') }}" alt="eSewa" class="h-8 w-auto object-contain">
                </div>
                <div class="flex items-center justify-center p-2.5 rounded-2xl bg-slate-50 border border-slate-100 hover:border-purple-300 hover:bg-purple-50/40 transition">
                    <img src="{{ asset('images/payments/khalti.svg') }}" alt="Khalti" class="h-8 w-auto object-contain">
                </div>
                <div class="flex items-center justify-center p-2.5 rounded-2xl bg-slate-50 border border-slate-100 hover:border-rose-300 hover:bg-rose-50/40 transition">
                    <img src="{{ asset('images/payments/fonepay.svg') }}" alt="Fonepay" class="h-8 w-auto object-contain">
                </div>
                <div class="flex items-center justify-center p-2.5 rounded-2xl bg-slate-50 border border-slate-100 hover:border-blue-300 hover:bg-blue-50/40 transition">
                    <img src="{{ asset('images/payments/connectips.svg') }}" alt="ConnectIPS" class="h-8 w-auto object-contain">
                </div>
            </div>
        </div>

    </div>
</div>
