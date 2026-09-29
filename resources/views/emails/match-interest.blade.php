@extends('emails.layouts.master')

@section('hero')
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td>
            <div style="display: inline-block; padding: 4px 12px; background-color: #f43f5e; color: #ffffff; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                💖 New Match Proposal
            </div>
            <h1 style="font-size: 22px; font-weight: 800; color: #881337; margin: 0 0 6px 0; line-height: 1.3;">
                Someone Expressed Interest in You!
            </h1>
            <p style="font-size: 14px; color: #4c0519; margin: 0; line-height: 1.5;">
                A verified member on MeroZodi has sent you a connection request and would like to get to know you.
            </p>
        </td>
    </tr>
</table>
@endsection

@section('content')
<!-- Greeting -->
<p style="margin: 0 0 16px 0; font-size: 15px; color: #1e293b; font-weight: 600;">
    Namaste, {{ $recipient->name ?? ($userName ?? 'Valued Member') }}! 🙏
</p>

<p style="margin: 0 0 20px 0; font-size: 14px; color: #475569; line-height: 1.6;">
    Great news! <strong>{{ $sender->name ?? 'A Matchseeker' }}</strong> has viewed your profile and expressed interest in connecting with you for marriage.
</p>

<!-- Sender Profile Summary Card -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #fff1f2; border: 1px solid #fecdd3; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
    <tr>
        <td valign="top" class="mobile-stack mobile-center">
            <div style="display: flex; align-items: center; gap: 14px;">
                <!-- Profile Avatar Placeholder -->
                <div style="width: 56px; height: 56px; border-radius: 50%; background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); color: #ffffff; font-size: 20px; font-weight: 800; text-align: center; line-height: 56px; border: 2px solid #ffffff; box-shadow: 0 4px 10px rgba(225, 29, 72, 0.3);">
                    {{ strtoupper(substr($sender->name ?? 'M', 0, 1)) }}
                </div>
                <div>
                    <div style="font-size: 17px; font-weight: 800; color: #881337;">
                        {{ $sender->name ?? 'Verified Member' }}
                        <span style="display: inline-block; font-size: 12px; background: #10b981; color: #ffffff; padding: 2px 6px; border-radius: 10px; font-weight: 700; margin-left: 4px;">✓ Verified</span>
                    </div>
                    <div style="font-size: 13px; color: #9f1239; margin-top: 2px;">
                        {{ $sender->profile?->caste ?? 'Nepali Member' }} &bull; {{ $sender->profile?->city ?? 'Kathmandu, Nepal' }}
                    </div>
                </div>
            </div>

            <!-- Detail Grid -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 16px; border-top: 1px solid rgba(244, 63, 94, 0.2); padding-top: 14px; font-size: 13px;">
                <tr>
                    <td style="color: #64748b; padding-bottom: 6px;" width="35%"><strong>Age / Height:</strong></td>
                    <td style="color: #1e293b; padding-bottom: 6px;">{{ $sender->profile?->age ?? '28 yrs' }} • {{ $sender->profile?->height ?? '5\'7"' }}</td>
                </tr>
                <tr>
                    <td style="color: #64748b; padding-bottom: 6px;"><strong>Profession:</strong></td>
                    <td style="color: #1e293b; padding-bottom: 6px;">{{ $sender->profile?->occupation ?? 'Software Professional' }}</td>
                </tr>
                <tr>
                    <td style="color: #64748b; padding-bottom: 6px;"><strong>Education:</strong></td>
                    <td style="color: #1e293b; padding-bottom: 6px;">{{ $sender->profile?->highest_education ?? 'Master\'s Degree' }}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!-- Action CTA Buttons -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 24px 0 20px 0;">
    <tr>
        <td align="center">
            <a href="{{ isset($sender) ? url('/profile/' . $sender->id) : url('/browse') }}" target="_blank"
               style="display: inline-block; background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); color: #ffffff; font-size: 15px; font-weight: 700; text-decoration: none; padding: 14px 32px; border-radius: 10px; box-shadow: 0 4px 14px rgba(225, 29, 72, 0.4); text-align: center;">
                View Profile & Respond &rarr;
            </a>
        </td>
    </tr>
</table>
@endsection
