<?php

namespace App\Livewire;

use App\Models\Coupon;
use App\Models\Payment;
use App\Models\SiteSetting;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class CheckoutPage extends Component
{
    public SubscriptionPlan $plan;
    public $gateway = 'esewa'; // 'esewa', 'khalti', 'fonepay', 'connectips', 'bank_transfer'
    public $couponCode = '';
    public $appliedCouponId = null;

    public function getAvailableGatewaysProperty()
    {
        $gateways = [];

        if (SiteSetting::get('esewa_enabled', '1') == '1') {
            $gateways['esewa'] = [
                'id' => 'esewa',
                'name' => 'eSewa Mobile Wallet',
                'description' => 'Instant checkout via ePay v2 HMAC Signature',
                'icon' => 'images/payments/esewa-icon.svg',
                'badge' => 'images/payments/esewa.svg',
                'border_active' => 'border-emerald-500 bg-emerald-50/40 ring-2 ring-emerald-500/20',
                'radio_class' => 'radio-success',
                'is_sandbox' => SiteSetting::get('esewa_sandbox', '1') == '1',
            ];
        }

        if (SiteSetting::get('khalti_enabled', '1') == '1') {
            $gateways['khalti'] = [
                'id' => 'khalti',
                'name' => 'Khalti Digital Wallet',
                'description' => 'Khalti EPayment v2 REST API & Direct PIN',
                'icon' => 'images/payments/khalti-icon.svg',
                'badge' => 'images/payments/khalti.svg',
                'border_active' => 'border-purple-500 bg-purple-50/40 ring-2 ring-purple-500/20',
                'radio_class' => 'radio-secondary',
                'is_sandbox' => SiteSetting::get('khalti_sandbox', '1') == '1',
            ];
        }

        if (SiteSetting::get('fonepay_enabled', '1') == '1') {
            $gateways['fonepay'] = [
                'id' => 'fonepay',
                'name' => 'Fonepay Merchant Dynamic QR',
                'description' => 'Scan & Pay with any Nepal Mobile Banking App',
                'icon' => 'images/payments/fonepay-icon.svg',
                'badge' => 'images/payments/fonepay.svg',
                'border_active' => 'border-rose-500 bg-rose-50/40 ring-2 ring-rose-500/20',
                'radio_class' => 'radio-primary',
                'is_sandbox' => SiteSetting::get('fonepay_sandbox', '1') == '1',
            ];
        }

        if (SiteSetting::get('connectips_enabled', '1') == '1') {
            $gateways['connectips'] = [
                'id' => 'connectips',
                'name' => 'ConnectIPS (NCHL Direct Debit)',
                'description' => 'Direct Real-Time Inter-Bank Account Transfer',
                'icon' => 'images/payments/connectips-icon.svg',
                'badge' => 'images/payments/connectips.svg',
                'border_active' => 'border-blue-500 bg-blue-50/40 ring-2 ring-blue-500/20',
                'radio_class' => 'radio-info',
                'is_sandbox' => SiteSetting::get('connectips_sandbox', '1') == '1',
            ];
        }

        if (SiteSetting::get('bank_transfer_enabled', '1') == '1') {
            $gateways['bank_transfer'] = [
                'id' => 'bank_transfer',
                'name' => 'Direct Bank Transfer / Offline QR',
                'description' => 'Manual account transfer with verified deposit receipt',
                'icon' => 'images/payments/fonepay-icon.svg',
                'badge' => null,
                'border_active' => 'border-amber-500 bg-amber-50/40 ring-2 ring-amber-500/20',
                'radio_class' => 'radio-warning',
                'is_sandbox' => false,
            ];
        }

        return $gateways;
    }

    public function mount($planId)
    {
        $this->plan = SubscriptionPlan::where('is_active', true)->findOrFail($planId);
        
        $available = array_keys($this->availableGateways);
        if (!in_array($this->gateway, $available) && count($available) > 0) {
            $this->gateway = $available[0];
        }
    }

    public function applyCoupon()
    {
        $code = strtoupper(trim($this->couponCode));
        if (empty($code)) {
            session()->flash('coupon_error', 'Please enter a valid promo code.');
            return;
        }

        $coupon = Coupon::where('code', $code)->first();
        $subtotal = (float) $this->plan->price_npr;

        if (!$coupon) {
            session()->flash('coupon_error', 'Promo code "' . $code . '" is invalid or expired.');
            return;
        }

        if (!$coupon->isValidFor($subtotal)) {
            if ($coupon->min_order_amount > $subtotal) {
                session()->flash('coupon_error', 'This coupon requires a minimum purchase of NPR ' . number_format($coupon->min_order_amount, 2));
            } else {
                session()->flash('coupon_error', 'Coupon code is no longer active or has reached its usage limit.');
            }
            return;
        }

        $this->appliedCouponId = $coupon->id;
        session()->flash('coupon_success', 'Promo code "' . $coupon->code . '" applied successfully!');
    }

    public function removeCoupon()
    {
        $this->appliedCouponId = null;
        $this->couponCode = '';
        session()->flash('coupon_info', 'Coupon removed.');
    }

    public function processPayment()
    {
        $user = Auth::user();
        $subtotal = (float) $this->plan->price_npr;
        $discountAmount = 0;
        $couponId = null;

        if ($this->appliedCouponId) {
            $coupon = Coupon::find($this->appliedCouponId);
            if ($coupon && $coupon->isValidFor($subtotal)) {
                $discountAmount = $coupon->calculateDiscount($subtotal);
                $couponId = $coupon->id;
            }
        }

        $discountedSubtotal = max(0, $subtotal - $discountAmount);
        $taxAmount = round($discountedSubtotal * 0.13, 2); // 13% VAT
        $totalAmount = $discountedSubtotal + $taxAmount;
        $transactionId = 'MZ-' . strtoupper(Str::random(10));

        // Create initial pending payment record
        $payment = Payment::create([
            'user_id' => $user->id,
            'subscription_plan_id' => $this->plan->id,
            'coupon_id' => $couponId,
            'discount_amount' => $discountAmount,
            'gateway' => $this->gateway,
            'transaction_id' => $transactionId,
            'amount' => $discountedSubtotal,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
            'currency' => 'NPR',
            'status' => 'pending',
        ]);

        if ($this->gateway === 'esewa') {
            return redirect()->route('payment.esewa.initiate', ['paymentId' => $payment->id]);
        } elseif ($this->gateway === 'khalti') {
            return redirect()->route('payment.khalti.initiate', ['paymentId' => $payment->id]);
        } elseif ($this->gateway === 'fonepay') {
            return redirect()->route('payment.fonepay.initiate', ['paymentId' => $payment->id]);
        } elseif ($this->gateway === 'connectips') {
            return redirect()->route('payment.connectips.initiate', ['paymentId' => $payment->id]);
        } elseif ($this->gateway === 'bank_transfer') {
            return redirect()->route('invoice.show', $payment->id)->with('info', 'Your order has been recorded. Please complete the bank transfer to activate your package.');
        }
    }

    public function render()
    {
        $subtotal = (float) $this->plan->price_npr;
        $discount = 0;
        $appliedCoupon = null;

        if ($this->appliedCouponId) {
            $appliedCoupon = Coupon::find($this->appliedCouponId);
            if ($appliedCoupon && $appliedCoupon->isValidFor($subtotal)) {
                $discount = $appliedCoupon->calculateDiscount($subtotal);
            } else {
                $this->appliedCouponId = null;
                $appliedCoupon = null;
            }
        }

        $discountedSubtotal = max(0, $subtotal - $discount);
        $tax = round($discountedSubtotal * 0.13, 2);
        $total = $discountedSubtotal + $tax;

        return view('livewire.checkout-page', [
            'subtotal' => $subtotal,
            'discount' => $discount,
            'discountedSubtotal' => $discountedSubtotal,
            'appliedCoupon' => $appliedCoupon,
            'tax' => $tax,
            'total' => $total,
        ])->layout('components.layouts.app', ['title' => 'Upgrade Membership Checkout - MeroZodi']);
    }
}
