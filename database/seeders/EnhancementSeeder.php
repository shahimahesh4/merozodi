<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class EnhancementSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Initial Promo Coupons
        $coupons = [
            [
                'code' => 'DASHAIN2026',
                'name' => 'Dashain & Tihar Festive Special',
                'discount_type' => 'percentage',
                'discount_value' => 20.00,
                'min_order_amount' => 1000.00,
                'max_uses' => 500,
                'expires_at' => now()->addMonths(3),
                'is_active' => true,
            ],
            [
                'code' => 'LAGAN500',
                'name' => 'Wedding Season Flat NPR 500 Off',
                'discount_type' => 'fixed',
                'discount_value' => 500.00,
                'min_order_amount' => 2500.00,
                'max_uses' => 300,
                'expires_at' => now()->addMonths(6),
                'is_active' => true,
            ],
            [
                'code' => 'WELCOME10',
                'name' => 'New Member Welcome Discount',
                'discount_type' => 'percentage',
                'discount_value' => 10.00,
                'min_order_amount' => 500.00,
                'max_uses' => 1000,
                'expires_at' => now()->addYear(),
                'is_active' => true,
            ],
        ];

        foreach ($coupons as $c) {
            Coupon::updateOrCreate(['code' => $c['code']], $c);
        }

        // 2. Global Site Settings & Fully Dynamic Website Content
        $settings = [
            // General & Branding
            ['key' => 'site_name', 'value' => 'MeroZodi Matrimony', 'group' => 'general', 'label' => 'Site Name', 'type' => 'text'],
            ['key' => 'tagline', 'value' => "Nepal's Leading Matrimony & Matchmaking Platform", 'group' => 'general', 'label' => 'Site Tagline', 'type' => 'text'],
            ['key' => 'site_logo', 'value' => 'images/logo.png', 'group' => 'general', 'label' => 'Site Main Logo Path/URL', 'type' => 'text'],
            ['key' => 'site_favicon', 'value' => 'images/logo.png', 'group' => 'general', 'label' => 'Site Favicon Path/URL', 'type' => 'text'],
            ['key' => 'site_description', 'value' => 'Find your ideal life partner with MeroZodi. 100% KYC ID-verified Nepali singles across Nepal, Australia, USA, UK, and worldwide with photo privacy shield and private video dating.', 'group' => 'general', 'label' => 'Default SEO Meta Description', 'type' => 'textarea'],
            ['key' => 'company_legal_name', 'value' => 'MeroZodi', 'group' => 'general', 'label' => 'Legal Registered Company Name', 'type' => 'text'],
            ['key' => 'company_pan_vat', 'value' => '609823412', 'group' => 'general', 'label' => 'Company PAN / VAT Reg No', 'type' => 'text'],
            ['key' => 'office_city_province', 'value' => 'Bagmati Province, Nepal', 'group' => 'general', 'label' => 'Province / State Country', 'type' => 'text'],

            // Contact & Helpdesk
            ['key' => 'helpline_phone', 'value' => '+977-1-4567890', 'group' => 'contact', 'label' => 'Helpline Phone Hotline', 'type' => 'text'],
            ['key' => 'whatsapp_desk', 'value' => '+977-9801234567', 'group' => 'contact', 'label' => 'WhatsApp Support Desk', 'type' => 'text'],
            ['key' => 'support_email', 'value' => 'support@merozodi.com', 'group' => 'contact', 'label' => 'Support Email', 'type' => 'text'],
            ['key' => 'office_address', 'value' => 'Lazimpat, Kathmandu, Nepal', 'group' => 'contact', 'label' => 'Physical Office Address', 'type' => 'text'],

            // Social Media Profiles
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/merozodi', 'group' => 'social', 'label' => 'Facebook Page URL', 'type' => 'text'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/merozodi', 'group' => 'social', 'label' => 'Instagram Profile URL', 'type' => 'text'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/@merozodi', 'group' => 'social', 'label' => 'YouTube Channel URL', 'type' => 'text'],
            ['key' => 'tiktok_url', 'value' => 'https://tiktok.com/@merozodi', 'group' => 'social', 'label' => 'TikTok Handle URL', 'type' => 'text'],
            ['key' => 'twitter_url', 'value' => 'https://x.com/merozodi', 'group' => 'social', 'label' => 'Twitter / X Profile URL', 'type' => 'text'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/merozodi', 'group' => 'social', 'label' => 'LinkedIn Company URL', 'type' => 'text'],

            // Footer & Copyright Details
            ['key' => 'footer_about_title', 'value' => 'About MeroZodi', 'group' => 'footer', 'label' => 'Footer About Section Heading', 'type' => 'text'],
            ['key' => 'footer_about_text', 'value' => "Nepal's most trusted matrimonial platform connecting Nepali singles at home and abroad with cultural accuracy, privacy and security.", 'group' => 'footer', 'label' => 'Footer About Description', 'type' => 'textarea'],
            ['key' => 'footer_payment_title', 'value' => 'Secure Local Payments', 'group' => 'footer', 'label' => 'Footer Payments Heading', 'type' => 'text'],
            ['key' => 'footer_payment_text', 'value' => "Instant automated activation via Nepal's digital wallets:", 'group' => 'footer', 'label' => 'Footer Payments Subtext', 'type' => 'text'],
            ['key' => 'copyright_text', 'value' => '© 2026 MeroZodi. All rights reserved.', 'group' => 'footer', 'label' => 'Footer Copyright Text', 'type' => 'text'],
            ['key' => 'powered_by_text', 'value' => 'Siddhi Tech Nepal', 'group' => 'footer', 'label' => 'Footer Powered By Text', 'type' => 'text'],
            ['key' => 'powered_by_url', 'value' => 'https://siddhitechnepal.com', 'group' => 'footer', 'label' => 'Footer Powered By Link URL', 'type' => 'text'],
            ['key' => 'app_version', 'value' => 'Beta Version 2.0', 'group' => 'footer', 'label' => 'App Release Version Tag', 'type' => 'text'],

            // Payment Gateway API Configurations & Enable/Disable Toggles
            // 1. eSewa ePay v2
            ['key' => 'esewa_enabled', 'value' => '1', 'group' => 'payment', 'label' => 'eSewa Payment Gateway Enabled', 'type' => 'boolean'],
            ['key' => 'esewa_merchant_id', 'value' => 'EPAYTEST', 'group' => 'payment', 'label' => 'eSewa Merchant Code / Product Code', 'type' => 'text'],
            ['key' => 'esewa_secret_key', 'value' => '8gBm/:&EnhH.1/q', 'group' => 'payment', 'label' => 'eSewa Secret Key (HMAC-SHA256)', 'type' => 'text'],
            ['key' => 'esewa_sandbox', 'value' => '1', 'group' => 'payment', 'label' => 'eSewa Test/Sandbox Mode', 'type' => 'boolean'],

            // 2. Khalti EPayment v2
            ['key' => 'khalti_enabled', 'value' => '1', 'group' => 'payment', 'label' => 'Khalti Payment Gateway Enabled', 'type' => 'boolean'],
            ['key' => 'khalti_public_key', 'value' => 'test_public_key_7c992c10dbb8449c953531b2c452e896', 'group' => 'payment', 'label' => 'Khalti Public API Key', 'type' => 'text'],
            ['key' => 'khalti_secret_key', 'value' => 'test_secret_key_684618776b694b29a28d5462fa1e17f4', 'group' => 'payment', 'label' => 'Khalti Secret API Key', 'type' => 'text'],
            ['key' => 'khalti_sandbox', 'value' => '1', 'group' => 'payment', 'label' => 'Khalti Test/Sandbox Mode', 'type' => 'boolean'],

            // 3. Fonepay Dynamic Merchant QR
            ['key' => 'fonepay_enabled', 'value' => '1', 'group' => 'payment', 'label' => 'Fonepay Dynamic QR Gateway Enabled', 'type' => 'boolean'],
            ['key' => 'fonepay_merchant_code', 'value' => 'MER_FONEPAY_TEST', 'group' => 'payment', 'label' => 'Fonepay Merchant Code', 'type' => 'text'],
            ['key' => 'fonepay_secret_key', 'value' => 'fonepay_secret_hash_key_test', 'group' => 'payment', 'label' => 'Fonepay Secret Hash Key', 'type' => 'text'],
            ['key' => 'fonepay_sandbox', 'value' => '1', 'group' => 'payment', 'label' => 'Fonepay Test/Sandbox Mode', 'type' => 'boolean'],

            // 4. ConnectIPS NCHL
            ['key' => 'connectips_enabled', 'value' => '1', 'group' => 'payment', 'label' => 'ConnectIPS NCHL Gateway Enabled', 'type' => 'boolean'],
            ['key' => 'connectips_merchant_id', 'value' => 'CIPS_TEST_MERCHANT', 'group' => 'payment', 'label' => 'ConnectIPS Merchant ID', 'type' => 'text'],
            ['key' => 'connectips_app_id', 'value' => 'MER-902-APP', 'group' => 'payment', 'label' => 'ConnectIPS App ID', 'type' => 'text'],
            ['key' => 'connectips_sandbox', 'value' => '1', 'group' => 'payment', 'label' => 'ConnectIPS Test/Sandbox Mode', 'type' => 'boolean'],

            // 5. Direct Bank Transfer / Fonepay Direct QR
            ['key' => 'bank_transfer_enabled', 'value' => '1', 'group' => 'payment', 'label' => 'Direct Bank Transfer / Offline QR Enabled', 'type' => 'boolean'],
            ['key' => 'bank_name', 'value' => 'Nabil Bank Ltd. / Global IME Bank', 'group' => 'payment', 'label' => 'Bank Name', 'type' => 'text'],
            ['key' => 'bank_account_name', 'value' => 'MeroZodi', 'group' => 'payment', 'label' => 'Bank Account Name', 'type' => 'text'],
            ['key' => 'bank_account_number', 'value' => '01901017500123', 'group' => 'payment', 'label' => 'Bank Account Number', 'type' => 'text'],
            ['key' => 'bank_branch', 'value' => 'Lazimpat Branch, Kathmandu', 'group' => 'payment', 'label' => 'Bank Branch', 'type' => 'text'],

            // Dynamic Hero Section
            ['key' => 'hero_badge', 'value' => "Nepal's #1 Matrimony & Matchmaking Platform", 'group' => 'homepage', 'label' => 'Hero Badge Text', 'type' => 'text'],
            ['key' => 'hero_title_prefix', 'value' => "Find Your Perfect Life Partner", 'group' => 'homepage', 'label' => 'Hero Title Line 1 (Prefix)', 'type' => 'text'],
            ['key' => 'hero_title_highlight', 'value' => "Cultural Trust", 'group' => 'homepage', 'label' => 'Hero Title Highlight', 'type' => 'text'],
            ['key' => 'hero_subtitle', 'value' => "Connect with 100% ID-verified Nepali singles across Nepal, Australia, USA, UK, Canada, and 35+ countries. Photo privacy shield and secure video dating.", 'group' => 'homepage', 'label' => 'Hero Subtitle', 'type' => 'textarea'],
            ['key' => 'hero_bg_image', 'value' => 'images/nepali-wedding-banner.jpg', 'group' => 'homepage', 'label' => 'Hero Background Banner Image', 'type' => 'text'],
            ['key' => 'hero_trust_badges', 'value' => json_encode([
                ['icon' => 'fa-circle-check', 'text' => '100% ID Verified', 'color' => 'text-emerald-400'],
                ['icon' => 'fa-shield-halved', 'text' => 'Photo Privacy Shield', 'color' => 'text-indigo-400'],
                ['icon' => 'fa-moon', 'text' => '36 Gun Vedic Milan', 'color' => 'text-amber-300'],
                ['icon' => 'fa-earth-americas', 'text' => 'Diaspora Hubs', 'color' => 'text-rose-400'],
            ], JSON_UNESCAPED_UNICODE), 'group' => 'homepage', 'label' => 'Hero Trust Badges', 'type' => 'json'],

            // Dynamic Numerical Stats
            ['key' => 'stat_1_value', 'value' => '2,000+', 'group' => 'homepage_stats', 'label' => 'Stat 1 Value', 'type' => 'text'],
            ['key' => 'stat_1_label', 'value' => 'Verified Singles', 'group' => 'homepage_stats', 'label' => 'Stat 1 Label', 'type' => 'text'],
            ['key' => 'stat_2_value', 'value' => '1,200+', 'group' => 'homepage_stats', 'label' => 'Stat 2 Value', 'type' => 'text'],
            ['key' => 'stat_2_label', 'value' => 'Happy Couples', 'group' => 'homepage_stats', 'label' => 'Stat 2 Label', 'type' => 'text'],
            ['key' => 'stat_3_value', 'value' => '35+ Countries', 'group' => 'homepage_stats', 'label' => 'Stat 3 Value', 'type' => 'text'],
            ['key' => 'stat_3_label', 'value' => 'Nepali Diaspora', 'group' => 'homepage_stats', 'label' => 'Stat 3 Label', 'type' => 'text'],
            ['key' => 'stat_4_value', 'value' => '100% Safe', 'group' => 'homepage_stats', 'label' => 'Stat 4 Value', 'type' => 'text'],
            ['key' => 'stat_4_label', 'value' => 'KYC Protected', 'group' => 'homepage_stats', 'label' => 'Stat 4 Label', 'type' => 'text'],

            // Dynamic How It Works
            ['key' => 'how_it_works_badge', 'value' => 'Simple & Trustworthy', 'group' => 'homepage', 'label' => 'How It Works Badge', 'type' => 'text'],
            ['key' => 'how_it_works_title', 'value' => 'How MeroZodi Works in 3 Steps', 'group' => 'homepage', 'label' => 'How It Works Title', 'type' => 'text'],
            ['key' => 'how_it_works_subtitle', 'value' => 'Designed specifically for Nepali singles and families seeking meaningful lifelong relationships.', 'group' => 'homepage', 'label' => 'How It Works Subtitle', 'type' => 'textarea'],
            ['key' => 'how_it_works_steps', 'value' => json_encode([
                [
                    'step' => 'Step 01',
                    'icon' => 'fa-user-check',
                    'bg' => 'bg-rose-100 text-rose-600',
                    'badge_color' => 'text-rose-600',
                    'border_hover' => 'hover:border-rose-200',
                    'title' => 'Create & Verify Your Profile',
                    'desc' => 'Register your matrimonial profile, set preferences, and submit government ID/Citizenship to earn the trusted Green Verified badge.'
                ],
                [
                    'step' => 'Step 02',
                    'icon' => 'fa-wand-magic-sparkles',
                    'bg' => 'bg-indigo-100 text-indigo-600',
                    'badge_color' => 'text-indigo-600',
                    'border_hover' => 'hover:border-indigo-200',
                    'title' => 'Discover Compatible Matches',
                    'desc' => 'Filter by caste, education, diaspora country, and compute instant 36 Gun Milan astrological compatibility with Vedic accuracy.'
                ],
                [
                    'step' => 'Step 03',
                    'icon' => 'fa-comments',
                    'bg' => 'bg-pink-100 text-pink-600',
                    'badge_color' => 'text-pink-600',
                    'border_hover' => 'hover:border-pink-200',
                    'title' => 'Connect & Video Date',
                    'desc' => 'Send connect requests, converse in encrypted private chat, and meet face-to-face via secure in-app video calls without exposing phone numbers.'
                ]
            ], JSON_UNESCAPED_UNICODE), 'group' => 'homepage', 'label' => 'How It Works Steps JSON', 'type' => 'json'],

            // Dynamic Kundali Parallax Spotlight
            ['key' => 'kundali_badge', 'value' => 'Traditional Astrological Harmony', 'group' => 'homepage', 'label' => 'Kundali Section Badge', 'type' => 'text'],
            ['key' => 'kundali_title', 'value' => '36 Gun Milan & Kundali Compatibility for Nepali Marriages', 'group' => 'homepage', 'label' => 'Kundali Section Title', 'type' => 'text'],
            ['key' => 'kundali_description', 'value' => 'Honor centuries-old Nepali wedding traditions with our authentic Ashtakoota Gun Milan engine. Calculate compatibility across Varna, Vashya, Tara, Yoni, Graha Maitri, Gana, Bhakoot, and Nadi with instant Manglik Dosha screening.', 'group' => 'homepage', 'label' => 'Kundali Section Description', 'type' => 'textarea'],
            ['key' => 'kundali_features', 'value' => json_encode([
                'Rashi Compatibility',
                'Manglik Dosha Audit',
                'Gotra Alignment',
                'Ashtakoota Analysis'
            ], JSON_UNESCAPED_UNICODE), 'group' => 'homepage', 'label' => 'Kundali Features List', 'type' => 'json'],

            // Dynamic Why Choose MeroZodi (Trust Pillars)
            ['key' => 'why_choose_badge', 'value' => 'Built for Nepal & Global Diaspora', 'group' => 'homepage', 'label' => 'Why Choose Badge', 'type' => 'text'],
            ['key' => 'why_choose_title', 'value' => 'Why Singles & Families Trust MeroZodi', 'group' => 'homepage', 'label' => 'Why Choose Title', 'type' => 'text'],
            ['key' => 'why_choose_subtitle', 'value' => 'Industry-grade security, manual KYC audits, and respectful cultural matchmaking.', 'group' => 'homepage', 'label' => 'Why Choose Subtitle', 'type' => 'textarea'],
            ['key' => 'why_choose_pillars', 'value' => json_encode([
                [
                    'icon' => 'fa-id-card-clip',
                    'bg' => 'bg-rose-100 text-rose-600',
                    'title' => 'National ID & KYC Verification',
                    'desc' => 'Every profile undergoes citizenship and passport screening to eliminate fake accounts and guarantee trusted connections.'
                ],
                [
                    'icon' => 'fa-shield-halved',
                    'bg' => 'bg-indigo-100 text-indigo-600',
                    'title' => 'Photo Privacy Shield',
                    'desc' => 'Keep your photos private with blur protection and grant viewing permission only to prospective matches you approve.'
                ],
                [
                    'icon' => 'fa-video',
                    'bg' => 'bg-pink-100 text-pink-600',
                    'title' => '1-on-1 Encrypted Video Dates',
                    'desc' => 'Meet virtually in secure private video rooms without sharing personal phone numbers, ideal for cross-border NRI dating.'
                ],
                [
                    'icon' => 'fa-crown',
                    'bg' => 'bg-amber-100 text-amber-600',
                    'title' => 'Dedicated VIP Matchmakers',
                    'desc' => 'Get personalized assistance from seasoned matrimonial consultants who handpick matches for busy executives and families.'
                ]
            ], JSON_UNESCAPED_UNICODE), 'group' => 'homepage', 'label' => 'Trust Pillars JSON', 'type' => 'json'],

            // Dynamic Bottom CTA Banner
            ['key' => 'bottom_cta_badge', 'value' => 'Begin Your Happily Ever After', 'group' => 'homepage', 'label' => 'Bottom CTA Badge', 'type' => 'text'],
            ['key' => 'bottom_cta_title', 'value' => 'Your Soulmate is Just a Click Away', 'group' => 'homepage', 'label' => 'Bottom CTA Title', 'type' => 'text'],
            ['key' => 'bottom_cta_subtitle', 'value' => 'Join over 2,000+ verified Nepali singles across Kathmandu, Sydney, Dallas, London, Toronto, and worldwide. Create your free matrimony profile today.', 'group' => 'homepage', 'label' => 'Bottom CTA Subtitle', 'type' => 'textarea'],
            ['key' => 'bottom_cta_badges', 'value' => json_encode([
                ['icon' => 'fa-circle-check', 'text' => 'Free Registration'],
                ['icon' => 'fa-shield-halved', 'text' => '100% Privacy Control'],
                ['icon' => 'fa-id-card', 'text' => 'KYC ID Verified Members']
            ], JSON_UNESCAPED_UNICODE), 'group' => 'homepage', 'label' => 'Bottom CTA Trust Badges', 'type' => 'json'],

            // Dynamic Homepage FAQs
            ['key' => 'homepage_faqs', 'value' => json_encode([
                [
                    'question' => 'How does MeroZodi verify member profiles?',
                    'answer' => 'Every registered member on MeroZodi can submit government-issued identification (Nepali Citizenship, Passport, or Driving License). Our compliance team manually audits each document to ensure 100% authenticity and award the trusted Green Verified badge.'
                ],
                [
                    'question' => 'How does the 36 Gun Milan Kundali calculator work?',
                    'answer' => 'MeroZodi computes authentic Vedic Ashtakoota compatibility across 8 sacred parameters: Varna, Vashya, Tara, Yoni, Graha Maitri, Gana, Bhakoot, and Nadi totaling 36 points, alongside Manglik Dosha analysis for traditional Nepali families.'
                ],
                [
                    'question' => 'Is my photo and contact information private?',
                    'answer' => 'Yes. MeroZodi features a Photo Privacy Shield that blurs your photos until you approve viewing requests. Furthermore, members can communicate via in-app encrypted messages and 1-on-1 private video calls without revealing personal phone numbers.'
                ],
                [
                    'question' => 'Can Non-Resident Nepalis (NRIs) living abroad join MeroZodi?',
                    'answer' => 'Absolutely. Thousands of Nepali singles in Australia, the United States, Canada, the United Kingdom, and the Middle East actively use MeroZodi to connect with compatible partners sharing their cultural values.'
                ],
                [
                    'question' => 'How do 1-on-1 virtual video dates work?',
                    'answer' => 'Once connected or subscribed to a VIP package, members can schedule a virtual date. At the scheduled time, both enter a high-definition private encrypted video room right inside MeroZodi without needing external apps or phone numbers.'
                ],
                [
                    'question' => 'What payment methods are supported in Nepal?',
                    'answer' => 'MeroZodi supports instant automated activations via Nepal\'s leading digital wallets and interbank gateways, including eSewa ePay, Khalti, Fonepay Dynamic QR, and ConnectIPS NCHL.'
                ]
            ], JSON_UNESCAPED_UNICODE), 'group' => 'homepage', 'label' => 'Homepage FAQs JSON', 'type' => 'json'],
        ];

        foreach ($settings as $s) {
            SiteSetting::updateOrCreate(['key' => $s['key']], $s);
        }
    }
}
