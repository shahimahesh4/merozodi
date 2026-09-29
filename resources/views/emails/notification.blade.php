@extends('emails.layouts.master')

@section('hero')
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td>
            @if(!empty($badge))
            <div style="display: inline-block; padding: 4px 12px; background-color: #e11d48; color: #ffffff; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                {{ $badge }}
            </div>
            @endif
            <h1 style="font-size: 20px; font-weight: 800; color: #881337; margin: 0 0 6px 0; line-height: 1.3;">
                {{ $title ?? 'Notification from MeroZodi' }}
            </h1>
            @if(!empty($subtitle))
            <p style="font-size: 14px; color: #4c0519; margin: 0; line-height: 1.5;">
                {{ $subtitle }}
            </p>
            @endif
        </td>
    </tr>
</table>
@endsection

@section('content')
<!-- Greeting -->
@if(!empty($userName))
<p style="margin: 0 0 16px 0; font-size: 15px; color: #1e293b; font-weight: 600;">
    Namaste, {{ $userName }}! 🙏
</p>
@endif

<!-- Message Body Content -->
<div style="margin: 0 0 24px 0; font-size: 15px; color: #334155; line-height: 1.6;">
    {!! $messageBody ?? ($content ?? 'We have an important update regarding your matrimonial profile and platform activity.') !!}
</div>

<!-- Highlight Box (Optional) -->
@if(!empty($highlightText))
<div style="background-color: #f8fafc; border-left: 4px solid #e11d48; border-radius: 6px; padding: 14px 18px; margin-bottom: 24px; font-size: 14px; color: #1e293b; line-height: 1.5;">
    {!! $highlightText !!}
</div>
@endif

<!-- Action CTA Button (Optional) -->
@if(!empty($actionUrl) && !empty($actionText))
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 28px 0 20px 0;">
    <tr>
        <td align="center">
            <a href="{{ $actionUrl }}" target="_blank"
               style="display: inline-block; background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); color: #ffffff; font-size: 15px; font-weight: 700; text-decoration: none; padding: 13px 30px; border-radius: 10px; box-shadow: 0 4px 14px rgba(225, 29, 72, 0.4); text-align: center;">
                {{ $actionText }} &rarr;
            </a>
        </td>
    </tr>
</table>
@endif

<!-- Secondary Helper Note -->
<p style="margin: 20px 0 0 0; font-size: 13px; color: #64748b; line-height: 1.5;">
    If you did not initiate this request or have questions, please reach out to our dedicated helpdesk directly at <a href="mailto:{{ \App\Models\SiteSetting::get('support_email', 'support@merozodi.com') }}" style="color: #e11d48; text-decoration: underline;">{{ \App\Models\SiteSetting::get('support_email', 'support@merozodi.com') }}</a>.
</p>
@endsection
