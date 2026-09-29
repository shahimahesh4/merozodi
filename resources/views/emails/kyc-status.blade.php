@extends('emails.layouts.master')

@section('hero')
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td>
            @if(($status ?? 'approved') === 'approved')
            <div style="display: inline-block; padding: 4px 12px; background-color: #10b981; color: #ffffff; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                ✓ Verification Complete
            </div>
            <h1 style="font-size: 22px; font-weight: 800; color: #881337; margin: 0 0 6px 0; line-height: 1.3;">
                Your Profile is Now KYC Verified! 🛡️
            </h1>
            <p style="font-size: 14px; color: #4c0519; margin: 0; line-height: 1.5;">
                Congratulations! Your identity document has been verified by the MeroZodi Trust & Safety moderation team.
            </p>
            @else
            <div style="display: inline-block; padding: 4px 12px; background-color: #f59e0b; color: #ffffff; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                ⚠️ Document Update Required
            </div>
            <h1 style="font-size: 22px; font-weight: 800; color: #881337; margin: 0 0 6px 0; line-height: 1.3;">
                KYC Verification Update Needed
            </h1>
            <p style="font-size: 14px; color: #4c0519; margin: 0; line-height: 1.5;">
                Please upload a clearer copy of your identification document to activate your verified blue tick.
            </p>
            @endif
        </td>
    </tr>
</table>
@endsection

@section('content')
<!-- Greeting -->
<p style="margin: 0 0 16px 0; font-size: 15px; color: #1e293b; font-weight: 600;">
    Namaste, {{ $user->name ?? ($userName ?? 'Valued Member') }}! 🙏
</p>

@if(($status ?? 'approved') === 'approved')
<div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
        <span style="font-size: 20px;">🛡️</span>
        <span style="font-size: 16px; font-weight: 800; color: #166534;">Blue Tick Trust Badge Activated</span>
    </div>
    <p style="margin: 0; font-size: 14px; color: #15803d; line-height: 1.6;">
        Your profile is now marked as <strong>100% Verified Matchseeker</strong>. Verified profiles receive <strong>top priority in search rankings</strong> and build immediate trust with prospective brides, grooms, and their families.
    </p>
</div>

<div style="font-size: 14px; color: #334155; line-height: 1.6; margin-bottom: 20px;">
    <strong>What happens next?</strong>
    <ul style="margin: 8px 0 0 0; padding-left: 20px; color: #475569;">
        <li>Your profile is now publicly discoverable by verified matchseekers across Nepal and diaspora.</li>
        <li>You can now view contact requests and chat directly with interested matches.</li>
        <li>Your ID document is securely encrypted in compliance with privacy regulations.</li>
    </ul>
</div>

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 28px 0 20px 0;">
    <tr>
        <td align="center">
            <a href="{{ url('/browse') }}" target="_blank"
               style="display: inline-block; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #ffffff; font-size: 15px; font-weight: 700; text-decoration: none; padding: 14px 32px; border-radius: 10px; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.4); text-align: center;">
                Browse Verified Matches Now &rarr;
            </a>
        </td>
    </tr>
</table>
@else
<div style="background-color: #fffbeb; border: 1px solid #fde68a; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
    <div style="font-size: 15px; font-weight: 700; color: #92400e; margin-bottom: 6px;">
        Reason for Document Revision:
    </div>
    <p style="margin: 0; font-size: 14px; color: #b45309; line-height: 1.5;">
        {{ $rejectionReason ?? 'The submitted document was blurry or unreadable. Please ensure both front and back photos are clearly visible with readable full name and date of birth.' }}
    </p>
</div>

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 28px 0 20px 0;">
    <tr>
        <td align="center">
            <a href="{{ url('/dashboard') }}" target="_blank"
               style="display: inline-block; background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); color: #ffffff; font-size: 15px; font-weight: 700; text-decoration: none; padding: 14px 32px; border-radius: 10px; box-shadow: 0 4px 14px rgba(225, 29, 72, 0.4); text-align: center;">
                Re-upload Verification Document &rarr;
            </a>
        </td>
    </tr>
</table>
@endif
@endsection
