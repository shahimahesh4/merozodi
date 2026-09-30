<div class="py-8 md:py-12 bg-slate-50 min-h-[85vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 text-center">
            <span class="text-xs font-bold uppercase tracking-widest text-rose-600 bg-rose-50 px-3.5 py-1 rounded-full border border-rose-200 shadow-xs">
                <i class="fa-solid fa-shield-halved mr-1"></i> Secure Checkout & Instant VIP Activation
            </span>
            <h1 class="text-2xl md:text-3xl font-black text-slate-900 mt-3">Complete Your Premium Upgrade</h1>
            <p class="text-xs text-slate-500 mt-1">Select your preferred Nepali digital wallet or bank debit</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
            
            <!-- Left 7 cols: Payment Gateway Selection -->
            <div class="lg:col-span-7 space-y-6">
                <div class="bg-white rounded-3xl p-6 md:p-8 shadow-xs border border-slate-200/80">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-xs font-extrabold uppercase text-slate-400 tracking-wider">Select Digital Payment Gateway</h2>
                        <span class="text-[11px] text-emerald-600 font-bold bg-emerald-50 px-2.5 py-0.5 rounded-md">Nepal Automated ePay</span>
                    </div>

                    <div class="space-y-3.5">
                        @forelse($this->availableGateways as $gwKey => $gw)
                            <label class="p-4 sm:p-5 rounded-2xl border-2 flex items-center justify-between cursor-pointer transition tap-active gap-4 {{ $gateway === $gwKey ? $gw['border_active'] : 'border-slate-200 hover:border-slate-300 bg-slate-50/40' }}">
                                <div class="flex items-center gap-3.5 flex-1 min-w-0">
                                    <input type="radio" wire:model.live="gateway" value="{{ $gwKey }}" class="radio {{ $gw['radio_class'] }} radio-sm shrink-0">
                                    <img src="{{ asset($gw['icon']) }}" alt="{{ $gw['name'] }}" class="w-10 h-10 rounded-xl shadow-xs shrink-0 object-contain">
                                    <div class="min-w-0 flex-1">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <span class="font-black text-slate-900 text-sm md:text-base block">{{ $gw['name'] }}</span>
                                            @if(!empty($gw['is_sandbox']))
                                                <span class="badge badge-warning badge-xs text-[9px] font-bold uppercase tracking-wider">Test Sandbox</span>
                                            @endif
                                        </div>
                                        <span class="text-xs text-slate-500 block mt-0.5 leading-relaxed">{{ $gw['description'] }}</span>
                                    </div>
                                </div>
                                @if(!empty($gw['badge']))
                                    <img src="{{ asset($gw['badge']) }}" alt="{{ $gw['name'] }}" class="h-9 w-auto rounded-lg shadow-xs shrink-0 hidden sm:block object-contain">
                                @endif
                            </label>
                        @empty
                            <div class="p-6 rounded-2xl bg-amber-50 text-amber-900 text-xs text-center border border-amber-200">
                                <i class="fa-solid fa-triangle-exclamation text-amber-600 text-xl mb-2"></i>
                                <p class="font-bold">No payment gateways are currently enabled.</p>
                                <p class="text-slate-500 mt-1">Please contact support at {{ $globalSettings['support_email'] ?? 'support@merozodi.com' }} to complete your upgrade.</p>
                            </div>
                        @endforelse

                        <!-- Bank Transfer Offline Info (When Selected) -->
                        @if($gateway === 'bank_transfer')
                            <div class="p-4 rounded-2xl bg-amber-50/70 border border-amber-200/80 text-xs text-slate-800 space-y-2 mt-2">
                                <h4 class="font-extrabold text-amber-900 flex items-center gap-1.5">
                                    <i class="fa-solid fa-building-columns"></i> Bank Account & Transfer Details
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[11px]">
                                    <div><span class="text-slate-500 font-bold block">Bank Name:</span> {{ $globalSettings['bank_name'] ?? 'Nabil Bank Ltd.' }}</div>
                                    <div><span class="text-slate-500 font-bold block">Account Name:</span> {{ $globalSettings['bank_account_name'] ?? 'MeroZodi' }}</div>
                                    <div><span class="text-slate-500 font-bold block">Account Number:</span> <span class="font-mono font-bold text-slate-900">{{ $globalSettings['bank_account_number'] ?? '01901017500123' }}</span></div>
                                    <div><span class="text-slate-500 font-bold block">Branch:</span> {{ $globalSettings['bank_branch'] ?? 'Lazimpat Branch, Kathmandu' }}</div>
                                </div>
                                <p class="text-[10px] text-amber-800 font-medium pt-1 border-t border-amber-200/60">
                                    * After initiating, your invoice will be generated and you can upload the payment deposit slip / voucher screenshot.
                                </p>
                            </div>
                        @endif
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
                                   placeholder="Enter coupon code" 
                                   class="input input-bordered rounded-xl text-xs flex-1 uppercase font-bold tracking-wider focus:border-rose-500 focus:outline-none">
                            <button type="submit" 
                                    wire:loading.attr="disabled" 
                                    class="btn bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold border-none px-4 tap-active">
                                <span wire:loading.remove wire:target="applyCoupon">Apply</span>
                                <span wire:loading wire:target="applyCoupon"><i class="fa-solid fa-spinner fa-spin"></i></span>
                            </button>
                        </form>
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
            <div class="lg:col-span-5 space-y-6 lg:sticky lg:top-6">
                <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-xs border border-slate-200/80 space-y-6">
                    
                    <!-- Header -->
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <span class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center text-xs font-bold">
                                <i class="fa-solid fa-receipt"></i>
                            </span>
                            <h2 class="text-xs font-extrabold uppercase text-slate-800 tracking-wider">Order Summary</h2>
                        </div>
                        <a wire:navigate href="{{ route('pricing') }}" class="text-[11px] font-bold text-rose-600 hover:text-rose-700 hover:underline inline-flex items-center gap-1 transition">
                            <span>Change Plan</span>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                        </a>
                    </div>

                    <!-- Selected Plan Card -->
                    <div class="p-4 sm:p-5 rounded-2xl bg-gradient-to-br from-rose-50/70 via-pink-50/30 to-amber-50/20 border border-rose-200/70 shadow-2xs">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0 flex-1">
                                <h3 class="font-black text-slate-900 text-base sm:text-lg leading-tight">{{ $plan->name }}</h3>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $plan->description }}</p>
                            </div>
                            @if($plan->is_popular)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-gradient-to-r from-amber-500 to-rose-500 text-white shadow-xs shrink-0">
                                    <i class="fa-solid fa-crown text-[9px]"></i> Popular
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-rose-600 text-white shadow-xs shrink-0">
                                    <i class="fa-solid fa-gem text-[9px]"></i> VIP Plan
                                </span>
                            @endif
                        </div>

                        <!-- Duration Pill -->
                        <div class="mt-3.5 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-white/95 border border-rose-200/80 text-xs font-bold text-rose-700 shadow-2xs">
                            <i class="fa-solid fa-calendar-check text-rose-500 text-sm"></i>
                            <span>{{ $plan->duration_months }} Months Full Matrimonial Access</span>
                        </div>

                        <!-- Plan Included Features -->
                        @if(!empty($plan->features_json) && is_array($plan->features_json))
                            <div class="mt-4 pt-3.5 border-t border-rose-200/60 grid grid-cols-1 gap-2">
                                @foreach($plan->features_json as $feature)
                                    <div class="flex items-center gap-2 text-xs text-slate-700 font-medium">
                                        <i class="fa-solid fa-circle-check text-rose-500 text-xs shrink-0"></i>
                                        <span>{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="mt-4 pt-3.5 border-t border-rose-200/60 grid grid-cols-1 gap-2 text-xs text-slate-700 font-medium">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle-check text-rose-500 text-xs shrink-0"></i>
                                    <span>Verified Contact Numbers & Kundali Milan</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle-check text-rose-500 text-xs shrink-0"></i>
                                    <span>Unlimited Direct Chat & Interest Requests</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle-check text-rose-500 text-xs shrink-0"></i>
                                    <span>Priority Matchmaking Profile Visibility</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Tax & Pricing Breakdown -->
                    <div class="space-y-3 text-xs text-slate-600 border-t border-slate-100 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 font-medium">Package Base Fee:</span>
                            <span class="font-bold text-slate-900">NPR {{ number_format($subtotal, 2) }}</span>
                        </div>

                        @if($discount > 0)
                            <div class="flex justify-between items-center text-emerald-700 font-bold bg-emerald-50/90 px-3 py-2 rounded-xl border border-emerald-200/80">
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-tag text-emerald-600 text-xs"></i> Promo Discount ({{ $appliedCoupon->code }}):
                                </span>
                                <span>- NPR {{ number_format($discount, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-slate-500 px-0.5">
                                <span>Taxable Subtotal:</span>
                                <span class="font-semibold text-slate-800">NPR {{ number_format($discountedSubtotal, 2) }}</span>
                            </div>
                        @endif

                        <div class="flex justify-between items-center text-slate-600 px-0.5">
                            <span class="flex items-center gap-1.5">
                                <span>Government VAT (13%):</span>
                                <span class="text-[10px] text-slate-500 bg-slate-100 px-1.5 py-0.5 rounded font-medium">Standard</span>
                            </span>
                            <span class="font-bold text-slate-900">NPR {{ number_format($tax, 2) }}</span>
                        </div>

                        <!-- Grand Total Highlight Card -->
                        <div class="p-4 sm:p-5 rounded-2xl bg-rose-50 border-2 border-rose-200 flex items-center justify-between mt-3 shadow-xs">
                            <div>
                                <span class="text-xs font-black text-slate-900 uppercase tracking-wider block">Grand Total Payable</span>
                                <span class="text-[11px] text-slate-500 font-medium">Inclusive of 13% Nepal VAT</span>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-bold text-rose-500 block">NPR</span>
                                <span class="text-2xl sm:text-3xl font-black text-rose-600 tracking-tight leading-none">
                                    {{ number_format($total, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    @php
                        $selectedGatewayData = $this->availableGateways[$gateway] ?? null;
                    @endphp

                    <!-- Selected Gateway Display & Instant Pay CTA -->
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between text-xs text-slate-500 px-1">
                            <span>Selected Gateway:</span>
                            <span class="font-bold text-slate-900 flex items-center gap-1.5">
                                @if(!empty($selectedGatewayData['icon']))
                                    <img src="{{ asset($selectedGatewayData['icon']) }}" class="w-4 h-4 rounded object-contain inline-block">
                                @endif
                                {{ $selectedGatewayData['name'] ?? ucfirst($gateway) }}
                            </span>
                        </div>

                        <button wire:click="processPayment" 
                                wire:loading.attr="disabled"
                                class="w-full py-3.5 sm:py-4 px-4 sm:px-6 bg-gradient-to-r from-rose-600 via-pink-600 to-rose-600 hover:from-rose-700 hover:via-pink-700 hover:to-rose-700 active:scale-[0.99] text-white font-black text-xs sm:text-base rounded-xl sm:rounded-2xl shadow-xl shadow-rose-500/25 transition-all duration-200 transform hover:-translate-y-0.5 flex items-center justify-center gap-2 tap-active cursor-pointer">
                            <span wire:loading.remove wire:target="processPayment" class="flex items-center gap-1.5 sm:gap-2">
                                <i class="fa-solid fa-lock text-xs sm:text-sm"></i>
                                <span>Pay RS. {{ number_format($total, 2) }} <span class="hidden xs:inline sm:inline">with {{ $selectedGatewayData['name'] ?? ucfirst($gateway) }}</span></span>
                                <i class="fa-solid fa-arrow-right text-xs ml-0.5 sm:ml-1"></i>
                            </span>
                            <span wire:loading wire:target="processPayment" class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-notch fa-spin text-base"></i>
                                <span>Connecting to {{ $selectedGatewayData['name'] ?? ucfirst($gateway) }}...</span>
                            </span>
                        </button>
                    </div>

                    <!-- Trust & Guarantee Micro Grid -->
                    <div class="grid grid-cols-2 gap-2 text-left pt-1">
                        <div class="p-2.5 rounded-xl bg-slate-50/90 border border-slate-100 flex items-start gap-2">
                            <i class="fa-solid fa-shield-halved text-emerald-500 text-xs mt-0.5 shrink-0"></i>
                            <div>
                                <span class="text-[11px] font-bold text-slate-800 block leading-tight">256-Bit SSL Secure</span>
                                <span class="text-[10px] text-slate-500">Bank-grade encryption</span>
                            </div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50/90 border border-slate-100 flex items-start gap-2">
                            <i class="fa-solid fa-bolt text-amber-500 text-xs mt-0.5 shrink-0"></i>
                            <div>
                                <span class="text-[11px] font-bold text-slate-800 block leading-tight">Instant Activation</span>
                                <span class="text-[10px] text-slate-500">Immediate VIP unlock</span>
                            </div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50/90 border border-slate-100 flex items-start gap-2">
                            <i class="fa-solid fa-file-invoice-dollar text-blue-500 text-xs mt-0.5 shrink-0"></i>
                            <div>
                                <span class="text-[11px] font-bold text-slate-800 block leading-tight">Official VAT Invoice</span>
                                <span class="text-[10px] text-slate-500">13% Tax receipt</span>
                            </div>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50/90 border border-slate-100 flex items-start gap-2">
                            <i class="fa-solid fa-circle-check text-rose-500 text-xs mt-0.5 shrink-0"></i>
                            <div>
                                <span class="text-[11px] font-bold text-slate-800 block leading-tight">One-Time Payment</span>
                                <span class="text-[10px] text-slate-500">No auto-recurring fees</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
