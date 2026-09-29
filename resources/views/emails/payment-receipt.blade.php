@extends('emails.layouts.master')

@section('hero')
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td>
            <div style="display: inline-block; padding: 4px 12px; background-color: #10b981; color: #ffffff; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                ✓ Payment Received & Verified
            </div>
            <h1 style="font-size: 22px; font-weight: 800; color: #881337; margin: 0 0 6px 0; line-height: 1.3;">
                Subscription Invoice & Receipt 💳
            </h1>
            <p style="font-size: 14px; color: #4c0519; margin: 0; line-height: 1.5;">
                Thank you for subscribing to MeroZodi Premium. Your payment has been confirmed and premium features are now unlocked.
            </p>
        </td>
    </tr>
</table>
@endsection

@section('content')
<!-- Greeting -->
<p style="margin: 0 0 16px 0; font-size: 15px; color: #1e293b; font-weight: 600;">
    Namaste, {{ $payment->user?->name ?? ($userName ?? 'Valued Member') }}! 🙏
</p>

<p style="margin: 0 0 20px 0; font-size: 14px; color: #475569; line-height: 1.6;">
    Your payment of <strong>NPR {{ number_format($payment->amount ?? 1500, 2) }}</strong> via <strong>{{ strtoupper($payment->payment_method ?? 'eSewa') }}</strong> was successfully processed. Below is your official subscription receipt:
</p>

<!-- Itemized Receipt Card -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 24px; overflow: hidden;">
    <!-- Header -->
    <tr style="background-color: #f1f5f9;">
        <td colspan="2" style="padding: 12px 18px; font-size: 13px; font-weight: 700; color: #334155; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid #e2e8f0;">
            Transaction Breakdown
        </td>
    </tr>
    <!-- Row 1: Plan Name -->
    <tr>
        <td style="padding: 12px 18px; font-size: 14px; color: #64748b; border-bottom: 1px solid #e2e8f0;">Subscription Plan:</td>
        <td align="right" style="padding: 12px 18px; font-size: 14px; font-weight: 700; color: #0f172a; border-bottom: 1px solid #e2e8f0;">
            {{ $payment->subscription?->plan?->name ?? ($payment->plan?->name ?? 'MeroZodi Premium Subscription') }}
        </td>
    </tr>
    <!-- Row 2: Transaction ID -->
    <tr>
        <td style="padding: 12px 18px; font-size: 14px; color: #64748b; border-bottom: 1px solid #e2e8f0;">Transaction Reference:</td>
        <td align="right" style="padding: 12px 18px; font-size: 13px; font-family: monospace; font-weight: 600; color: #475569; border-bottom: 1px solid #e2e8f0;">
            {{ $payment->gateway_reference ?? ($payment->transaction_id ?? ('MZ-TXN-' . strtoupper(bin2hex(random_bytes(4))))) }}
        </td>
    </tr>
    <!-- Row 3: Payment Method -->
    <tr>
        <td style="padding: 12px 18px; font-size: 14px; color: #64748b; border-bottom: 1px solid #e2e8f0;">Payment Method:</td>
        <td align="right" style="padding: 12px 18px; font-size: 14px; font-weight: 600; color: #0f172a; border-bottom: 1px solid #e2e8f0;">
            {{ strtoupper($payment->gateway ?? ($payment->payment_method ?? 'eSewa')) }}
        </td>
    </tr>
    <!-- Row 4: Date & Time -->
    <tr>
        <td style="padding: 12px 18px; font-size: 14px; color: #64748b; border-bottom: 1px solid #e2e8f0;">Date & Time (NPT):</td>
        <td align="right" style="padding: 12px 18px; font-size: 14px; color: #0f172a; border-bottom: 1px solid #e2e8f0;">
            {{ isset($payment->created_at) ? $payment->created_at->format('M d, Y h:i A') : date('M d, Y h:i A') }}
        </td>
    </tr>
    <!-- Row 5: Total Amount Paid -->
    <tr style="background-color: #f8fafc;">
        <td style="padding: 14px 18px; font-size: 15px; font-weight: 700; color: #1e293b;">Total Amount Paid (incl. VAT):</td>
        <td align="right" style="padding: 14px 18px; font-size: 18px; font-weight: 800; color: #e11d48;">
            NPR {{ number_format($payment->total_amount ?? ($payment->amount ?? 1500), 2) }}
        </td>
    </tr>
</table>

<!-- Unlocked Features Summary -->
<div style="background-color: #eff6ff; border: 1px solid #bfdbfe; border-radius: 10px; padding: 16px; margin-bottom: 24px;">
    <div style="font-size: 13px; font-weight: 700; color: #1e40af; margin-bottom: 8px; text-transform: uppercase;">
        🌟 Your Active Premium Privileges:
    </div>
    <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #1e3a8a; line-height: 1.6;">
        <li>Direct contact view & phone unlocking for verified matchseekers</li>
        <li>Unlimited real-time chat & voice note attachments</li>
        <li>Automated Vedic Kundali 36 Guna Milan matchmaking</li>
        <li>Priority profile placement on search & browse listings</li>
    </ul>
</div>

<!-- Primary Action CTA Button -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 28px 0 20px 0;">
    <tr>
        <td align="center">
            <a href="{{ url('/browse') }}" target="_blank"
               style="display: inline-block; background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); color: #ffffff; font-size: 15px; font-weight: 700; text-decoration: none; padding: 14px 32px; border-radius: 10px; box-shadow: 0 4px 14px rgba(225, 29, 72, 0.4); text-align: center;">
                Start Browsing Premium Matches &rarr;
            </a>
        </td>
    </tr>
</table>
@endsection
