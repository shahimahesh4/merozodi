<div class="bg-slate-50/70 min-h-screen">
    
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
                <span class="text-rose-200/90">Company & Help</span>
                <span class="text-rose-400/60">/</span>
                <span class="text-white font-bold">Contact Us</span>
            </nav>

            <div class="max-w-lg lg:max-w-xl xl:max-w-2xl">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight drop-shadow-md">
                    {{ $page->title ?? "We're Here to Help You Find Your Soulmate" }}
                </h1>
                <p class="mt-4 text-xs sm:text-sm md:text-base text-slate-300 leading-relaxed drop-shadow-sm">
                    {{ $page->subtitle ?? "Have questions regarding Vedic Kundali matching, photo privacy, subscription payments, or KYC verification? Our friendly relationship team in Lazimpat, Kathmandu is ready to assist you." }}
                </p>

                <!-- Quick Highlights Strip / Badges -->
                <div class="mt-7 flex flex-wrap gap-3 sm:gap-4 text-xs font-bold text-slate-200">
                    <span class="flex items-center gap-1.5 bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/10 backdrop-blur-sm">
                        <i class="fa-solid fa-bolt text-amber-300"></i> Average 15-Min Response
                    </span>
                    <span class="flex items-center gap-1.5 bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/10 backdrop-blur-sm">
                        <i class="fa-solid fa-shield-halved text-emerald-400"></i> 100% Confidential
                    </span>
                    <span class="flex items-center gap-1.5 bg-white/10 px-3.5 py-1.5 rounded-xl border border-white/10 backdrop-blur-sm">
                        <i class="fa-solid fa-location-dot text-rose-400"></i> {{ $address }}
                    </span>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 sm:pb-16">

        <!-- 4 Fast Support Channel Cards (Uniform Design) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-10">
            
            <!-- 1. Phone Helpline -->
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="group bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-lg hover:border-rose-300 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl shadow-xs group-hover:bg-rose-600 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-phone-volume"></i>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-0.5 rounded-full">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Available
                        </span>
                    </div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Member Helpline</h3>
                    <p class="text-base font-black text-slate-900 mt-1 group-hover:text-rose-600 transition">{{ $phone }}</p>
                    <p class="text-xs text-slate-500 mt-1">Sun – Fri: 9:00 AM – 6:00 PM</p>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-rose-600">
                    <span>Direct Call</span>
                    <span class="group-hover:translate-x-1 transition-transform">Call Now &rarr;</span>
                </div>
            </a>

            <!-- 2. WhatsApp Instant Desk -->
            @php
                $cleanWa = preg_replace('/[^0-9]/', '', $whatsapp);
            @endphp
            <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Namaste MeroZodi Team, I need assistance regarding my matrimonial account.') }}" target="_blank" rel="noopener noreferrer" class="group bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-lg hover:border-emerald-300 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shadow-xs group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-0.5 rounded-full">
                            <i class="fa-solid fa-bolt text-emerald-600 text-[10px]"></i> Instant Chat
                        </span>
                    </div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">WhatsApp Desk</h3>
                    <p class="text-base font-black text-slate-900 mt-1 group-hover:text-emerald-600 transition">{{ $whatsapp }}</p>
                    <p class="text-xs text-slate-500 mt-1">24/7 Priority Support Desk</p>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-emerald-600">
                    <span>Chat Support</span>
                    <span class="group-hover:translate-x-1 transition-transform">Chat Live &rarr;</span>
                </div>
            </a>

            <!-- 3. Official Email -->
            <a href="mailto:{{ $email }}" class="group bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-lg hover:border-indigo-300 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl shadow-xs group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </div>
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-indigo-700 bg-indigo-50 border border-indigo-200 px-2.5 py-0.5 rounded-full">
                            <i class="fa-regular fa-clock text-indigo-600 text-[10px]"></i> 2–4h SLA
                        </span>
                    </div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Support Email</h3>
                    <p class="text-base font-black text-slate-900 mt-1 truncate group-hover:text-indigo-600 transition">{{ $email }}</p>
                    <p class="text-xs text-slate-500 mt-1">Billing, KYC & Match Inquiries</p>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-indigo-600">
                    <span>Send Message</span>
                    <span class="group-hover:translate-x-1 transition-transform">Write Email &rarr;</span>
                </div>
            </a>

            <!-- 4. Kathmandu Head Office -->
            <a href="{{ $mapDirectionsUrl }}" target="_blank" rel="noopener noreferrer" class="group bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs hover:shadow-lg hover:border-amber-300 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shadow-xs group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-amber-700 bg-amber-50 border border-amber-200 px-2.5 py-0.5 rounded-full">
                            <i class="fa-solid fa-circle-check text-amber-600 text-[10px]"></i> Verified
                        </span>
                    </div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Office Location</h3>
                    <p class="text-base font-black text-slate-900 mt-1 line-clamp-1 group-hover:text-amber-600 transition">{{ $address }}</p>
                    <p class="text-xs text-slate-500 mt-1">Bagmati Province, Nepal</p>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-amber-600">
                    <span>Kathmandu</span>
                    <span class="group-hover:translate-x-1 transition-transform">Directions &rarr;</span>
                </div>
            </a>

        </div>

        <!-- Main Form & Info Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left 7 Cols: Interactive Contact Form -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/80 shadow-sm relative">
                
                <div class="mb-6">
                    <span class="text-xs font-bold uppercase tracking-wider text-rose-600 bg-rose-50 px-3 py-1 rounded-full inline-block mb-2">
                        Get In Touch
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900">Send Us a Direct Message</h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1.5 leading-relaxed">
                        Fill out the form below and our dedicated relationship team will reach out to you promptly.
                    </p>
                </div>

                <!-- Flash Success Notification -->
                @if(session('contact_success'))
                    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 mb-6 flex items-start gap-3 shadow-xs animate-fadeIn">
                        <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 font-bold text-sm">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-sm text-emerald-950">Inquiry Received Successfully!</h4>
                            <p class="text-xs text-emerald-800 mt-0.5 leading-relaxed">{{ session('contact_success') }}</p>
                        </div>
                    </div>
                @endif

                <form wire:submit="submitInquiry" class="space-y-4">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Full Name -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                Your Full Name <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i class="fa-regular fa-user text-xs"></i>
                                </span>
                                <input type="text" 
                                       wire:model="name" 
                                       placeholder="e.g. Aayush Sharma" 
                                       class="input input-bordered w-full rounded-2xl pl-10 text-xs sm:text-sm focus:border-rose-500 focus:outline-none bg-slate-50/50 sm:bg-white @error('name') border-rose-500 @enderror">
                            </div>
                            @error('name') <span class="text-[11px] text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                Email Address <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i class="fa-regular fa-envelope text-xs"></i>
                                </span>
                                <input type="email" 
                                       wire:model="email" 
                                       placeholder="e.g. aayush@example.com" 
                                       class="input input-bordered w-full rounded-2xl pl-10 text-xs sm:text-sm focus:border-rose-500 focus:outline-none bg-slate-50/50 sm:bg-white @error('email') border-rose-500 @enderror">
                            </div>
                            @error('email') <span class="text-[11px] text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Phone / WhatsApp -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                Mobile / WhatsApp (Optional)
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-phone text-xs"></i>
                                </span>
                                <input type="text" 
                                       wire:model="phone" 
                                       placeholder="e.g. +977-98XXXXXXXX" 
                                       class="input input-bordered w-full rounded-2xl pl-10 text-xs sm:text-sm focus:border-rose-500 focus:outline-none bg-slate-50/50 sm:bg-white @error('phone') border-rose-500 @enderror">
                            </div>
                            @error('phone') <span class="text-[11px] text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Subject -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                Subject Line <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-pen-nib text-xs"></i>
                                </span>
                                <input type="text" 
                                       wire:model="subject" 
                                       placeholder="Summary of your inquiry" 
                                       class="input input-bordered w-full rounded-2xl pl-10 text-xs sm:text-sm focus:border-rose-500 focus:outline-none bg-slate-50/50 sm:bg-white @error('subject') border-rose-500 @enderror">
                            </div>
                            @error('subject') <span class="text-[11px] text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Message Body -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Detailed Message <span class="text-rose-500">*</span>
                        </label>
                        <textarea wire:model="message" 
                                  rows="5" 
                                  placeholder="Please provide specifics (e.g. Profile ID, verification issue, payment transaction number, or matchmaking question)..." 
                                  class="textarea textarea-bordered w-full rounded-2xl text-xs sm:text-sm focus:border-rose-500 focus:outline-none bg-slate-50/50 sm:bg-white p-3.5 @error('message') border-rose-500 @enderror"></textarea>
                        @error('message') <span class="text-[11px] text-rose-500 font-semibold mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Safety & Submission Action -->
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-2 text-[11px] text-slate-400">
                            <i class="fa-solid fa-lock text-emerald-500"></i>
                            <span>Protected by 256-Bit SSL encryption</span>
                        </div>

                        <button type="submit" 
                                wire:loading.attr="disabled" 
                                class="w-full sm:w-auto btn bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 border-none text-white rounded-2xl text-xs sm:text-sm font-black px-8 py-3.5 shadow-lg shadow-rose-200 transition transform hover:-translate-y-0.5 tap-active flex items-center justify-center gap-2">
                            <span wire:loading.remove wire:target="submitInquiry" class="flex items-center gap-2">
                                <i class="fa-solid fa-paper-plane text-xs"></i>
                                <span>Submit Inquiry</span>
                            </span>
                            <span wire:loading wire:target="submitInquiry" class="flex items-center gap-2">
                                <i class="fa-solid fa-spinner fa-spin text-sm"></i>
                                <span>Sending to Support...</span>
                            </span>
                        </button>
                    </div>

                </form>

            </div>

            <!-- Right 5 Cols: Support Timings, FAQs & Confidentiality -->
            <div class="lg:col-span-5 space-y-6">

                <!-- Support Timings & Service Level Agreement Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-sm space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-wider text-rose-600 bg-rose-50 px-2.5 py-0.5 rounded-full">
                                Service Level Agreement
                            </span>
                            <h3 class="font-black text-slate-900 text-base mt-1.5 flex items-center gap-2">
                                <i class="fa-solid fa-headset text-rose-600"></i> Working Hours & Support
                            </h3>
                        </div>
                    </div>

                    <div class="space-y-2.5 text-xs">
                        <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-50 border border-slate-100">
                            <span class="font-bold text-slate-700 flex items-center gap-2">
                                <i class="fa-regular fa-calendar-check text-rose-500"></i> Sunday – Friday
                            </span>
                            <span class="font-black text-slate-900">9:00 AM – 6:00 PM NPT</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-50 border border-slate-100">
                            <span class="font-bold text-slate-700 flex items-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-500"></i> Saturday & Holidays
                            </span>
                            <span class="text-emerald-700 font-bold">24/7 WhatsApp Desk</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-50 border border-slate-100">
                            <span class="font-bold text-slate-700 flex items-center gap-2">
                                <i class="fa-solid fa-id-card-clip text-indigo-500"></i> KYC ID Audits
                            </span>
                            <span class="font-black text-slate-900">1 – 2 Hours Average</span>
                        </div>
                    </div>
                </div>

                <!-- Interactive Frequently Asked Questions (FAQ) Accordion (Dynamic) -->
                @if(is_array($faqs) && count($faqs) > 0)
                    <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-sm"
                         x-data="{ activeFaq: 0 }">
                        <div class="mb-4">
                            <span class="text-[10px] font-black uppercase tracking-wider text-rose-600 bg-rose-50 px-2.5 py-0.5 rounded-full">
                                Quick Answers
                            </span>
                            <h3 class="font-black text-slate-900 text-base mt-1.5">Frequently Asked Questions</h3>
                        </div>

                        <div class="space-y-2.5">
                            @foreach($faqs as $fIndex => $f)
                                <div class="border border-slate-200/80 rounded-2xl overflow-hidden">
                                    <button type="button" 
                                            @click="activeFaq = (activeFaq === {{ $fIndex }} ? null : {{ $fIndex }})" 
                                            class="w-full p-3.5 text-left text-xs font-black text-slate-800 flex items-center justify-between gap-2 hover:bg-slate-50 transition">
                                        <span>{{ $f['question'] ?? 'Question' }}</span>
                                        <i class="fa-solid fa-chevron-down text-slate-400 text-[10px] transition-transform duration-200" :class="activeFaq === {{ $fIndex }} ? 'rotate-180 text-rose-600' : ''"></i>
                                    </button>
                                    <div x-show="activeFaq === {{ $fIndex }}" x-collapse class="px-3.5 pb-3.5 pt-1 text-xs text-slate-500 leading-relaxed border-t border-slate-100 bg-slate-50/50" {!! $fIndex !== 0 ? 'style="display: none;"' : '' !!}>
                                        {!! nl2br(e($f['answer'] ?? '')) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Confidentiality & Security Guarantee Card -->
                <div class="bg-gradient-to-br from-indigo-900 to-purple-950 rounded-3xl p-6 text-white shadow-lg relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-purple-500/20 rounded-full blur-2xl"></div>
                    <div class="relative z-10 flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-2xl bg-white/10 backdrop-blur text-amber-300 flex items-center justify-center text-lg font-bold shrink-0 border border-white/10">
                            <i class="fa-solid fa-shield-cat"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-sm text-white">Confidential Matchmaking Promise</h4>
                            <p class="text-xs text-purple-200 mt-1 leading-relaxed">
                                We value your family honor and digital privacy. All inquiries, documents, and biodatas are encrypted and never shared with external advertisers.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
