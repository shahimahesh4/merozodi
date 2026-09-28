<div class="py-10 bg-slate-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Alert banner if redirected from payment -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold text-lg">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-sm text-emerald-950">Payment Confirmed Successfully!</h4>
                        <p class="text-xs text-emerald-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Action Bar -->
        <div class="flex items-center justify-between mb-6 print:hidden">
            <a href="{{ route('dashboard') }}" class="btn btn-ghost btn-sm gap-2 text-slate-600">
                <i class="fa-solid fa-arrow-left"></i> Return to Dashboard
            </a>
            <div class="flex items-center gap-2">
                <button onclick="window.print()" class="btn btn-neutral btn-sm rounded-xl font-bold shadow-sm">
                    <i class="fa-solid fa-print mr-1.5"></i> Print Invoice / Save PDF
                </button>
                <a href="{{ route('browse') }}" class="btn btn-primary btn-sm rounded-xl font-bold shadow-md shadow-rose-200">
                    <i class="fa-solid fa-wand-magic-sparkles mr-1.5"></i> Start Browsing Matches
                </a>
            </div>
        </div>

        <!-- Printable Invoice Card -->
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 md:p-12 print:shadow-none print:border-none print:p-0">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-slate-100 pb-8 gap-4">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="MeroZodi Logo" class="h-12 w-auto object-contain">
                    <div>
                        <span class="text-xl font-black tracking-tight text-slate-900 block leading-none">Mero<span class="text-rose-600">Zodi</span></span>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Official VAT Tax Invoice</span>
                    </div>
                </div>
                <div class="text-left sm:text-right">
                    <span class="badge badge-success badge-sm font-bold text-white px-3 py-2 uppercase tracking-wider text-[10px]">
                        <i class="fa-solid fa-circle-check mr-1"></i> PAID
                    </span>
                    <h3 class="text-sm font-extrabold text-slate-900 mt-2 font-mono">INV-{{ $payment->id }}-{{ date('Ymd', strtotime($payment->created_at)) }}</h3>
                    <p class="text-xs text-slate-400">Date: {{ $payment->created_at->format('M d, Y h:i A') }}</p>
                </div>
            </div>

            <!-- Company & Customer Details Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 py-8 border-b border-slate-100 text-xs text-slate-600">
                <div>
                    <h4 class="font-extrabold text-slate-900 uppercase tracking-wider text-[11px] mb-2">Issued By:</h4>
                    <p class="font-bold text-slate-800">MeroZodi Matchmaking Technologies Pvt. Ltd.</p>
                    <p>Kathmandu Metropolitan City - 03, Lazimpat</p>
                    <p>Bagmati Province, Nepal</p>
                    <p class="mt-1 font-mono font-bold text-slate-700">PAN / VAT Reg No: <span class="text-slate-900">609823412</span></p>
                    <p>Support: support@merozodi.com | +977 1 4422990</p>
                </div>
                <div class="sm:text-right">
                    <h4 class="font-extrabold text-slate-900 uppercase tracking-wider text-[11px] mb-2">Billed To:</h4>
                    <p class="font-bold text-slate-800">{{ $payment->user->name }}</p>
                    <p>{{ $payment->user->email }}</p>
                    <p>{{ $payment->user->phone ?? 'Phone on record' }}</p>
                    <p>{{ $payment->user->profile->current_city ?? 'Kathmandu' }}, Nepal</p>
                    <p class="mt-1 font-mono text-slate-500">User ID: #MZ-{{ str_pad($payment->user->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>

            <!-- Payment Details Meta -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 py-6 bg-slate-50/70 rounded-2xl my-6 p-4 text-xs">
                <div>
                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Payment Gateway</span>
                    <span class="font-extrabold text-slate-800 uppercase">{{ $payment->payment_gateway }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Transaction Ref</span>
                    <span class="font-mono font-bold text-slate-800 text-[11px] truncate block">{{ $payment->gateway_reference ?? $payment->transaction_id }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Status</span>
                    <span class="font-extrabold text-emerald-600 uppercase">{{ $payment->status }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[10px] uppercase font-bold">Billing Currency</span>
                    <span class="font-extrabold text-slate-800 font-mono">NPR (रु)</span>
                </div>
            </div>

            <!-- Line Items Table -->
            <div class="overflow-x-auto">
                <table class="table w-full text-xs">
                    <thead>
                        <tr class="border-b border-slate-200 text-slate-400 uppercase text-[10px] tracking-wider">
                            <th class="py-3 px-2 text-left">Description</th>
                            <th class="py-3 px-2 text-center">Duration</th>
                            <th class="py-3 px-2 text-right">Unit Price</th>
                            <th class="py-3 px-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr>
                            <td class="py-4 px-2">
                                <span class="font-extrabold text-slate-900 block text-sm">
                                    {{ $payment->subscription?->plan?->name ?? 'MeroZodi Premium Subscription' }}
                                </span>
                                <span class="text-slate-400 text-[11px]">
                                    Unlimited Messages, Verified Contact Views, 1-on-1 Encrypted Video Calling, Priority Listing.
                                </span>
                            </td>
                            <td class="py-4 px-2 text-center font-bold text-slate-700">
                                {{ $payment->subscription?->plan?->duration_months ?? 3 }} Months
                            </td>
                            <td class="py-4 px-2 text-right font-mono text-slate-700">
                                NPR {{ number_format($payment->amount, 2) }}
                            </td>
                            <td class="py-4 px-2 text-right font-mono font-bold text-slate-900">
                                NPR {{ number_format($payment->amount, 2) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Calculation Summary -->
            <div class="flex justify-end pt-6 border-t border-slate-100">
                <div class="w-full sm:w-72 space-y-2 text-xs">
                    <div class="flex justify-between text-slate-600">
                        <span>Taxable Amount:</span>
                        <span class="font-mono font-semibold">NPR {{ number_format($payment->amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-slate-600">
                        <span>Nepal Govt VAT (13%):</span>
                        <span class="font-mono font-semibold">NPR {{ number_format($payment->tax_amount ?? ($payment->total_amount - $payment->amount), 2) }}</span>
                    </div>
                    <div class="flex justify-between text-base font-black text-slate-900 pt-3 border-t border-slate-200">
                        <span>Grand Total Paid:</span>
                        <span class="font-mono text-rose-600">NPR {{ number_format($payment->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Footer note & stamp -->
            <div class="mt-12 pt-8 border-t border-dashed border-slate-200 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-400 gap-4">
                <div class="space-y-1 text-center sm:text-left">
                    <p class="font-semibold text-slate-600">This is a computer-generated tax invoice and requires no physical signature.</p>
                    <p>Thank you for placing your trust in MeroZodi - Nepal's Premier Matrimony Platform.</p>
                </div>
                <div class="text-center sm:text-right">
                    <div class="inline-block border-2 border-emerald-600 text-emerald-600 rounded-xl px-4 py-1.5 font-mono font-black uppercase text-[10px] tracking-widest rotate-[-3deg]">
                        VERIFIED PAID DIGITAL RECEIPT
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
