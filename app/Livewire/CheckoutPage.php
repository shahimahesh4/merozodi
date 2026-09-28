<?php

namespace App\Livewire;

use App\Models\Coupon;
use App\Models\Payment;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class CheckoutPage extends Component
{
    public SubscriptionPlan $plan;
    public $gateway = 'esewa'; // 'esewa', 'khalti', 'fonepay', 'connectips'
    public $couponCode = '';
    public $appliedCouponId = null;

    public function mount($planId)
    {
        $this->plan = SubscriptionPlan::where('is_active', true)->findOrFail($planId);
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
