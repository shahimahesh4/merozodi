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

        // 2. Global Site Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'MeroZodi Matrimony', 'group' => 'general', 'label' => 'Site Name', 'type' => 'text'],
            ['key' => 'tagline', 'value' => "Nepal's Leading Matrimony & Matchmaking Platform", 'group' => 'general', 'label' => 'Site Tagline', 'type' => 'text'],
            ['key' => 'helpline_phone', 'value' => '+977-1-4567890', 'group' => 'contact', 'label' => 'Helpline Phone', 'type' => 'text'],
            ['key' => 'whatsapp_desk', 'value' => '+977-9801234567', 'group' => 'contact', 'label' => 'WhatsApp Support Desk', 'type' => 'text'],
            ['key' => 'support_email', 'value' => 'support@merozodi.com', 'group' => 'contact', 'label' => 'Support Email', 'type' => 'text'],
            ['key' => 'office_address', 'value' => 'Lazimpat, Kathmandu, Nepal', 'group' => 'contact', 'label' => 'Office Address', 'type' => 'text'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/merozodi', 'group' => 'social', 'label' => 'Facebook URL', 'type' => 'text'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/merozodi', 'group' => 'social', 'label' => 'Instagram URL', 'type' => 'text'],
            ['key' => 'esewa_sandbox', 'value' => '1', 'group' => 'payment', 'label' => 'eSewa Test/Sandbox Mode', 'type' => 'boolean'],
            ['key' => 'khalti_sandbox', 'value' => '1', 'group' => 'payment', 'label' => 'Khalti Test/Sandbox Mode', 'type' => 'boolean'],
        ];

        foreach ($settings as $s) {
            SiteSetting::updateOrCreate(['key' => $s['key']], $s);
        }
    }
}
