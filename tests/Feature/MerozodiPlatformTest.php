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
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('MeroZodi');
    }

    public function test_browse_profiles_loads_with_seeded_data(): void
    {
        $response = $this->get('/browse');
        $response->assertStatus(200);
        $response->assertSee('Aayush Sharma');
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
        $user = User::where('email', 'admin@merozodi.com')->first();
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
        $user1 = User::where('email', 'admin@merozodi.com')->first();
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
        $user = User::where('email', 'admin@merozodi.com')->first();
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
        $admin = User::where('email', 'admin@merozodi.com')->first();
        $this->actingAs($admin);

        $response = $this->get('/admin');
        $response->assertStatus(200);

        // Filament CMS Pages Resource
        $response = $this->get('/admin/pages');
        $response->assertStatus(200);

        // Filament Contact Inquiries Resource
        $response = $this->get('/admin/contact-inquiries');
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
        $user1 = User::where('email', 'admin@merozodi.com')->first();
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
        $user1 = User::where('email', 'admin@merozodi.com')->first();
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
        $user = User::where('email', 'admin@merozodi.com')->first();
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
        ]);

        $this->assertDatabaseHas('user_profiles', [
            'profile_created_by' => 'parents',
            'marital_status' => 'unmarried',
        ]);

        $user = User::where('email', 'bikash.thapa@example.com')->first();
        $this->assertEquals('Parents', $user->profile_created_by_label);
        $this->assertStringStartsWith('MZ', $user->matrimony_id);

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
}
