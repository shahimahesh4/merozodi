@extends('emails.layouts.master')

@section('hero')
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td>
            <div style="display: inline-block; padding: 4px 12px; background-color: #f43f5e; color: #ffffff; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                🎉 Welcome to MeroZodi
            </div>
            <h1 style="font-size: 22px; font-weight: 800; color: #881337; margin: 0 0 6px 0; line-height: 1.3;">
                Namaste, {{ $user->name ?? 'Valued Member' }}! 🙏
            </h1>
            <p style="font-size: 14px; color: #4c0519; margin: 0; line-height: 1.5;">
                Welcome to Nepal's most trusted, verified matrimonial platform. Your journey to finding a meaningful lifelong partner starts here.
            </p>
        </td>
    </tr>
</table>
@endsection

@section('content')
<!-- Intro Message -->
<p style="margin: 0 0 20px 0; font-size: 15px; color: #334155; line-height: 1.6;">
    Thank you for creating your account with <strong>{{ \App\Models\SiteSetting::get('site_name', 'MeroZodi') }}</strong>. We are dedicated to connecting verified Nepali brides and grooms across Nepal, Australia, the USA, UK, Canada, and around the world.
</p>

<!-- 3 Steps to Success Card -->
<div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
    <div style="font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
        🚀 3 Quick Steps to Get Verified & Find Matches Faster:
    </div>

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- Step 1 -->
        <tr>
            <td width="36" valign="top" style="padding-bottom: 12px;">
                <div style="width: 26px; height: 26px; border-radius: 50%; background-color: #e11d48; color: #ffffff; font-weight: 700; font-size: 13px; text-align: center; line-height: 26px;">1</div>
            </td>
            <td valign="top" style="padding-bottom: 12px;">
                <div style="font-size: 14px; font-weight: 600; color: #1e293b;">Complete Your Bio & Family Background</div>
                <div style="font-size: 13px; color: #64748b; margin-top: 2px;">Profiles with comprehensive details receive up to <strong>5x more match responses</strong>.</div>
            </td>
        </tr>
        <!-- Step 2 -->
        <tr>
            <td width="36" valign="top" style="padding-bottom: 12px;">
                <div style="width: 26px; height: 26px; border-radius: 50%; background-color: #e11d48; color: #ffffff; font-weight: 700; font-size: 13px; text-align: center; line-height: 26px;">2</div>
            </td>
            <td valign="top" style="padding-bottom: 12px;">
                <div style="font-size: 14px; font-weight: 600; color: #1e293b;">Add Vedic Kundali / Astrological Details</div>
                <div style="font-size: 13px; color: #64748b; margin-top: 2px;">Enable automated 36 Guna Milan compatibility scoring with potential matches.</div>
            </td>
        </tr>
        <!-- Step 3 -->
        <tr>
            <td width="36" valign="top">
                <div style="width: 26px; height: 26px; border-radius: 50%; background-color: #e11d48; color: #ffffff; font-weight: 700; font-size: 13px; text-align: center; line-height: 26px;">3</div>
            </td>
            <td valign="top">
                <div style="font-size: 14px; font-weight: 600; color: #1e293b;">Submit KYC ID for Blue Tick Badge 🛡️</div>
                <div style="font-size: 13px; color: #64748b; margin-top: 2px;">Upload Citizenship, Passport, or National ID for 100% genuine verified status.</div>
            </td>
        </tr>
    </table>
</div>

<!-- Primary CTA Button -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 28px 0 24px 0;">
    <tr>
        <td align="center">
            <a href="{{ url('/dashboard') }}" target="_blank"
               style="display: inline-block; background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); color: #ffffff; font-size: 16px; font-weight: 700; text-decoration: none; padding: 14px 32px; border-radius: 10px; box-shadow: 0 4px 14px rgba(225, 29, 72, 0.4); text-align: center;">
                Go to My Dashboard &rarr;
            </a>
        </td>
    </tr>
</table>

<!-- Security Tip Box -->
<div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 14px; font-size: 13px; color: #166534; line-height: 1.5;">
    <strong>💡 Privacy Tip:</strong> You can enable Photo Privacy Shield in your account settings at any time so only members you approve can view your photographs.
</div>
@endsection
