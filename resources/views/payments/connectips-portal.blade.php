<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConnectIPS e-Payment Gateway - MeroZodi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen font-sans">
    <div class="max-w-md w-full p-8 bg-white rounded-3xl shadow-xl border border-slate-100 text-center space-y-6">
        <div class="mx-auto flex justify-center mb-2">
            <img src="{{ asset('images/payments/connectips.svg') }}" alt="ConnectIPS NCHL" class="h-12 w-auto shadow-md rounded-xl">
        </div>
        <div>
            <h2 class="text-xl font-extrabold text-slate-900">ConnectIPS NCHL Portal</h2>
            <p class="text-xs text-slate-500 mt-1">Direct Real-Time Interbank Payment Authorization</p>
        </div>

        <div class="p-4 rounded-2xl bg-blue-50/60 border border-blue-100 text-left space-y-2 text-xs">
            <div class="flex justify-between text-slate-600">
                <span>Merchant:</span>
                <span class="font-bold text-slate-900">MeroZodi Matchmaking</span>
            </div>
            <div class="flex justify-between text-slate-600">
                <span>Transaction Ref:</span>
                <span class="font-mono text-slate-900">{{ $payment->transaction_id }}</span>
            </div>
            <div class="flex justify-between text-slate-600">
                <span>Total Payable:</span>
                <span class="font-black text-blue-700 text-sm">NPR {{ number_format($payment->total_amount, 2) }}</span>
            </div>
        </div>

        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 text-left space-y-3">
            <label class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block">Select Member Bank</label>
            <select class="select select-bordered select-sm w-full rounded-xl bg-white text-xs font-semibold text-slate-800">
                <option selected>Nabil Bank Limited</option>
                <option>Global IME Bank Limited</option>
                <option>NIC Asia Bank Limited</option>
                <option>Rastriya Banijya Bank</option>
                <option>Sanima Bank Limited</option>
                <option>Everest Bank Limited</option>
                <option>Standard Chartered Bank Nepal</option>
                <option>Himalayan Bank Limited</option>
            </select>
        </div>

        <form action="{{ route('payment.connectips.callback', $payment->id) }}" method="POST" class="space-y-3">
            @csrf
            <button type="submit" class="w-full py-3.5 bg-blue-700 hover:bg-blue-800 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-blue-200 transition">
                <i class="fa-solid fa-lock mr-1.5"></i> Authorize & Complete Payment
            </button>
            <a href="{{ route('pricing') }}" class="btn btn-ghost btn-sm w-full text-xs text-slate-400">Cancel Payment</a>
        </form>
    </div>
</body>
</html>
