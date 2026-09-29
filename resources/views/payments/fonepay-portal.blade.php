<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fonepay Merchant QR - MeroZodi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen font-sans">
    <div class="max-w-md w-full p-8 bg-white rounded-3xl shadow-xl border border-slate-100 text-center space-y-6">
        <div class="mx-auto flex justify-center mb-2">
            <img src="{{ asset('images/payments/fonepay.svg') }}" alt="Fonepay Merchant QR" class="h-12 w-auto shadow-md rounded-xl">
        </div>
        <div>
            <h2 class="text-xl font-extrabold text-slate-900">Fonepay Dynamic Merchant QR</h2>
            <p class="text-xs text-slate-500 mt-1">Scan with any Nepali Mobile Banking App</p>
        </div>

        <!-- Simulated Dynamic QR Code -->
        <div class="p-6 bg-slate-900 rounded-3xl inline-block shadow-inner mx-auto">
            <div class="bg-white p-4 rounded-2xl">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=FONEPAY-MEROZODI-{{ $payment->transaction_id }}" alt="Fonepay QR" class="w-44 h-44 mx-auto">
            </div>
        </div>

        <div class="p-3.5 rounded-2xl bg-slate-50 text-xs font-bold text-slate-700 flex justify-between">
            <span>Total Payable:</span>
            <span class="text-rose-600">NPR {{ number_format($payment->total_amount, 2) }}</span>
        </div>

        <form action="{{ route('payment.fonepay.callback', $payment->id) }}" method="POST" class="space-y-3">
            @csrf
            <button type="submit" class="w-full py-3.5 bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-rose-200 transition">
                <i class="fa-solid fa-circle-check mr-1.5"></i> Simulate QR Scan & Complete
            </button>
            <a wire:navigate href="{{ route('pricing') }}" class="btn btn-ghost btn-sm w-full text-xs text-slate-400">Cancel</a>
        </form>
    </div>
</body>
</html>
