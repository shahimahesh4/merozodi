<div class="py-12 bg-slate-50 min-h-[85vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 text-center">
            <span class="text-xs font-bold uppercase tracking-widest text-rose-600 bg-rose-50 px-3.5 py-1 rounded-full border border-rose-200 shadow-xs">
                <i class="fa-solid fa-shield-halved mr-1"></i> Secure Checkout & Instant VIP Activation
            </span>
            <h1 class="text-2xl md:text-3xl font-black text-slate-900 mt-3">Complete Your Premium Upgrade</h1>
            <p class="text-xs text-slate-500 mt-1">Select your preferred Nepali digital wallet or bank debit</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
            
            <!-- Left 7 cols: Payment Gateway Selection -->
            <div class="md:col-span-7 space-y-6">
                <div class="bg-white rounded-3xl p-6 md:p-8 shadow-xs border border-slate-200/80">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xs font-extrabold uppercase text-slate-400 tracking-wider">Select Digital Payment Gateway</h2>
                        <span class="text-[11px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded-md">Nepal Automated ePay</span>
                    </div>

                    <div class="space-y-3">
                        
                        <!-- eSewa -->
                        <label class="p-4 rounded-2xl border-2 flex items-center justify-between cursor-pointer transition tap-active {{ $gateway === 'esewa' ? 'border-emerald-500 bg-emerald-50/40 shadow-xs ring-2 ring-emerald-500/20' : 'border-slate-200 hover:border-slate-300' }}">
                            <div class="flex items-center gap-3">
                                <input type="radio" wire:model.live="gateway" value="esewa" class="radio radio-success radio-sm">
                                <img src="{{ asset('images/payments/esewa-icon.svg') }}" alt="eSewa" class="w-9 h-9 rounded-xl shadow-xs shrink-0">
                                <div>
                                    <span class="font-black text-slate-900 text-sm block">eSewa Mobile Wallet</span>
                                    <span class="text-[11px] text-slate-500">Instant checkout via ePay v2 HMAC Signature</span>
                                </div>
                            </div>
                            <img src="{{ asset('images/payments/esewa.svg') }}" alt="eSewa ePay" class="h-8 w-auto rounded-lg shadow-xs hidden sm:block">
                        </label>

                        <!-- Khalti -->
                        <label class="p-4 rounded-2xl border-2 flex items-center justify-between cursor-pointer transition tap-active {{ $gateway === 'khalti' ? 'border-purple-500 bg-purple-50/40 shadow-xs ring-2 ring-purple-500/20' : 'border-slate-200 hover:border-slate-300' }}">
                            <div class="flex items-center gap-3">
                                <input type="radio" wire:model.live="gateway" value="khalti" class="radio radio-secondary radio-sm">
                                <img src="{{ asset('images/payments/khalti-icon.svg') }}" alt="Khalti" class="w-9 h-9 rounded-xl shadow-xs shrink-0">
                                <div>
                                    <span class="font-black text-slate-900 text-sm block">Khalti Digital Wallet</span>
                                    <span class="text-[11px] text-slate-500">Khalti EPayment v2 REST API & Direct PIN</span>
                                </div>
                            </div>
                            <img src="{{ asset('images/payments/khalti.svg') }}" alt="Khalti" class="h-8 w-auto rounded-lg shadow-xs hidden sm:block">
                        </label>

                        <!-- Fonepay -->
                        <label class="p-4 rounded-2xl border-2 flex items-center justify-between cursor-pointer transition tap-active {{ $gateway === 'fonepay' ? 'border-rose-500 bg-rose-50/40 shadow-xs ring-2 ring-rose-500/20' : 'border-slate-200 hover:border-slate-300' }}">
                            <div class="flex items-center gap-3">
                                <input type="radio" wire:model.live="gateway" value="fonepay" class="radio radio-primary radio-sm">
                                <img src="{{ asset('images/payments/fonepay-icon.svg') }}" alt="Fonepay" class="w-9 h-9 rounded-xl shadow-xs shrink-0">
                                <div>
                                    <span class="font-black text-slate-900 text-sm block">Fonepay Merchant Dynamic QR</span>
                                    <span class="text-[11px] text-slate-500">Scan & Pay with any Nepal Mobile Banking App</span>
                                </div>
                            </div>
                            <img src="{{ asset('images/payments/fonepay.svg') }}" alt="Fonepay" class="h-8 w-auto rounded-lg shadow-xs hidden sm:block">
                        </label>

                        <!-- ConnectIPS -->
                        <label class="p-4 rounded-2xl border-2 flex items-center justify-between cursor-pointer transition tap-active {{ $gateway === 'connectips' ? 'border-blue-500 bg-blue-50/40 shadow-xs ring-2 ring-blue-500/20' : 'border-slate-200 hover:border-slate-300' }}">
                            <div class="flex items-center gap-3">
                                <input type="radio" wire:model.live="gateway" value="connectips" class="radio radio-info radio-sm">
                                <img src="{{ asset('images/payments/connectips-icon.svg') }}" alt="ConnectIPS" class="w-9 h-9 rounded-xl shadow-xs shrink-0">
                                <div>
                                    <span class="font-black text-slate-900 text-sm block">ConnectIPS (NCHL Direct Debit)</span>
                                    <span class="text-[11px] text-slate-500">Direct Real-Time Inter-Bank Account Transfer</span>
                                </div>
                            </div>
                            <img src="{{ asset('images/payments/connectips.svg') }}" alt="ConnectIPS" class="h-8 w-auto rounded-lg shadow-xs hidden sm:block">
                        </label>

                    </div>
                </div>

                <!-- Promo Code / Coupon Section -->
                <div class="bg-white rounded-3xl p-6 shadow-xs border border-slate-200/80">
                    <h2 class="text-xs font-extrabold uppercase text-slate-400 tracking-wider mb-3 flex items-center gap-1.5">
                        <i class="fa-solid fa-tag text-rose-500"></i> Have a Promo / Festive Coupon?
                    </h2>

                    @if($appliedCoupon)
                        <div class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-xs">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                                <div>
                                    <span class="font-black text-emerald-900 text-xs">{{ $appliedCoupon->code }}</span>
                                    <p class="text-[11px] text-emerald-700 font-medium">
                                        {{ $appliedCoupon->name }} ({{ $appliedCoupon->discount_type === 'percentage' ? $appliedCoupon->discount_value . '% OFF' : 'NPR ' . number_format($appliedCoupon->discount_value, 0) . ' OFF' }})
                                    </p>
                                </div>
                            </div>
                            <button wire:click="removeCoupon" class="btn btn-xs btn-ghost text-rose-600 hover:bg-rose-50 font-bold tap-active">
                                <i class="fa-solid fa-trash-can mr-1"></i> Remove
                            </button>
                        </div>
                    @else
                        <form wire:submit.prevent="applyCoupon" class="flex gap-2">
                            <input type="text" 
                                   wire:model="couponCode" 
                                   placeholder="Enter code (e.g. DASHAIN2026, LAGAN500)" 
                                   class="input input-bordered rounded-xl text-xs flex-1 uppercase font-bold tracking-wider focus:border-rose-500 focus:outline-none">
                            <button type="submit" 
                                    wire:loading.attr="disabled" 
                                    class="btn bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold border-none px-4 tap-active">
                                <span wire:loading.remove wire:target="applyCoupon">Apply</span>
                                <span wire:loading wire:target="applyCoupon"><i class="fa-solid fa-spinner fa-spin"></i></span>
                            </button>
                        </form>

                        <!-- Quick suggestion chips -->
                        <div class="mt-3 flex flex-wrap items-center gap-1.5 text-[11px] text-slate-500">
                            <span class="text-[10px] text-slate-400 font-semibold">Try promo codes:</span>
                            <button type="button" wire:click="$set('couponCode', 'DASHAIN2026')" class="badge badge-sm badge-outline hover:badge-primary text-slate-600 hover:text-white cursor-pointer font-bold transition">DASHAIN2026 (20% OFF)</button>
                            <button type="button" wire:click="$set('couponCode', 'LAGAN500')" class="badge badge-sm badge-outline hover:badge-primary text-slate-600 hover:text-white cursor-pointer font-bold transition">LAGAN500 (NPR 500 OFF)</button>
                            <button type="button" wire:click="$set('couponCode', 'WELCOME10')" class="badge badge-sm badge-outline hover:badge-primary text-slate-600 hover:text-white cursor-pointer font-bold transition">WELCOME10 (10% OFF)</button>
                        </div>
                    @endif

                    @if(session('coupon_error'))
                        <p class="text-xs text-rose-600 font-bold mt-2.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ session('coupon_error') }}
                        </p>
                    @endif
                    @if(session('coupon_success'))
                        <p class="text-xs text-emerald-600 font-bold mt-2.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-check"></i> {{ session('coupon_success') }}
                        </p>
                    @endif
                    @if(session('coupon_info'))
                        <p class="text-xs text-slate-500 font-medium mt-2.5">
                            {{ session('coupon_info') }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Right 5 cols: Order Summary & VAT breakdown -->
            <div class="md:col-span-5 space-y-6">
                <div class="bg-white rounded-3xl p-6 md:p-8 shadow-xs border border-slate-200/80 space-y-5">
                    <h2 class="text-xs font-extrabold uppercase text-slate-400 tracking-wider">Order Summary</h2>

                    <div class="p-4 rounded-2xl bg-gradient-to-br from-rose-50/50 to-purple-50/50 border border-rose-100/60">
                        <div class="flex items-center justify-between">
                            <h3 class="font-black text-slate-900 text-base">{{ $plan->name }}</h3>
                            <span class="badge badge-primary bg-rose-600 text-white font-bold border-none text-[10px]">VIP Plan</span>
                        </div>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $plan->description }}</p>
                        <div class="mt-3 flex items-center gap-2 text-xs font-bold text-rose-600">
                            <i class="fa-solid fa-calendar-check text-rose-500"></i>
                            <span>{{ $plan->duration_months }} Months Full Matrimonial Access</span>
                        </div>
                    </div>

                    <!-- Tax & Pricing Breakdown -->
                    <div class="space-y-2.5 text-xs text-slate-600 border-t border-b border-slate-100 py-4">
                        <div class="flex justify-between items-center">
                            <span>Package Price:</span>
                            <span class="font-bold text-slate-900">NPR {{ number_format($subtotal, 2) }}</span>
                        </div>

                        @if($discount > 0)
                            <div class="flex justify-between items-center text-emerald-600 font-bold">
                                <span class="flex items-center gap-1">
                                    <i class="fa-solid fa-tag text-[10px]"></i> Promo Discount:
                                </span>
                                <span>- NPR {{ number_format($discount, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-slate-500">
                                <span>Discounted Subtotal:</span>
                                <span class="font-semibold">NPR {{ number_format($discountedSubtotal, 2) }}</span>
                            </div>
                        @endif

                        <div class="flex justify-between items-center">
                            <span>Government VAT (13%):</span>
                            <span class="font-bold text-slate-900">NPR {{ number_format($tax, 2) }}</span>
                        </div>

                        <div class="flex justify-between items-center text-sm font-black text-slate-900 pt-3 border-t border-slate-100">
                            <span>Grand Total Payable:</span>
                            <span class="text-rose-600 text-lg">NPR {{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <!-- Instant Checkout Action Button -->
                    <button wire:click="processPayment" 
                            wire:loading.attr="disabled"
                            class="w-full py-3.5 bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white font-black text-sm rounded-2xl shadow-lg shadow-rose-200 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 tap-active">
                        <span wire:loading.remove wire:target="processPayment">
                            <i class="fa-solid fa-lock text-xs"></i> Pay NPR {{ number_format($total, 2) }} with {{ ucfirst($gateway) }}
                        </span>
                        <span wire:loading wire:target="processPayment">
                            <i class="fa-solid fa-spinner fa-spin text-sm"></i> Connecting to {{ ucfirst($gateway) }} Gateway...
                        </span>
                    </button>

                    <div class="p-3 bg-slate-50 rounded-2xl space-y-1 text-center">
                        <p class="text-[11px] text-slate-500 font-semibold flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-shield-halved text-emerald-500"></i> 256-Bit SSL Encrypted & Instant Automated Verification
                        </p>
                        <p class="text-[10px] text-slate-400">
                            Instant VAT Invoice generated with automated activation.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
