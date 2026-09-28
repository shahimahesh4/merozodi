<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentGatewayController extends Controller
{
    // ==========================================
    // 1. eSewa ePay v2
    // ==========================================
    public function initiateEsewa($paymentId)
    {
        $payment = Payment::with('user')->findOrFail($paymentId);
        $productCode = env('ESEWA_PRODUCT_CODE', 'EPAYTEST');
        $secretKey = env('ESEWA_SECRET_KEY', '8gBm/:&EnhH.1/q');

        $totalAmount = number_format($payment->total_amount, 2, '.', '');
        $transactionUuid = $payment->transaction_id;

        // Signature generation: total_amount,transaction_uuid,product_code
        $dataToSign = "total_amount={$totalAmount},transaction_uuid={$transactionUuid},product_code={$productCode}";
        $signature = base64_encode(hash_hmac('sha256', $dataToSign, $secretKey, true));

        $successUrl = route('payment.esewa.success');
        $failureUrl = route('payment.esewa.failure');

        return view('payments.esewa-redirect', [
            'payment' => $payment,
            'productCode' => $productCode,
            'totalAmount' => $totalAmount,
            'transactionUuid' => $transactionUuid,
            'signature' => $signature,
            'successUrl' => $successUrl,
            'failureUrl' => $failureUrl,
        ]);
    }

    public function esewaSuccess(Request $request)
    {
        // eSewa returns encoded payload 'data' in GET query
        $encodedData = $request->query('data');
        if (!$encodedData) {
            return redirect()->route('pricing')->with('error', 'Invalid response from eSewa.');
        }

        $decoded = json_decode(base64_decode($encodedData), true);
        if (!$decoded || !isset($decoded['transaction_uuid'])) {
            return redirect()->route('pricing')->with('error', 'Malformed payment payload.');
        }

        $payment = Payment::where('transaction_id', $decoded['transaction_uuid'])->first();
        if (!$payment) {
            return redirect()->route('pricing')->with('error', 'Payment record not found.');
        }

        return $this->activateSubscriptionAndRedirect($payment, $decoded, $decoded['ref_id'] ?? 'ESEWA-' . time());
    }

    public function esewaFailure(Request $request)
    {
        return redirect()->route('pricing')->with('error', 'eSewa payment transaction was cancelled or failed.');
    }

    // ==========================================
    // 2. Khalti EPayment v2
    // ==========================================
    public function initiateKhalti($paymentId)
    {
        $payment = Payment::with('user')->findOrFail($paymentId);

        // Render instant Khalti portal / mock simulator for seamless testing
        return view('payments.khalti-portal', [
            'payment' => $payment,
        ]);
    }

    public function khaltiCallback(Request $request, $paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $pidx = $request->input('pidx', 'KHALTI-' . time());

        return $this->activateSubscriptionAndRedirect($payment, $request->all(), $pidx);
    }

    // ==========================================
    // 3. Fonepay Direct QR
    // ==========================================
    public function initiateFonepay($paymentId)
    {
        $payment = Payment::with('user')->findOrFail($paymentId);

        return view('payments.fonepay-portal', [
            'payment' => $payment,
        ]);
    }

    public function fonepayCallback(Request $request, $paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $ref = 'FONEPAY-' . time();

        return $this->activateSubscriptionAndRedirect($payment, $request->all(), $ref);
    }

    // ==========================================
    // 4. ConnectIPS NCHL
    // ==========================================
    public function initiateConnectips($paymentId)
    {
        $payment = Payment::with('user')->findOrFail($paymentId);

        return view('payments.connectips-portal', [
            'payment' => $payment,
        ]);
    }

    public function connectipsCallback(Request $request, $paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $ref = 'CIPS-' . time();

        return $this->activateSubscriptionAndRedirect($payment, $request->all(), $ref);
    }

    // ==========================================
    // Helper: Activate Subscription & Invoice
    // ==========================================
    protected function activateSubscriptionAndRedirect(Payment $payment, array $rawResponse, string $reference)
    {
        $user = User::findOrFail($payment->user_id);
        
        // Find matched plan by stored subscription_plan_id, or fallback to price matching
        $plan = ($payment->subscription_plan_id ? SubscriptionPlan::find($payment->subscription_plan_id) : null)
            ?? SubscriptionPlan::where('price_npr', $payment->amount)->first() 
            ?? SubscriptionPlan::where('is_popular', true)->first()
            ?? SubscriptionPlan::first();

        // Create active subscription
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'subscription_plan_id' => $plan->id,
            'starts_at' => now(),
            'ends_at' => now()->addMonths($plan->duration_months ?? 3),
            'is_active' => true,
        ]);

        // If coupon applied, increment usage count
        if ($payment->coupon_id) {
            \App\Models\Coupon::where('id', $payment->coupon_id)->increment('times_used');
        }

        // Update payment record
        $payment->update([
            'subscription_id' => $subscription->id,
            'subscription_plan_id' => $plan->id,
            'gateway_reference' => $reference,
            'status' => 'completed',
            'raw_response' => $rawResponse,
        ]);

        // Upgrade user status
        $user->update(['is_premium' => true]);

        return redirect()->route('invoice.show', $payment->id)
            ->with('success', 'Payment successful! Your MeroZodi Premium Subscription is now ACTIVE.');
    }
}
