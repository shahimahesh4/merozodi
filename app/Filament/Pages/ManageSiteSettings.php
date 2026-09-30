<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Cache;

class ManageSiteSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static \UnitEnum|string|null $navigationGroup = 'Settings & Configuration';

    protected static ?string $navigationLabel = 'Website Settings';

    protected static ?string $title = 'Website Settings';

    protected static ?string $slug = 'website-settings';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.manage-site-settings';

    public static function canAccess(): bool
    {
        return auth()->user()?->isSuperAdmin() || (bool) auth()->user()?->hasPermission('view_settings');
    }

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();

        // Sync synonym keys
        if (!isset($settings['hero_title']) && isset($settings['hero_title_prefix'])) {
            $settings['hero_title'] = $settings['hero_title_prefix'];
        }
        if (!isset($settings['hero_accent_text']) && isset($settings['hero_title_highlight'])) {
            $settings['hero_accent_text'] = $settings['hero_title_highlight'];
        }

        // Parse booleans for switches
        $booleanKeys = [
            'esewa_enabled', 'esewa_sandbox',
            'khalti_enabled', 'khalti_sandbox',
            'fonepay_enabled', 'fonepay_sandbox',
            'connectips_enabled', 'connectips_sandbox',
            'bank_transfer_enabled',
            'ai_horoscope_enabled',
            'recaptcha_enabled',
        ];

        foreach ($booleanKeys as $bKey) {
            if (isset($settings[$bKey])) {
                $settings[$bKey] = filter_var($settings[$bKey], FILTER_VALIDATE_BOOLEAN);
            }
        }

        // Format JSON strings for clean readability in textareas
        $jsonKeys = [
            'hero_trust_badges', 'how_it_works_steps', 'kundali_features',
            'why_choose_pillars', 'bottom_cta_badges', 'homepage_faqs',
        ];

        foreach ($jsonKeys as $jKey) {
            if (!empty($settings[$jKey])) {
                $decoded = json_decode($settings[$jKey], true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $settings[$jKey] = json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                }
            }
        }

        $this->form->fill($settings);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('saveHeader')
                ->label('Save Settings')
                ->icon('heroicon-m-check')
                ->color('primary')
                ->action('save')
                ->keyBindings(['mod+s']),
        ];
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Tabs::make('Website Settings Tabs')
                    ->tabs([
                        // Tab 1: General / Website
                        Tab::make('General & Branding')
                            ->icon('heroicon-m-building-storefront')
                            ->schema([
                                Section::make('General Configuration')
                                    ->description('Primary contact details, brand identity, and versioning.')
                                    ->schema([
                                        TextInput::make('site_name')
                                            ->label('Site Name')
                                            ->required()
                                            ->placeholder('MeroZodi Matrimony'),
                                        TextInput::make('tagline')
                                            ->label('Site Tagline / Slogan')
                                            ->placeholder("Nepal's Leading Matrimony & Matchmaking Platform"),
                                        TextInput::make('helpline_phone')
                                            ->label('Helpline Phone Hotline')
                                            ->placeholder('+977-1-4567890'),
                                        TextInput::make('support_email')
                                            ->label('Support Email Address')
                                            ->email()
                                            ->placeholder('support@merozodi.com'),
                                        TextInput::make('whatsapp_desk')
                                            ->label('WhatsApp Support Hotline')
                                            ->placeholder('+977-9801234567'),
                                        TextInput::make('app_version')
                                            ->label('Application Version Tag')
                                            ->placeholder('Beta Version 2.0'),
                                        TextInput::make('office_address')
                                            ->label('Physical Office Address')
                                            ->placeholder('Lazimpat, Kathmandu, Nepal')
                                            ->columnSpanFull(),
                                    ])->columns(2),

                                Section::make('Company Legal & Tax Details')
                                    ->description('Registered business legal credentials and jurisdiction.')
                                    ->schema([
                                        TextInput::make('company_legal_name')
                                            ->label('Legal Business Name')
                                            ->placeholder('MeroZodi Matchmaking Technologies Pvt. Ltd.'),
                                        TextInput::make('company_pan_vat')
                                            ->label('PAN / VAT Registration Number')
                                            ->placeholder('609823412'),
                                        TextInput::make('office_city_province')
                                            ->label('City & Province')
                                            ->placeholder('Bagmati Province, Nepal'),
                                    ])->columns(3),

                                Section::make('Branding & Visual Assets')
                                    ->description('Logo paths, favicons, and global SEO metadata.')
                                    ->schema([
                                        TextInput::make('site_logo')
                                            ->label('Site Logo URL / Path')
                                            ->placeholder('images/logo.png'),
                                        TextInput::make('site_favicon')
                                            ->label('Favicon URL / Path')
                                            ->placeholder('images/logo.png'),
                                        FileUpload::make('hero_bg_image')
                                            ->label('Homepage Hero Banner Image')
                                            ->image()
                                            ->directory('site/banners')
                                            ->visibility('public')
                                            ->imageEditor()
                                            ->maxSize(5120)
                                            ->helperText('Upload a high-quality wedding / couple background banner for the homepage.'),
                                        Textarea::make('site_description')
                                            ->label('Global SEO Meta Description')
                                            ->rows(2)
                                            ->columnSpanFull()
                                            ->placeholder("Find your ideal life partner with MeroZodi..."),
                                    ])->columns(3),

                                Section::make('Social Media Accounts')
                                    ->description('Configure profile links for platform and community social networks.')
                                    ->schema([
                                        TextInput::make('facebook_url')
                                            ->label('Facebook URL')
                                            ->url()
                                            ->placeholder('https://facebook.com/merozodi'),
                                        TextInput::make('instagram_url')
                                            ->label('Instagram URL')
                                            ->url()
                                            ->placeholder('https://instagram.com/merozodi'),
                                        TextInput::make('twitter_url')
                                            ->label('Twitter / X URL')
                                            ->url()
                                            ->placeholder('https://x.com/merozodi'),
                                        TextInput::make('youtube_url')
                                            ->label('YouTube Channel URL')
                                            ->url()
                                            ->placeholder('https://youtube.com/@merozodi'),
                                        TextInput::make('tiktok_url')
                                            ->label('TikTok URL')
                                            ->url()
                                            ->placeholder('https://tiktok.com/@merozodi'),
                                        TextInput::make('linkedin_url')
                                            ->label('LinkedIn URL')
                                            ->url()
                                            ->placeholder('https://linkedin.com/company/merozodi'),
                                    ])->columns(3),
                            ]),

                        // Tab 2: Homepage & Content
                        Tab::make('Homepage & Content')
                            ->icon('heroicon-m-sparkles')
                            ->schema([
                                Section::make('Hero & Headlines')
                                    ->description('Content shown above the dynamic search and profile registration cards.')
                                    ->schema([
                                        TextInput::make('hero_badge')
                                            ->label('Hero Top Eyebrow / Badge')
                                            ->placeholder("Nepal's #1 Matrimony & Matchmaking Platform"),
                                        TextInput::make('hero_title')
                                            ->label('Hero Main Title')
                                            ->placeholder('Find Your Perfect Life Partner'),
                                        TextInput::make('hero_accent_text')
                                            ->label('Hero Accent Text (Gradient / Highlight)')
                                            ->placeholder('Cultural Trust'),
                                        Textarea::make('hero_subtitle')
                                            ->label('Hero Subtitle / Description')
                                            ->rows(2)
                                            ->columnSpanFull()
                                            ->placeholder('Connect with 100% ID-verified Nepali singles...'),
                                        Textarea::make('hero_trust_badges')
                                            ->label('Hero Trust Badges (JSON)')
                                            ->rows(3)
                                            ->columnSpanFull()
                                            ->helperText('JSON array of badges with "icon" and "text" keys.'),
                                    ])->columns(3),

                                Section::make('Homepage Real-Time Numbers & Statistics')
                                    ->description('Credibility counters prominently featured on the homepage.')
                                    ->schema([
                                        TextInput::make('stat_1_value')->label('Stat 1 Value')->placeholder('2,000+'),
                                        TextInput::make('stat_1_label')->label('Stat 1 Label')->placeholder('Verified Singles'),
                                        TextInput::make('stat_2_value')->label('Stat 2 Value')->placeholder('1,200+'),
                                        TextInput::make('stat_2_label')->label('Stat 2 Label')->placeholder('Happy Couples'),
                                        TextInput::make('stat_3_value')->label('Stat 3 Value')->placeholder('35+ Countries'),
                                        TextInput::make('stat_3_label')->label('Stat 3 Label')->placeholder('Nepali Diaspora'),
                                        TextInput::make('stat_4_value')->label('Stat 4 Value')->placeholder('100% Safe'),
                                        TextInput::make('stat_4_label')->label('Stat 4 Label')->placeholder('KYC Protected'),
                                    ])->columns(4),

                                Section::make('How It Works in 3 Steps')
                                    ->description('User onboarding journey and steps.')
                                    ->schema([
                                        TextInput::make('how_it_works_badge')->label('Badge')->placeholder('Simple & Trustworthy'),
                                        TextInput::make('how_it_works_title')->label('Heading')->placeholder('How MeroZodi Works in 3 Steps'),
                                        Textarea::make('how_it_works_subtitle')->label('Subtitle')->rows(2)->columnSpanFull(),
                                        Textarea::make('how_it_works_steps')
                                            ->label('Step Cards Configuration (JSON)')
                                            ->rows(6)
                                            ->columnSpanFull()
                                            ->helperText('JSON array containing step cards with step, icon, title, and desc.'),
                                    ])->columns(2),

                                Section::make('Vedic Kundali 36 Gun Milan Compatibility')
                                    ->description('Astrological matching banner content.')
                                    ->schema([
                                        TextInput::make('kundali_badge')->label('Kundali Eyebrow')->placeholder('Traditional Astrological Harmony'),
                                        TextInput::make('kundali_title')->label('Kundali Heading')->placeholder('36 Gun Milan & Kundali Compatibility for Nepali Marriages'),
                                        Textarea::make('kundali_description')->label('Kundali Description')->rows(3)->columnSpanFull(),
                                        Textarea::make('kundali_features')
                                            ->label('Kundali Feature Tags (JSON)')
                                            ->rows(2)
                                            ->columnSpanFull()
                                            ->helperText('e.g. ["Rashi Compatibility", "Manglik Dosha Audit", "Gotra Alignment", "Ashtakoota Analysis"]'),
                                    ])->columns(2),

                                Section::make('Why Choose MeroZodi & Safety Highlights')
                                    ->description('Trust, safety, and security highlights.')
                                    ->schema([
                                        TextInput::make('why_choose_badge')->label('Section Eyebrow')->placeholder('Built for Nepal & Global Diaspora'),
                                        TextInput::make('why_choose_title')->label('Section Heading')->placeholder('Why Singles & Families Trust MeroZodi'),
                                        Textarea::make('why_choose_subtitle')->label('Supporting Subtitle')->rows(2)->columnSpanFull(),
                                        Textarea::make('why_choose_pillars')
                                            ->label('Trust Pillars (JSON)')
                                            ->rows(6)
                                            ->columnSpanFull()
                                            ->helperText('JSON array containing pillar cards with icon, bg, title, and desc.'),
                                    ])->columns(2),

                                Section::make('Bottom Call to Action Banner')
                                    ->description('Conversion banner at the bottom of the public homepage.')
                                    ->schema([
                                        TextInput::make('bottom_cta_badge')->label('CTA Eyebrow')->placeholder('Begin Your Happily Ever After'),
                                        TextInput::make('bottom_cta_title')->label('CTA Heading')->placeholder('Your Soulmate is Just a Click Away'),
                                        Textarea::make('bottom_cta_subtitle')->label('Supporting Text')->rows(2)->columnSpanFull(),
                                        Textarea::make('bottom_cta_badges')
                                            ->label('CTA Feature Badges (JSON)')
                                            ->rows(3)
                                            ->columnSpanFull()
                                            ->helperText('JSON array of badges with "icon" and "text" keys.'),
                                    ])->columns(2),

                                Section::make('Homepage Frequently Asked Questions (FAQs)')
                                    ->description('Common questions and answers shown on the public landing page.')
                                    ->schema([
                                        Textarea::make('homepage_faqs')
                                            ->label('Homepage FAQs (JSON List)')
                                            ->rows(8)
                                            ->columnSpanFull()
                                            ->helperText('JSON array of FAQs: [{"question": "...", "answer": "..."}]'),
                                    ]),
                            ]),

                        // Tab 3: Communications & Contact
                        Tab::make('Communications & Helpdesk')
                            ->icon('heroicon-m-chat-bubble-left-right')
                            ->schema([
                                Section::make('Customer Helpdesk & Contacts')
                                    ->description('Direct contacts shown across header, footer, and support desk.')
                                    ->schema([
                                        TextInput::make('helpline_phone')->label('Customer Care Phone Hotline'),
                                        TextInput::make('support_email')->label('Official Support Email')->email(),
                                        TextInput::make('whatsapp_desk')->label('WhatsApp Support Desk Number'),
                                        TextInput::make('office_address')->label('Physical Office Address'),
                                    ])->columns(2),

                                Section::make('Footer Credentials & Legal Disclaimers')
                                    ->description('Global footer credentials, copyright notes, and links.')
                                    ->schema([
                                        TextInput::make('footer_about_title')->label('About Section Title'),
                                        Textarea::make('footer_about_text')->label('About Short Summary')->rows(2),
                                        TextInput::make('footer_payment_title')->label('Payment Section Title'),
                                        TextInput::make('footer_payment_text')->label('Payment Section Note'),
                                        TextInput::make('copyright_text')->label('Copyright Notice'),
                                        TextInput::make('powered_by_text')->label('Powered By Brand'),
                                        TextInput::make('powered_by_url')->label('Powered By Link')->url(),
                                    ])->columns(2),
                            ]),

                        // Tab 4: Payment Gateways
                        Tab::make('Payment Gateways')
                            ->icon('heroicon-m-credit-card')
                            ->schema([
                                Section::make('eSewa Mobile Wallet (ePay 2.0)')
                                    ->description('Nepal’s leading digital wallet gateway.')
                                    ->schema([
                                        Toggle::make('esewa_enabled')->label('Enable eSewa Gateway')->inline(false),
                                        Toggle::make('esewa_sandbox')->label('Test / Sandbox Mode')->inline(false),
                                        TextInput::make('esewa_merchant_id')->label('eSewa Product / Merchant Code'),
                                        TextInput::make('esewa_secret_key')->label('eSewa Secret Hash Key')->password(),
                                    ])->columns(2),

                                Section::make('Khalti Digital Wallet (EPAY v2)')
                                    ->description('Direct wallet and banking payment gateway.')
                                    ->schema([
                                        Toggle::make('khalti_enabled')->label('Enable Khalti Gateway')->inline(false),
                                        Toggle::make('khalti_sandbox')->label('Test / Sandbox Mode')->inline(false),
                                        TextInput::make('khalti_public_key')->label('Live / Test Public Key'),
                                        TextInput::make('khalti_secret_key')->label('Live / Test Secret Key')->password(),
                                    ])->columns(2),

                                Section::make('Fonepay Dynamic QR')
                                    ->description('Direct mobile banking dynamic QR integration.')
                                    ->schema([
                                        Toggle::make('fonepay_enabled')->label('Enable Fonepay Gateway')->inline(false),
                                        Toggle::make('fonepay_sandbox')->label('Test / Sandbox Mode')->inline(false),
                                        TextInput::make('fonepay_merchant_code')->label('Merchant Code'),
                                        TextInput::make('fonepay_secret_key')->label('API Secret Key')->password(),
                                    ])->columns(2),

                                Section::make('ConnectIPS (NCHL Direct Debit)')
                                    ->description('Direct real-time bank debit gateway.')
                                    ->schema([
                                        Toggle::make('connectips_enabled')->label('Enable ConnectIPS Gateway')->inline(false),
                                        Toggle::make('connectips_sandbox')->label('Test / Sandbox Mode')->inline(false),
                                        TextInput::make('connectips_merchant_id')->label('ConnectIPS Merchant ID'),
                                        TextInput::make('connectips_app_id')->label('Application ID'),
                                    ])->columns(2),

                                Section::make('Offline Direct Bank Transfer / Deposit')
                                    ->description('Manual bank payment instructions shown at checkout.')
                                    ->schema([
                                        Toggle::make('bank_transfer_enabled')->label('Enable Bank Transfer')->inline(false),
                                        TextInput::make('bank_name')->label('Bank Name'),
                                        TextInput::make('bank_account_name')->label('Beneficiary Account Name'),
                                        TextInput::make('bank_account_number')->label('Account Number'),
                                        TextInput::make('bank_branch')->label('Bank Branch Location'),
                                    ])->columns(2),
                            ]),

                        // Tab 5: System & Integrations
                        Tab::make('Integrations & AI')
                            ->icon('heroicon-m-puzzle-piece')
                            ->schema([
                                Section::make('Google Gemini AI Integration')
                                    ->description('Configure Google Gemini LLM settings to enable automated matchmaking recommendations and horoscope insights.')
                                    ->schema([
                                        TextInput::make('gemini_api_key')
                                            ->label('Gemini API Key')
                                            ->password()
                                            ->placeholder('AIzaSy...')
                                            ->helperText('Get your API key from Google AI Studio (ai.google.dev).'),
                                        Select::make('gemini_model')
                                            ->label('Active AI Model')
                                            ->options([
                                                'gemini-1.5-flash' => 'Gemini 1.5 Flash (Default - High Speed)',
                                                'gemini-1.5-pro' => 'Gemini 1.5 Pro (Deep Astrological Reasoning)',
                                                'gemini-2.0-flash' => 'Gemini 2.0 Flash (Next-Gen Performance)',
                                            ])
                                            ->default('gemini-1.5-flash'),
                                        Toggle::make('ai_horoscope_enabled')
                                            ->label('Enable AI Horoscope Compatibility Insights')
                                            ->default(true),
                                    ])->columns(2),

                                Section::make('Google reCAPTCHA')
                                    ->description('Enable Google reCAPTCHA on website forms to reduce spam. Leave keys blank to disable.')
                                    ->schema([
                                        Toggle::make('recaptcha_enabled')
                                            ->label('Enable Google reCAPTCHA')
                                            ->inline(false),
                                        TextInput::make('recaptcha_site_key')
                                            ->label('reCAPTCHA Site Key')
                                            ->placeholder('Enter Google reCAPTCHA site key.'),
                                        TextInput::make('recaptcha_secret_key')
                                            ->label('reCAPTCHA Secret Key')
                                            ->password()
                                            ->placeholder('Enter Google reCAPTCHA secret key.'),
                                    ])->columns(3),

                                Section::make('Analytics & Tracking Pixels')
                                    ->description('Add your GA4 Measurement ID to measure website visits and engagement.')
                                    ->schema([
                                        TextInput::make('ga_measurement_id')
                                            ->label('GA4 Measurement ID')
                                            ->placeholder('G-TN4GGFHJ00')
                                            ->helperText('Create a GA4 web data stream and paste its Measurement ID. Leave blank to disable analytics.'),
                                        TextInput::make('facebook_pixel_id')
                                            ->label('Meta / Facebook Pixel ID')
                                            ->placeholder('Pixel ID'),
                                    ])->columns(2),
                            ]),
                    ]),
            ]);
    }

    public function save(): void
    {
        $state = $this->form->getState();

        // Sync synonym pairs
        if (isset($state['hero_title'])) {
            $state['hero_title_prefix'] = $state['hero_title'];
        }
        if (isset($state['hero_accent_text'])) {
            $state['hero_title_highlight'] = $state['hero_accent_text'];
        }

        foreach ($state as $key => $value) {
            $group = 'general';
            if (str_starts_with($key, 'esewa_') || str_starts_with($key, 'khalti_') || str_starts_with($key, 'fonepay_') || str_starts_with($key, 'connectips_') || str_starts_with($key, 'bank_')) {
                $group = 'payment';
            } elseif (str_starts_with($key, 'stat_')) {
                $group = 'homepage_stats';
            } elseif (str_starts_with($key, 'hero_') || str_starts_with($key, 'kundali_') || str_starts_with($key, 'why_choose_') || str_starts_with($key, 'bottom_cta_') || str_starts_with($key, 'how_it_works_') || $key === 'homepage_faqs') {
                $group = 'homepage';
            } elseif (str_starts_with($key, 'facebook_') || str_starts_with($key, 'instagram_') || str_starts_with($key, 'twitter_') || str_starts_with($key, 'youtube_') || str_starts_with($key, 'tiktok_') || str_starts_with($key, 'linkedin_')) {
                $group = 'social';
            } elseif (str_starts_with($key, 'footer_') || str_starts_with($key, 'copyright_') || str_starts_with($key, 'powered_by_')) {
                $group = 'footer';
            } elseif (str_starts_with($key, 'helpline_') || str_starts_with($key, 'support_') || str_starts_with($key, 'whatsapp_') || str_starts_with($key, 'office_')) {
                $group = 'contact';
            } elseif (str_starts_with($key, 'gemini_') || str_starts_with($key, 'recaptcha_') || str_starts_with($key, 'ga_') || str_starts_with($key, 'facebook_pixel_') || str_starts_with($key, 'ai_')) {
                $group = 'integrations';
            }

            $type = 'text';
            if (is_bool($value)) {
                $type = 'boolean';
                $storedVal = $value ? '1' : '0';
            } elseif (in_array($key, ['hero_trust_badges', 'how_it_works_steps', 'kundali_features', 'why_choose_pillars', 'bottom_cta_badges', 'homepage_faqs'])) {
                $type = 'json';
                $storedVal = (string) ($value ?? '[]');
            } elseif (in_array($key, ['hero_subtitle', 'site_description', 'how_it_works_subtitle', 'kundali_description', 'why_choose_subtitle', 'bottom_cta_subtitle', 'footer_about_text'])) {
                $type = 'textarea';
                $storedVal = (string) ($value ?? '');
            } else {
                $storedVal = (string) ($value ?? '');
            }

            SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $storedVal,
                    'group' => $group,
                    'label' => ucwords(str_replace('_', ' ', $key)),
                    'type' => $type,
                ]
            );
        }

        Cache::forget('global_site_settings');

        Notification::make()
            ->title('Website Settings Saved Successfully')
            ->body('All configurations across tabs have been updated and refreshed in real time.')
            ->success()
            ->send();
    }
}
