<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khalti Payment - MeroZodi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen font-sans">
    <div class="max-w-md w-full p-8 bg-white rounded-3xl shadow-xl border border-slate-100 text-center space-y-6">
        <div class="mx-auto flex justify-center mb-2">
            <img src="{{ asset('images/payments/khalti.svg') }}" alt="Khalti Digital Wallet" class="h-12 w-auto shadow-md rounded-xl">
        </div>
        <div>
            <h2 class="text-xl font-extrabold text-slate-900">Khalti EPayment Portal</h2>
            <p class="text-xs text-slate-500 mt-1">Transaction ID: {{ $payment->transaction_id }}</p>
        </div>

        <div class="p-4 rounded-2xl bg-purple-50 text-purple-900 text-xs font-bold space-y-1">
            <div class="flex justify-between"><span>Amount:</span><span>NPR {{ number_format($payment->amount, 2) }}</span></div>
            <div class="flex justify-between"><span>13% VAT:</span><span>NPR {{ number_format($payment->tax_amount, 2) }}</span></div>
            <div class="flex justify-between text-sm font-extrabold pt-2 border-t border-purple-200"><span>Total:</span><span>NPR {{ number_format($payment->total_amount, 2) }}</span></div>
        </div>

        <form action="{{ route('payment.khalti.callback', $payment->id) }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="pidx" value="KHALTI-PIDX-{{ time() }}">
            <button type="submit" class="w-full py-3.5 bg-purple-600 hover:bg-purple-700 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-purple-200 transition">
                <i class="fa-solid fa-circle-check mr-1.5"></i> Authorize & Pay NPR {{ number_format($payment->total_amount, 2) }}
            </button>
            <a wire:navigate href="{{ route('pricing') }}" class="btn btn-ghost btn-sm w-full text-xs text-slate-400">Cancel Payment</a>
        </form>
    </div>
</body>
</html>
