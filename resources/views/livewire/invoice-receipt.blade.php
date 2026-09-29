<div class="py-10 bg-slate-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Success Alert banner if redirected from payment -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-xs print:hidden">
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

        <!-- Action Bar (Hidden when Printing/Exporting PDF) -->
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6 print:hidden">
            <a wire:navigate href="{{ route('dashboard') }}" class="btn btn-ghost btn-sm gap-2 text-slate-600 rounded-xl hover:bg-slate-200">
                <i class="fa-solid fa-arrow-left"></i> Return to Dashboard
            </a>
            <div class="flex items-center gap-2">
                <button onclick="window.print()" class="btn bg-slate-900 hover:bg-slate-800 text-white btn-sm rounded-xl font-bold shadow-sm transition tap-active">
                    <i class="fa-solid fa-print mr-1.5"></i> Print Invoice / Save PDF
                </button>
                <a wire:navigate href="{{ route('browse') }}" class="btn btn-primary bg-rose-600 hover:bg-rose-700 border-none text-white btn-sm rounded-xl font-bold shadow-md shadow-rose-200">
                    <i class="fa-solid fa-wand-magic-sparkles mr-1.5"></i> Start Browsing Matches
                </a>
            </div>
        </div>

        <!-- Official Tax Invoice Sheet -->
        <div class="bg-white rounded-3xl shadow-xl border border-slate-200 p-6 sm:p-8 md:p-12 text-slate-900 print:shadow-none print:border-none print:p-0 print:rounded-none">
            
            <!-- Invoice Header -->
            <div class="border-b-2 border-slate-900 pb-6 mb-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    
                    <!-- Left: Company Logo -->
                    <div class="shrink-0">
                        <img src="{{ asset('images/logo.png') }}" alt="MeroZodi Logo" class="h-14 w-auto object-contain">
                    </div>

                    <!-- Center: Legal Business Header & Tax Heading -->
                    <div class="text-center flex-1 px-2">
                        <div class="inline-block px-4 py-1 bg-slate-100 rounded-full border border-slate-300 text-[10px] font-black uppercase tracking-widest text-slate-700 mb-1">
                            TAX INVOICE
                        </div>
                        <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight leading-tight">
                            {{ $globalSettings['company_legal_name'] ?? 'MeroZodi' }}
                        </h1>
                        <p class="text-xs text-slate-600 mt-0.5">
                            {{ $globalSettings['office_address'] ?? 'Lazimpat, Ward No. 03, Kathmandu, Nepal' }}
                        </p>
                        <p class="text-xs text-slate-700 font-bold mt-1">
                            PAN / VAT Reg No: <span class="font-mono text-slate-950 font-black text-sm px-2 py-0.5 bg-slate-100 rounded border border-slate-300">{{ $globalSettings['company_pan_vat'] ?? '609823412' }}</span>
                        </p>
                        <p class="text-[11px] text-slate-500 mt-0.5">
                            Tel: {{ $globalSettings['helpline_phone'] ?? '+977-1-4567890' }} | Email: {{ $globalSettings['support_email'] ?? 'support@merozodi.com' }}
                        </p>
                    </div>

                    <!-- Right: Copy Designation & Status Badge -->
                    <div class="text-right shrink-0 flex flex-col items-end gap-1.5 self-start md:self-center">
                        <span class="inline-block px-3 py-1 bg-rose-50 text-rose-700 border border-rose-200 rounded-lg text-[10px] font-black uppercase tracking-wider">
                            Original (Buyer's Copy)
                        </span>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-300 rounded-lg text-xs font-black uppercase tracking-wider shadow-2xs">
                            <i class="fa-solid fa-circle-check text-emerald-600"></i> PAID
                        </div>
                        <span class="text-[11px] font-bold text-slate-500 font-mono">
                            Fiscal Year: 2083/84
                        </span>
                    </div>

                </div>
            </div>

            <!-- Two-Column Structured Metadata (Buyer & Transaction Information) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-xs">
                
                <!-- Left: Buyer Details -->
                <div class="p-4 rounded-2xl bg-slate-50/90 border border-slate-200 space-y-2">
                    <h3 class="font-black text-slate-900 uppercase tracking-wider text-[11px] border-b border-slate-200 pb-1.5 flex items-center justify-between">
                        <span>Buyer Details</span>
                        <span class="text-[10px] text-slate-400 font-mono">#MZ-{{ str_pad($payment->user->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </h3>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="text-slate-500 font-medium">Buyer Name:</span>
                        <span class="col-span-2 font-bold text-slate-900">{{ $payment->user->name }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="text-slate-500 font-medium">Address:</span>
                        <span class="col-span-2 text-slate-800">{{ $payment->user->profile->current_city ?? 'Kathmandu' }}, Nepal</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="text-slate-500 font-medium">Buyer PAN:</span>
                        <span class="col-span-2 font-mono text-slate-700 font-bold">N/A (Retail Consumer)</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="text-slate-500 font-medium">Contact:</span>
                        <span class="col-span-2 text-slate-800">{{ $payment->user->phone ?? 'Phone on record' }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="text-slate-500 font-medium">Email:</span>
                        <span class="col-span-2 font-mono text-slate-800 truncate">{{ $payment->user->email }}</span>
                    </div>
                </div>

                <!-- Right: Invoice & Payment Metadata -->
                <div class="p-4 rounded-2xl bg-slate-50/90 border border-slate-200 space-y-2">
                    <h3 class="font-black text-slate-900 uppercase tracking-wider text-[11px] border-b border-slate-200 pb-1.5 flex items-center justify-between">
                        <span>Invoice Details</span>
                        <span class="text-[10px] text-emerald-600 font-bold">Electronic Invoice</span>
                    </h3>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="text-slate-500 font-medium">Invoice No:</span>
                        <span class="col-span-2 font-mono font-black text-slate-900">INV-2083/84-{{ str_pad($payment->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="text-slate-500 font-medium">Date & Time:</span>
                        <span class="col-span-2 font-mono text-slate-800">{{ $payment->created_at->format('Y-m-d') }} ({{ $payment->created_at->format('M d, Y h:i A') }} NPT)</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="text-slate-500 font-medium">Payment Mode:</span>
                        <span class="col-span-2 font-bold text-slate-900 uppercase">{{ $payment->payment_gateway ?? ($payment->gateway ?? 'Digital ePay') }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="text-slate-500 font-medium">Transaction Ref:</span>
                        <span class="col-span-2 font-mono text-slate-800 font-bold truncate">{{ $payment->gateway_reference ?? ($payment->transaction_id ?? 'N/A') }}</span>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <span class="text-slate-500 font-medium">Currency:</span>
                        <span class="col-span-2 font-mono font-bold text-slate-900">NPR (Nepali Rupees)</span>
                    </div>
                </div>

            </div>

            <!-- Itemized Services Table -->
            <div class="overflow-x-auto mb-6 border border-slate-200 rounded-2xl">
                <table class="w-full text-xs text-left">
                    <thead class="bg-slate-100/90 text-slate-800 font-extrabold uppercase text-[10px] tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="py-3 px-3 text-center w-12 border-r border-slate-200">S.N.</th>
                            <th class="py-3 px-4 border-r border-slate-200">Description of Services</th>
                            <th class="py-3 px-3 text-center w-28 border-r border-slate-200">HSN/SAC Code</th>
                            <th class="py-3 px-3 text-center w-24 border-r border-slate-200">Duration</th>
                            <th class="py-3 px-3 text-right w-28 border-r border-slate-200">Rate (NPR)</th>
                            <th class="py-3 px-3 text-right w-24 border-r border-slate-200">Discount</th>
                            <th class="py-3 px-4 text-right w-32">Taxable Amount (NPR)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @php
                            $planName = $payment->subscription?->plan?->name ?? ($payment->plan?->name ?? 'Standard Package (3 Months)');
                            $durationMonths = $payment->subscription?->plan?->duration_months ?? ($payment->plan?->duration_months ?? 3);
                            $discountAmount = (float) ($payment->discount_amount ?? 0);
                            $grossSubtotal = (float) ($payment->amount + $discountAmount);
                            $taxableAmount = (float) $payment->amount;
                            $vatAmount = (float) ($payment->tax_amount ?? ($taxableAmount * 0.13));
                            $grandTotal = (float) $payment->total_amount;
                        @endphp
                        <tr class="hover:bg-slate-50/50">
                            <td class="py-4 px-3 text-center font-bold text-slate-600 border-r border-slate-200">1</td>
                            <td class="py-4 px-4 border-r border-slate-200">
                                <span class="font-extrabold text-slate-900 text-sm block">{{ $planName }}</span>
                                <span class="text-slate-500 text-[11px] block mt-0.5 leading-relaxed">
                                    MeroZodi VIP Matrimonial Membership: Direct Verified Contacts, Kundali Milan, 1-on-1 Video Calling & Priority Matching.
                                </span>
                            </td>
                            <td class="py-4 px-3 text-center font-mono font-bold text-slate-700 border-r border-slate-200">
                                998315
                            </td>
                            <td class="py-4 px-3 text-center font-bold text-slate-800 border-r border-slate-200">
                                {{ $durationMonths }} Months
                            </td>
                            <td class="py-4 px-3 text-right font-mono font-semibold text-slate-800 border-r border-slate-200">
                                {{ number_format($grossSubtotal, 2) }}
                            </td>
                            <td class="py-4 px-3 text-right font-mono text-emerald-600 font-bold border-r border-slate-200">
                                {{ $discountAmount > 0 ? number_format($discountAmount, 2) : '0.00' }}
                            </td>
                            <td class="py-4 px-4 text-right font-mono font-black text-slate-900 bg-slate-50/50">
                                {{ number_format($taxableAmount, 2) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tax Calculation & Grand Total Breakdown Grid -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-6 items-start">
                
                <!-- Left 7 cols: Amount in Words & Notes -->
                <div class="md:col-span-7 space-y-3">
                    <div class="p-4 rounded-2xl bg-rose-50/70 border border-rose-200/80 text-xs">
                        <span class="text-slate-500 font-bold block uppercase text-[10px] tracking-wider mb-1">
                            Amount in Words:
                        </span>
                        <p class="font-extrabold text-slate-900 text-xs sm:text-sm italic leading-relaxed text-rose-950">
                            "{{ $amountInWords }}"
                        </p>
                    </div>

                    <!-- Payment Compliance Information -->
                    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 text-[11px] text-slate-600 space-y-1">
                        <p class="font-bold text-slate-800 flex items-center gap-1.5">
                            <i class="fa-solid fa-shield-halved text-emerald-600"></i>
                            Legal Electronic Tax Invoice
                        </p>
                        <p class="text-slate-500 text-[10px] leading-relaxed">
                            Issued under the Value Added Tax Act, 2052 (1996) and VAT Rules, 2053 (Rule 22) of the Inland Revenue Department (IRD), Ministry of Finance, Government of Nepal.
                        </p>
                    </div>
                </div>

                <!-- Right 5 cols: Official Tax Calculation Table -->
                <div class="md:col-span-5">
                    <div class="border border-slate-200 rounded-2xl overflow-hidden text-xs">
                        <div class="divide-y divide-slate-200 bg-slate-50/80">
                            
                            <div class="flex justify-between items-center py-2.5 px-3.5">
                                <span class="text-slate-600 font-medium">Gross Subtotal:</span>
                                <span class="font-mono font-bold text-slate-900">NPR {{ number_format($grossSubtotal, 2) }}</span>
                            </div>

                            @if($discountAmount > 0)
                                <div class="flex justify-between items-center py-2.5 px-3.5 text-emerald-700 bg-emerald-50/60">
                                    <span class="font-bold">Discount Applied:</span>
                                    <span class="font-mono font-bold">- NPR {{ number_format($discountAmount, 2) }}</span>
                                </div>
                            @endif

                            <div class="flex justify-between items-center py-2.5 px-3.5">
                                <span class="text-slate-600 font-medium">Taxable Amount:</span>
                                <span class="font-mono font-black text-slate-900">NPR {{ number_format($taxableAmount, 2) }}</span>
                            </div>

                            <div class="flex justify-between items-center py-2.5 px-3.5 bg-slate-100/60">
                                <span class="text-slate-700 font-bold flex items-center gap-1">
                                    <span>Government VAT (13%):</span>
                                </span>
                                <span class="font-mono font-black text-slate-950">NPR {{ number_format($vatAmount, 2) }}</span>
                            </div>

                            <div class="flex justify-between items-center py-2 px-3.5 text-[11px] text-slate-500">
                                <span>Non-Taxable / Exempt Amount:</span>
                                <span class="font-mono">NPR 0.00</span>
                            </div>

                            <!-- Grand Total Box -->
                            <div class="flex justify-between items-center py-3.5 px-4 bg-slate-900 text-white font-black">
                                <div>
                                    <span class="block text-[11px] uppercase tracking-wider text-rose-300">Grand Total Payable:</span>
                                    <span class="text-[9px] text-slate-400 font-normal">Inclusive of 13% Nepal VAT</span>
                                </div>
                                <span class="font-mono text-lg sm:text-xl text-white">
                                    NPR {{ number_format($grandTotal, 2) }}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer Compliance & Digital Verification Stamp -->
            <div class="pt-6 border-t-2 border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-500">
                
                <!-- Terms & Automated Signatory Note -->
                <div class="space-y-1 text-center sm:text-left">
                    <p class="font-extrabold text-slate-800 text-[11px]">
                        * This is a computer-generated official electronic tax invoice and requires no physical signature.
                    </p>
                    <p class="text-[10px] text-slate-400">
                        Thank you for placing your trust in MeroZodi - Nepal's Premier Matrimony Platform.
                    </p>
                </div>

                <!-- Digital Verification Official Stamp -->
                <div class="text-center sm:text-right shrink-0">
                    <div class="inline-block border-2 border-emerald-600 text-emerald-700 bg-emerald-50/50 rounded-2xl px-5 py-2 font-mono text-center shadow-xs">
                        <span class="block text-[11px] font-black uppercase tracking-widest text-emerald-800">
                            ✓ VERIFIED & PAID DIGITAL TAX INVOICE
                        </span>
                        <span class="block text-[9px] font-bold text-emerald-600 tracking-wider mt-0.5">
                            GOVERNMENT OF NEPAL IRD VAT COMPLIANT
                        </span>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<!-- Print Stylesheet Optimization for Legal A4 Printing -->
<style>
@media print {
    body {
        background-color: #ffffff !important;
        color: #000000 !important;
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
    }
    .print\:hidden {
        display: none !important;
    }
    nav, footer, .navbar, .footer, header {
        display: none !important;
    }
    .max-w-4xl {
        max-width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .shadow-xl, .shadow-md, .shadow-xs, .shadow-2xs {
        box-shadow: none !important;
    }
    .border {
        border-color: #cbd5e1 !important;
    }
    table {
        border-collapse: collapse !important;
        width: 100% !important;
    }
    th, td {
        border-color: #cbd5e1 !important;
    }
    @page {
        size: A4 portrait;
        margin: 12mm 15mm 12mm 15mm;
    }
}
</style>
