<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to eSewa - MeroZodi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen font-sans">
    <div class="max-w-md w-full p-8 bg-white rounded-3xl shadow-xl border border-slate-100 text-center space-y-6">
        <div class="mx-auto flex justify-center mb-2">
            <img src="{{ asset('images/payments/esewa.svg') }}" alt="eSewa ePay" class="h-12 w-auto shadow-md rounded-xl">
        </div>
        <div>
            <h2 class="text-xl font-extrabold text-slate-900">Redirecting to eSewa ePay</h2>
            <p class="text-xs text-slate-500 mt-1">Please wait while we transfer you securely to eSewa...</p>
        </div>

        <form id="esewa-form" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
            <input type="hidden" name="amount" value="{{ number_format($payment->amount, 2, '.', '') }}">
            <input type="hidden" name="tax_amount" value="{{ number_format($payment->tax_amount, 2, '.', '') }}">
            <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
            <input type="hidden" name="transaction_uuid" value="{{ $transactionUuid }}">
            <input type="hidden" name="product_code" value="{{ $productCode }}">
            <input type="hidden" name="product_service_charge" value="0">
            <input type="hidden" name="product_delivery_charge" value="0">
            <input type="hidden" name="success_url" value="{{ $successUrl }}">
            <input type="hidden" name="failure_url" value="{{ $failureUrl }}">
            <input type="hidden" name="signed_field_names" value="total_amount,transaction_uuid,product_code">
            <input type="hidden" name="signature" value="{{ $signature }}">

            <button type="submit" class="w-full py-3 bg-emerald-600 text-white font-bold text-xs rounded-xl shadow-md">
                Click here if not redirected automatically
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('esewa-form').submit();
            }, 1000);
        });
    </script>
</body>
</html>
