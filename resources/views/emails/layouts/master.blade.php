<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ $subject ?? ($title ?? config('app.name', 'MeroZodi Matrimony')) }}</title>
    <style type="text/css">
        /* Client-specific Resets */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        table { border-collapse: collapse !important; }
        body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }

        /* iOS Blue Links */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* Mobile Styles */
        @media screen and (max-width: 600px) {
            .mobile-full-width { width: 100% !important; max-width: 100% !important; }
            .mobile-padding { padding: 20px 16px !important; }
            .mobile-header-padding { padding: 24px 16px !important; }
            .mobile-stack { display: block !important; width: 100% !important; }
            .mobile-center { text-align: center !important; }
            .mobile-hide { display: none !important; }
            .mobile-button { width: 100% !important; display: block !important; text-align: center !important; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; -webkit-font-smoothing: antialiased;">

    <!-- Hidden Preheader Preview Text -->
    @if(!empty($preheader))
    <div style="display: none; font-size: 1px; color: #f1f5f9; line-height: 1px; font-family: sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all;">
        {{ $preheader }}
        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    @endif

    <!-- Outer Wrapper Table -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f1f5f9; table-layout: fixed;">
        <tr>
            <td align="center" style="padding: 24px 12px 40px 12px;">

                <!-- Main Container Card (600px max) -->
                <table border="0" cellpadding="0" cellspacing="0" width="600" class="mobile-full-width" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04); border: 1px solid #e2e8f0;">

                    <!-- ================= HEADER SECTION ================= -->
                    <tr>
                        <td align="center" style="background: linear-gradient(135deg, #881337 0%, #be123c 50%, #e11d48 100%); padding: 28px 32px; border-top-left-radius: 16px; border-top-right-radius: 16px;" class="mobile-header-padding">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <!-- Brand Logo & Name -->
                                    <td align="left" valign="middle" class="mobile-stack mobile-center">
                                        <a href="{{ url('/') }}" target="_blank" style="text-decoration: none; display: inline-block;">
                                            @php
                                                $logoPath = \App\Models\SiteSetting::get('site_logo');
                                                $logoUrl = $logoPath ? asset(ltrim($logoPath, '/')) : asset('images/logo.png');
                                                $siteName = \App\Models\SiteSetting::get('site_name', 'MeroZodi');
                                                $tagline = \App\Models\SiteSetting::get('tagline', 'Nepal\'s Premier Matrimonial Platform');
                                            @endphp
                                            <table border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td valign="middle" style="padding-right: 12px;">
                                                        <img src="{{ $logoUrl }}" alt="{{ $siteName }}" width="44" height="44" style="display: block; border-radius: 10px; background: rgba(255, 255, 255, 0.15); padding: 4px; border: 1px solid rgba(255, 255, 255, 0.3);" />
                                                    </td>
                                                    <td valign="middle">
                                                        <div style="font-size: 22px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px; line-height: 1.1; text-shadow: 0 1px 3px rgba(0,0,0,0.3);">
                                                            {{ $siteName }}
                                                        </div>
                                                        <div style="font-size: 11px; font-weight: 500; color: #fecdd3; letter-spacing: 0.3px; margin-top: 2px;">
                                                            {{ $tagline }}
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </a>
                                    </td>

                                    <!-- Right Badge / Cultural Touch -->
                                    <td align="right" valign="middle" class="mobile-stack mobile-center mobile-hide" style="padding-left: 12px;">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding: 5px 12px; background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.25); border-radius: 20px;">
                                                    <span style="font-size: 11px; font-weight: 700; color: #ffffff; letter-spacing: 0.5px; text-transform: uppercase;">
                                                        🇳🇵 100% Verified
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Decorative Gold Accent Border Line -->
                    <tr>
                        <td height="4" style="background: linear-gradient(90deg, #f59e0b 0%, #fbbf24 50%, #f59e0b 100%); font-size: 0; line-height: 0;">&nbsp;</td>
                    </tr>

                    <!-- ================= HERO GREETING / BANNER (OPTIONAL) ================= -->
                    @hasSection('hero')
                    <tr>
                        <td style="background-color: #fff1f2; padding: 24px 32px; border-bottom: 1px solid #ffe4e6;" class="mobile-padding">
                            @yield('hero')
                        </td>
                    </tr>
                    @endif

                    <!-- ================= MAIN BODY CONTENT ================= -->
                    <tr>
                        <td style="padding: 32px; background-color: #ffffff; color: #334155; font-size: 15px; line-height: 1.6;" class="mobile-padding">
                            @yield('content')
                        </td>
                    </tr>

                    <!-- ================= TRUST & SAFETY ASSURANCE PILLARS ================= -->
                    <tr>
                        <td style="background-color: #fafafa; padding: 20px 32px; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9;" class="mobile-padding">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <!-- Pillar 1: Verified Profiles -->
                                    <td width="33.33%" align="center" valign="top" class="mobile-stack" style="padding: 6px;">
                                        <div style="font-size: 16px; margin-bottom: 4px;">🛡️</div>
                                        <div style="font-size: 12px; font-weight: 700; color: #1e293b;">100% KYC Verified</div>
                                        <div style="font-size: 11px; color: #64748b; margin-top: 2px;">Authentic Nepali profiles</div>
                                    </td>
                                    <!-- Pillar 2: Privacy Shield -->
                                    <td width="33.33%" align="center" valign="top" class="mobile-stack" style="padding: 6px;">
                                        <div style="font-size: 16px; margin-bottom: 4px;">🔒</div>
                                        <div style="font-size: 12px; font-weight: 700; color: #1e293b;">Photo & Data Privacy</div>
                                        <div style="font-size: 11px; color: #64748b; margin-top: 2px;">Full control on your info</div>
                                    </td>
                                    <!-- Pillar 3: Vedic Kundali -->
                                    <td width="33.33%" align="center" valign="top" class="mobile-stack" style="padding: 6px;">
                                        <div style="font-size: 16px; margin-bottom: 4px;">✨</div>
                                        <div style="font-size: 12px; font-weight: 700; color: #1e293b;">Kundali 36 Gunas</div>
                                        <div style="font-size: 11px; color: #64748b; margin-top: 2px;">Astrological matchmaking</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- ================= FOOTER & HELPDESK ================= -->
                    <tr>
                        <td style="background-color: #0f172a; padding: 28px 32px 24px 32px; color: #94a3b8; font-size: 12px; line-height: 1.5; border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;" class="mobile-padding">
                            
                            @php
                                $helpline = \App\Models\SiteSetting::get('helpline_phone', '+977-1-4567890');
                                $whatsapp = \App\Models\SiteSetting::get('whatsapp_desk', '+977-9801234567');
                                $email = \App\Models\SiteSetting::get('support_email', 'support@merozodi.com');
                                $address = \App\Models\SiteSetting::get('office_address', 'Lazimpat, Kathmandu, Nepal');
                                $copyright = \App\Models\SiteSetting::get('copyright_text', '© ' . date('Y') . ' MeroZodi Matrimony. All rights reserved.');
                                
                                $fb = \App\Models\SiteSetting::get('facebook_url', 'https://facebook.com');
                                $insta = \App\Models\SiteSetting::get('instagram_url', 'https://instagram.com');
                                $youtube = \App\Models\SiteSetting::get('youtube_url', 'https://youtube.com');
                                $tiktok = \App\Models\SiteSetting::get('tiktok_url', 'https://tiktok.com');
                            @endphp

                            <!-- Helpdesk & Contact Row -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 18px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 16px;">
                                <tr>
                                    <td align="left" class="mobile-stack mobile-center" style="padding-bottom: 8px;">
                                        <div style="font-size: 13px; font-weight: 700; color: #f8fafc; margin-bottom: 4px;">Need Assistance or Support?</div>
                                        <div style="color: #cbd5e1;">
                                            📞 <a href="tel:{{ $helpline }}" style="color: #fda4af; text-decoration: none; font-weight: 600;">{{ $helpline }}</a>
                                            &nbsp;|&nbsp;
                                            💬 WhatsApp: <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" style="color: #34d399; text-decoration: none; font-weight: 600;">{{ $whatsapp }}</a>
                                        </div>
                                        <div style="margin-top: 3px; color: #cbd5e1;">
                                            ✉️ Email: <a href="mailto:{{ $email }}" style="color: #38bdf8; text-decoration: none;">{{ $email }}</a>
                                        </div>
                                    </td>
                                    <td align="right" class="mobile-stack mobile-center" valign="top">
                                        <div style="font-size: 11px; color: #94a3b8;">
                                            🏢 {{ $address }}
                                        </div>
                                        <div style="margin-top: 6px;">
                                            <a href="{{ $fb }}" target="_blank" style="color: #ffffff; text-decoration: none; margin-left: 8px; font-weight: 600;">Facebook</a>
                                            <a href="{{ $insta }}" target="_blank" style="color: #ffffff; text-decoration: none; margin-left: 8px; font-weight: 600;">Instagram</a>
                                            <a href="{{ $youtube }}" target="_blank" style="color: #ffffff; text-decoration: none; margin-left: 8px; font-weight: 600;">YouTube</a>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Disclaimer & Copyright Row -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" style="font-size: 11px; color: #64748b; line-height: 1.4;">
                                        <div>
                                            {{ $copyright }}
                                        </div>
                                        <div style="margin-top: 6px;">
                                            <a href="{{ url('/privacy-policy') }}" style="color: #94a3b8; text-decoration: underline; margin: 0 6px;">Privacy Policy</a>
                                            &bull;
                                            <a href="{{ url('/terms-conditions') }}" style="color: #94a3b8; text-decoration: underline; margin: 0 6px;">Terms of Service</a>
                                            &bull;
                                            <a href="{{ url('/contact') }}" style="color: #94a3b8; text-decoration: underline; margin: 0 6px;">Contact Helpdesk</a>
                                        </div>
                                        <div style="margin-top: 8px; font-size: 10px; color: #475569;">
                                            You received this official notification because you are a registered member of MeroZodi Nepal Matrimony.
                                        </div>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                </table>
                <!-- End Main Container Card -->

            </td>
        </tr>
    </table>
    <!-- End Outer Wrapper Table -->

</body>
</html>
