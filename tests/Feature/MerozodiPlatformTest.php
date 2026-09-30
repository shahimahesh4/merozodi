<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Tests\TestCase;

class MerozodiPlatformTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_homepage_loads_successfully(): void
    {
        // 1. Guest visits homepage - profiles are hidden
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('MeroZodi');
        $response->assertSee('Member Profiles Are Private');

        // 2. Logged-in user visits homepage - featured verified profiles are displayed
        $user = User::where('email', 'shahimahesh4@gmail.com')->first();
        $this->actingAs($user);
        $authResponse = $this->get('/');
        $authResponse->assertStatus(200);
        $authResponse->assertSee('Featured Verified Matches');
    }

    public function test_browse_profiles_requires_login(): void
    {
        // 1. Guest visits /browse -> redirected to /login
        Auth::logout();
        $guestResponse = $this->get('/browse');
        $guestResponse->assertRedirect(route('login'));

        // 2. Authenticated user visits /browse -> 200 OK with profiles
        $user = User::where('email', 'shahimahesh4@gmail.com')->first();
        $this->actingAs($user);
        $authResponse = $this->get('/browse');
        $authResponse->assertStatus(200);
        $authResponse->assertSee('Discover Matches');
    }

    public function test_pricing_page_loads_with_plans(): void
    {
        $response = $this->get('/pricing');
        $response->assertStatus(200);
        $response->assertSee('Premium Package');
    }

    public function test_events_page_loads_with_upcoming_events(): void
    {
        $response = $this->get('/events');
        $response->assertStatus(200);
        $response->assertSee('Kathmandu Premium Singles Mixer');
    }

    public function test_blog_page_loads_with_articles(): void
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);
        $response->assertSee('Kundali Matching & Gun Milan');
    }

    public function test_single_blog_detail_page_loads(): void
    {
        $response = $this->get('/blog/kundali-matching-gun-milan-modern-nepali-marriages');
        $response->assertStatus(200);
        $response->assertSee('Ashtakoota');
    }

    public function test_login_and_register_pages_are_accessible_for_guests(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);

        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_access_dashboard_and_my_profile(): void
    {
        $user = User::where('email', 'shahimahesh4@gmail.com')->first();
        $this->actingAs($user);

        $response = $this->get('/dashboard');
        $response->assertStatus(200);

        $response = $this->get('/my-profile');
        $response->assertStatus(200);

        $response = $this->get('/my-activity');
        $response->assertStatus(200);

        $response = $this->get('/my-kyc');
        $response->assertStatus(200);

        $response = $this->get('/messages');
        $response->assertStatus(200);

        $response = $this->get(route('video.room', ['room' => 'test-room-123']));
        $response->assertStatus(200);
        $response->assertSee('test-room-123');
    }

    public function test_user_can_send_chat_message_with_attachment(): void
    {
        $user1 = User::where('email', 'shahimahesh4@gmail.com')->first();
        $user2 = User::where('id', '!=', $user1->id)->first();
        $this->actingAs($user1);

        \Illuminate\Support\Facades\Storage::fake('public');
        $file = \Illuminate\Http\UploadedFile::fake()->create('screenshot.png', 100, 'image/png');

        \Livewire\Livewire::test(\App\Livewire\ChatInbox::class, ['selectedUserId' => $user2->id])
            ->set('newMessage', 'Hello with screenshot! 💖')
            ->set('attachment', $file)
            ->call('sendMessage')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('messages', [
            'sender_id' => $user1->id,
            'receiver_id' => $user2->id,
            'type' => 'image',
            'attachment_name' => 'screenshot.png',
        ]);
    }

    public function test_authenticated_user_can_access_checkout_and_initiate_payments(): void
    {
        $user = User::where('email', 'shahimahesh4@gmail.com')->first();
        $this->actingAs($user);

        // Checkout page
        $response = $this->get('/checkout/3');
        $response->assertStatus(200);
        $response->assertSee('NPR');

        // Create a test payment
        $payment = \App\Models\Payment::create([
            'user_id' => $user->id,
            'transaction_id' => 'MZ-TEST-' . time(),
            'payment_gateway' => 'esewa',
            'amount' => 8500.00,
            'tax_amount' => 1105.00,
            'total_amount' => 9605.00,
            'status' => 'pending',
        ]);

        // eSewa initiate
        $response = $this->get(route('payment.esewa.initiate', $payment->id));
        $response->assertStatus(200);
        $response->assertSee('eSewa');

        // Khalti initiate
        $response = $this->get(route('payment.khalti.initiate', $payment->id));
        $response->assertStatus(200);
        $response->assertSee('Khalti');

        // Fonepay initiate
        $response = $this->get(route('payment.fonepay.initiate', $payment->id));
        $response->assertStatus(200);
        $response->assertSee('Fonepay');

        // ConnectIPS initiate
        $response = $this->get(route('payment.connectips.initiate', $payment->id));
        $response->assertStatus(200);
        $response->assertSee('ConnectIPS');

        // Invoice Receipt view
        $response = $this->get(route('invoice.show', $payment->id));
        $response->assertStatus(200);
        $response->assertSee('Tax Invoice');
    }

    public function test_admin_can_access_filament_dashboard(): void
    {
        $admin = User::where('email', 'shahimahesh4@gmail.com')->first();
        $this->actingAs($admin);

        $response = $this->get('/stnapanel');
        $response->assertStatus(200);

        // Filament CMS Pages Resource
        $response = $this->get('/stnapanel/pages');
        $response->assertStatus(200);

        // Filament Contact Inquiries Resource
        $response = $this->get('/stnapanel/contact-inquiries');
        $response->assertStatus(200);
    }

    public function test_about_us_page_loads_with_cms_content(): void
    {
        $response = $this->get('/about-us');
        $response->assertStatus(200);
        $response->assertSee('About MeroZodi');
    }

    public function test_contact_us_page_loads_and_form_submits_inquiry(): void
    {
        $response = $this->get('/contact-us');
        $response->assertStatus(200);
        $response->assertSee('Contact Us');
        $response->assertSee('Send Us a Direct Message');

        \Livewire\Livewire::test(\App\Livewire\ContactUs::class)
            ->set('name', 'Bikash Thapa')
            ->set('email', 'bikash@example.com')
            ->set('phone', '9841234567')
            ->set('subject', 'Partnership Inquiry')
            ->set('message', 'We would love to collaborate on Astrological matching algorithms.')
            ->call('submitInquiry')
            ->assertHasNoErrors()
            ->assertSee('Namaste Bikash Thapa')
            ->assertSet('name', '');

        $this->assertDatabaseHas('contact_inquiries', [
            'name' => 'Bikash Thapa',
            'email' => 'bikash@example.com',
            'phone' => '9841234567',
            'is_read' => false,
        ]);
    }

    public function test_privacy_policy_and_terms_pages_load(): void
    {
        $response = $this->get('/privacy-policy');
        $response->assertStatus(200);
        $response->assertSee('Privacy Policy');

        $response = $this->get('/terms-and-conditions');
        $response->assertStatus(200);
        $response->assertSee('Terms & Conditions');
    }

    public function test_dynamic_custom_slug_page_loads(): void
    {
        \App\Models\Page::create([
            'title' => 'Safety & Verification Guidelines',
            'slug' => 'safety-guidelines',
            'content' => '<p>Always verify photo ID and meet in public places in Nepal.</p>',
            'meta_description' => 'Safety tips for singles.',
            'is_published' => true,
        ]);

        $response = $this->get('/p/safety-guidelines');
        $response->assertStatus(200);
        $response->assertSee('Safety & Verification Guidelines');
        $response->assertSee('Always verify photo ID');
    }

    public function test_kundali_gun_milan_service_computes_vedic_compatibility(): void
    {
        $user1 = User::where('email', 'shahimahesh4@gmail.com')->first();
        $user2 = User::where('id', '!=', $user1->id)->first();

        $result = \App\Services\KundaliMatchingService::calculateMatch($user1, $user2);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('total_score', $result);
        $this->assertArrayHasKey('max_score', $result);
        $this->assertEquals(36, $result['max_score']);
        $this->assertArrayHasKey('manglik_analysis', $result);
        $this->assertArrayHasKey('gotra_analysis', $result);
        $this->assertCount(8, $result['breakdown']);
    }

    public function test_photo_privacy_shield_request_flow(): void
    {
        $user1 = User::where('email', 'shahimahesh4@gmail.com')->first();
        $user2 = User::where('id', '!=', $user1->id)->first();
        $this->actingAs($user1);

        // Send photo access request
        \Livewire\Livewire::test(\App\Livewire\ProfileDetail::class, ['id' => $user2->id])
            ->call('requestPhotoAccess')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('photo_requests', [
            'requester_id' => $user1->id,
            'target_user_id' => $user2->id,
            'status' => 'pending',
        ]);
    }

    public function test_checkout_coupon_discount_calculation(): void
    {
        $user = User::where('email', 'shahimahesh4@gmail.com')->first();
        $this->actingAs($user);

        $plan = \App\Models\SubscriptionPlan::where('price_npr', '>=', 1000)->first();

        \Livewire\Livewire::test(\App\Livewire\CheckoutPage::class, ['planId' => $plan->id])
            ->set('couponCode', 'DASHAIN2026')
            ->call('applyCoupon')
            ->assertHasNoErrors()
            ->assertSee('applied successfully');
    }

    public function test_registration_wizard_with_marital_status_and_created_by_flow(): void
    {
        $religion = \App\Models\Religion::first();
        $caste = \App\Models\Caste::first();
        $eduLevel = \App\Models\EducationLevel::first();
        $occupation = \App\Models\Occupation::first();

        \Livewire\Livewire::test(\App\Livewire\Auth\RegisterWizard::class)
            ->set('profile_created_by', 'parents')
            ->set('name', 'Bikash Thapa')
            ->set('email', 'bikash.thapa@example.com')
            ->set('phone', '+977-9812345678')
            ->set('password', 'password123')
            ->set('password_confirmation', 'password123')
            ->set('gender', 'male')
            ->set('marital_status', 'unmarried')
            ->set('dob', '1995-05-15')
            ->set('living_country', 'Nepal')
            ->set('living_city', 'Kathmandu')
            ->call('nextStep')
            ->assertSet('currentStep', 2)
            ->set('religion_id', $religion->id)
            ->set('caste_id', $caste->id)
            ->call('nextStep')
            ->assertSet('currentStep', 3)
            ->set('height_cm', 175)
            ->set('diet', 'vegetarian')
            ->call('nextStep')
            ->assertSet('currentStep', 4)
            ->set('education_level_id', $eduLevel->id)
            ->set('occupation_id', $occupation->id)
            ->call('nextStep')
            ->assertSet('currentStep', 5)
            ->call('register')
            ->assertSet('currentStep', 6)
            ->assertSee('Registration Confirmed')
            ->assertSee('Your Official Matrimony ID')
            ->set('pinCode', '1234')
            ->call('verifyPhonePin')
            ->assertSet('phoneVerified', true)
            ->call('finishRegistration')
            ->assertRedirect(route('browse'));

        $this->assertDatabaseHas('users', [
            'email' => 'bikash.thapa@example.com',
            'profile_created_by' => 'parents',
            'marital_status' => 'unmarried',
            'is_verified' => false,
            'status' => 'pending_approval',
        ]);

        $this->assertDatabaseHas('user_profiles', [
            'profile_created_by' => 'parents',
            'marital_status' => 'unmarried',
        ]);

        $user = User::where('email', 'bikash.thapa@example.com')->first();
        $this->assertEquals('Parents', $user->profile_created_by_label);
        $this->assertStringStartsWith('MZ', $user->matrimony_id);
        $this->assertFalse($user->is_verified);
        $this->assertEquals('pending_approval', $user->status);

        // Test login with Matrimony ID
        Auth::logout();
        Livewire::test(\App\Livewire\Auth\Login::class)
            ->set('email', $user->matrimony_id)
            ->set('password', 'password123')
            ->call('login')
            ->assertRedirect(route('browse'));

        $this->assertTrue(Auth::check());
        $this->assertEquals($user->id, Auth::id());
    }

    public function test_only_verified_profiles_are_shown_publicly_and_admin_can_verify(): void
    {
        // 1. Create a newly registered unverified user
        $unverifiedUser = User::create([
            'name' => 'Suman Gautam',
            'email' => 'suman.gautam@example.com',
            'password' => bcrypt('password123'),
            'gender' => 'male',
            'dob' => '1995-01-01',
            'role' => 'user',
            'is_verified' => false,
            'status' => 'pending_approval',
        ]);

        \App\Models\UserProfile::create([
            'user_id' => $unverifiedUser->id,
            'mother_tongue' => 'Nepali',
            'profile_visibility' => 'public',
        ]);

        // 2. Unauthenticated guest visiting /browse or /profile gets redirected to /login
        Auth::logout();
        $this->get('/browse')->assertRedirect(route('login'));
        $this->get(route('profile.show', $unverifiedUser->id))->assertRedirect(route('login'));

        // 3. Logged-in user viewing /browse should NOT see unverified user
        $viewer = User::where('email', 'shahimahesh4@gmail.com')->first();
        $this->actingAs($viewer);
        $response = $this->get('/browse');
        $response->assertStatus(200);
        $response->assertDontSee('Suman Gautam');

        \Livewire\Livewire::test(\App\Livewire\BrowseProfiles::class, ['searchQuery' => 'Suman Gautam'])
            ->assertDontSee('Suman Gautam Matrimonial Profile');

        // 4. Admin verifies the profile
        $unverifiedUser->update([
            'is_verified' => true,
            'status' => 'active',
        ]);

        // 5. Now verified profile appears on /browse when searched by authenticated user
        \Livewire\Livewire::test(\App\Livewire\BrowseProfiles::class, ['gender' => 'male', 'searchQuery' => 'Suman Gautam'])
            ->assertSee('Suman Gautam');

        // 6. Profile page is now accessible for authenticated users
        $profileResponse = $this->get(route('profile.show', $unverifiedUser->id));
        $profileResponse->assertStatus(200);
        $profileResponse->assertSee('Suman Gautam');
    }

    public function test_payment_gateway_enable_disable_in_checkout(): void
    {
        $user = User::where('email', 'shahimahesh4@gmail.com')->first();
        $this->actingAs($user);
        $plan = \App\Models\SubscriptionPlan::where('is_active', true)->first();

        // 1. Enable eSewa and disable Khalti & Fonepay
        \App\Models\SiteSetting::set('esewa_enabled', '1', 'payment');
        \App\Models\SiteSetting::set('khalti_enabled', '0', 'payment');
        \App\Models\SiteSetting::set('fonepay_enabled', '0', 'payment');
        \App\Models\SiteSetting::set('connectips_enabled', '1', 'payment');

        \Livewire\Livewire::test(\App\Livewire\CheckoutPage::class, ['planId' => $plan->id])
            ->assertSee('eSewa Mobile Wallet')
            ->assertSee('ConnectIPS (NCHL Direct Debit)')
            ->assertDontSee('Khalti Digital Wallet')
            ->assertDontSee('Fonepay Merchant Dynamic QR');

        // 2. Now enable Khalti and disable eSewa
        \App\Models\SiteSetting::set('esewa_enabled', '0', 'payment');
        \App\Models\SiteSetting::set('khalti_enabled', '1', 'payment');

        \Livewire\Livewire::test(\App\Livewire\CheckoutPage::class, ['planId' => $plan->id])
            ->assertDontSee('eSewa Mobile Wallet')
            ->assertSee('Khalti Digital Wallet');

        // 3. Restore all enabled
        \App\Models\SiteSetting::set('esewa_enabled', '1', 'payment');
        \App\Models\SiteSetting::set('fonepay_enabled', '1', 'payment');
    }

    public function test_admin_site_settings_tabs_and_filtering(): void
    {
        $admin = User::where('email', 'shahimahesh4@gmail.com')->first();
        $this->actingAs($admin);

        // 1. Admin accesses /stnapanel/site-settings
        $response = $this->get('/stnapanel/site-settings');
        $response->assertStatus(200);
        $response->assertSee('Site Settings');
        $response->assertSee('Payment Gateways');
        $response->assertSee('General & Branding');
        $response->assertSee('Contact & Support');
        $response->assertSee('Social Media');
        $response->assertSee('Homepage & Stats');
        $response->assertSee('Footer & Legal');

        // 2. Test Livewire ListSiteSettings component with activeTab switching
        \Livewire\Livewire::test(\App\Filament\Resources\SiteSettings\Pages\ListSiteSettings::class)
            ->assertSet('activeTab', 'all')
            ->assertSee('Site Name')
            ->set('activeTab', 'payment')
            ->assertSee('esewa_enabled')
            ->set('activeTab', 'contact')
            ->assertSee('helpline_phone');
    }

    public function test_admin_can_edit_cms_pages_form(): void
    {
        $admin = User::where('email', 'shahimahesh4@gmail.com')->first();
        $this->actingAs($admin);

        $page = \App\Models\Page::first();
        $this->assertNotNull($page);

        // Edit page form renders cleanly without errors
        $response = $this->get('/stnapanel/pages/' . $page->id . '/edit');
        $response->assertStatus(200);
        $response->assertSee($page->title);
    }

    public function test_admin_can_view_and_save_manage_site_settings_page(): void
    {
        $admin = User::where('email', 'shahimahesh4@gmail.com')->first();
        $this->actingAs($admin);

        // 1. Visit /stnapanel/website-settings
        $response = $this->get('/stnapanel/website-settings');
        $response->assertStatus(200);
        $response->assertSee('Website Settings');
        $response->assertSee('General Configuration');
        $response->assertSee('Save Settings');

        // 2. Test Livewire component execution & saving
        \Livewire\Livewire::test(\App\Filament\Pages\ManageSiteSettings::class)
            ->set('data.site_name', 'MeroZodi Official Matrimony')
            ->set('data.helpline_phone', '+977-1-9999999')
            ->set('data.esewa_enabled', true)
            ->set('data.gemini_api_key', 'test_gemini_api_key_12345')
            ->call('save')
            ->assertHasNoErrors()
            ->assertNotified('Website Settings Saved Successfully');

        // 3. Verify changes persisted in database
        $this->assertEquals('MeroZodi Official Matrimony', \App\Models\SiteSetting::get('site_name'));
        $this->assertEquals('+977-1-9999999', \App\Models\SiteSetting::get('helpline_phone'));
        $this->assertEquals('test_gemini_api_key_12345', \App\Models\SiteSetting::get('gemini_api_key'));
    }

    public function test_role_and_permission_access_control(): void
    {
        // 1. Super Admin access
        $superAdmin = User::where('role', 'super_admin')->first();
        $this->assertTrue($superAdmin->isSuperAdmin());
        $this->assertTrue($superAdmin->isAdmin());
        $this->assertTrue($superAdmin->isStaff());
        $this->assertFalse($superAdmin->isUser());
        $this->assertTrue($superAdmin->hasPermission('manage_settings'));
        
        $this->flushSession();
        $this->actingAs($superAdmin);
        $this->get('/stnapanel')->assertStatus(200);
        $this->get('/stnapanel/website-settings')->assertStatus(200);

        // 2. Operations Admin access
        $admin = User::where('role', 'admin')->first();
        $this->assertFalse($admin->isSuperAdmin());
        $this->assertTrue($admin->isAdmin());
        $this->assertTrue($admin->isStaff());
        $this->assertTrue($admin->hasPermission('manage_users'));
        $this->assertTrue($admin->hasPermission('verify_kyc'));

        $this->flushSession();
        $this->actingAs($admin);
        $this->get('/stnapanel')->assertStatus(200);

        // 3. Staff / Moderator access
        $staff = User::where('role', 'staff')->first();
        $this->assertFalse($staff->isSuperAdmin());
        $this->assertFalse($staff->isAdmin());
        $this->assertTrue($staff->isStaff());
        $this->assertTrue($staff->hasPermission('verify_kyc'));
        $this->assertTrue($staff->hasPermission('manage_inquiries'));
        $this->assertFalse($staff->hasPermission('manage_payments'));

        $this->flushSession();
        $this->actingAs($staff);
        $this->get('/stnapanel')->assertStatus(200);

        // 4. Regular User access (forbidden from panel)
        $regularUser = User::where('role', 'user')->first();
        $this->assertTrue($regularUser->isUser());
        $this->assertFalse($regularUser->isAdmin());
        $this->assertFalse($regularUser->isStaff());
        $this->assertFalse($regularUser->hasPermission('view_admin_panel'));

        $this->flushSession();
        $this->actingAs($regularUser);
        $this->get('/stnapanel')->assertStatus(403);
    }

    public function test_auto_slug_generation_and_editability_in_pages_blogs_and_events(): void
    {
        // 1. Test Page model auto slug fallback
        $page = \App\Models\Page::create([
            'title' => 'Community Safety & Trust Guidelines',
            'content' => '<p>Safe matchmaking rules</p>',
            'is_published' => true,
        ]);
        $this->assertEquals('community-safety-trust-guidelines', $page->slug);

        // Edit slug to custom slug
        $page->update(['slug' => 'custom-safety-guide']);
        $this->assertEquals('custom-safety-guide', $page->fresh()->slug);

        // 2. Test Blog model auto slug fallback
        $blog = \App\Models\Blog::create([
            'title' => 'Top 10 Nepali Wedding Rituals Explained',
            'content' => 'Wedding ritual details',
            'is_published' => true,
        ]);
        $this->assertEquals('top-10-nepali-wedding-rituals-explained', $blog->slug);

        // Edit blog slug to custom slug
        $blog->update(['slug' => 'custom-wedding-rituals']);
        $this->assertEquals('custom-wedding-rituals', $blog->fresh()->slug);

        // 3. Test MatrimonyEvent model auto slug fallback
        $event = \App\Models\MatrimonyEvent::create([
            'title' => 'Kathmandu Youth Matrimony Mixer 2026',
            'event_datetime' => now()->addDays(10),
            'type' => 'physical',
        ]);
        $this->assertEquals('kathmandu-youth-matrimony-mixer-2026', $event->slug);

        // Edit event slug to custom slug
        $event->update(['slug' => 'custom-ktm-mixer-2026']);
        $this->assertEquals('custom-ktm-mixer-2026', $event->fresh()->slug);
    }

    public function test_email_templates_render_and_preview_routes(): void
    {
        $user = User::first();
        $this->assertNotNull($user);

        // 1. Test Welcome Email preview
        $response = $this->get('/email-preview/welcome');
        $response->assertStatus(200);
        $response->assertSee('Welcome to MeroZodi');
        $response->assertSee('Namaste');
        $response->assertSee('100% KYC Verified');
        $response->assertSee('Lazimpat, Kathmandu, Nepal');

        // 2. Test Notification Email preview
        $response = $this->get('/email-preview/notification');
        $response->assertStatus(200);
        $response->assertSee('Profile Highlight');
        $response->assertSee('Browse Suggested Matches');

        // 3. Test Payment Receipt Email preview
        $response = $this->get('/email-preview/payment');
        $response->assertStatus(200);
        $response->assertSee('Subscription Invoice');
        $response->assertSee('Transaction Breakdown');
        $response->assertSee('NPR');

        // 4. Test Match Interest Email preview
        $response = $this->get('/email-preview/match');
        $response->assertStatus(200);
        $response->assertSee('New Match Proposal');
        $response->assertSee('Someone Expressed Interest in You');
        $response->assertSee('View Profile');

        // 5. Test KYC Status Email preview
        $response = $this->get('/email-preview/kyc');
        $response->assertStatus(200);
        $response->assertSee('Your Profile is Now KYC Verified');
        $response->assertSee('Blue Tick Trust Badge Activated');

        $rejectResponse = $this->get('/email-preview/kyc-rejected');
        $rejectResponse->assertStatus(200);
        $rejectResponse->assertSee('Document Update Required');
    }
}




