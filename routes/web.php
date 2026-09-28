<?php

use App\Http\Controllers\PaymentGatewayController;
use App\Livewire\AboutUs;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\RegisterWizard;
use App\Livewire\BlogDetail;
use App\Livewire\BlogPage;
use App\Livewire\BrowseProfiles;
use App\Livewire\ChatInbox;
use App\Livewire\CheckoutPage;
use App\Livewire\ContactUs;
use App\Livewire\Dashboard;
use App\Livewire\DynamicPage;
use App\Livewire\EventsPage;
use App\Livewire\HomePage;
use App\Livewire\InvoiceReceipt;
use App\Livewire\MyActivity;
use App\Livewire\MyGallery;
use App\Livewire\MyKyc;
use App\Livewire\MyProfile;
use App\Livewire\PricingPage;
use App\Livewire\PrivacyPolicy;
use App\Livewire\ProfileDetail;
use App\Livewire\TermsConditions;
use App\Livewire\VideoCallRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', HomePage::class)->name('home');
Route::get('/browse', BrowseProfiles::class)->name('browse');
Route::get('/profile/{id}', ProfileDetail::class)->name('profile.show');
Route::get('/pricing', PricingPage::class)->name('pricing');
Route::get('/events', EventsPage::class)->name('events');
Route::get('/blog', BlogPage::class)->name('blog');
Route::get('/blog/{slug}', BlogDetail::class)->name('blog.detail');

// Dynamic CMS Legal & Information Pages (Backend Controlled)
Route::get('/about-us', AboutUs::class)->name('about');
Route::get('/about', AboutUs::class);
Route::get('/contact-us', ContactUs::class)->name('contact');
Route::get('/contact', ContactUs::class);
Route::get('/privacy-policy', PrivacyPolicy::class)->name('privacy');
Route::get('/privacy', PrivacyPolicy::class);
Route::get('/terms-and-conditions', TermsConditions::class)->name('terms');
Route::get('/terms', TermsConditions::class);
Route::get('/p/{slug}', DynamicPage::class)->name('page.show');

/*
|--------------------------------------------------------------------------
| Guest Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', RegisterWizard::class)->name('register');
    Route::get('/login', Login::class)->name('login');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Session Termination
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('home');
    })->name('logout');

    // User Dashboard & Management
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/my-profile', MyProfile::class)->name('my-profile');
    Route::get('/my-gallery', MyGallery::class)->name('my-gallery');
    Route::get('/my-kyc', MyKyc::class)->name('my-kyc');
    Route::get('/my-activity', MyActivity::class)->name('my-activity');

    // Dot-notation aliases for convenience
    Route::get('/my-profile-alias', MyProfile::class)->name('my.profile');
    Route::get('/my-gallery-alias', MyGallery::class)->name('my.gallery');
    Route::get('/my-kyc-alias', MyKyc::class)->name('my.kyc');
    Route::get('/my-activity-alias', MyActivity::class)->name('my.activity');

    // Real-Time Chat & Video Dating
    Route::get('/messages/{selectedUserId?}', ChatInbox::class)->name('messages');
    Route::get('/video-call/{room}', VideoCallRoom::class)->name('video.room');
    Route::get('/video-call-room/{room}', VideoCallRoom::class)->name('video-call.room');

    // Checkout & Invoices
    Route::get('/checkout/{planId}', CheckoutPage::class)->name('checkout');
    Route::get('/invoices/{paymentId}', InvoiceReceipt::class)->name('invoice.show');

    // Nepali Payment Gateways Flow
    Route::prefix('payment')->name('payment.')->group(function () {
        // eSewa ePay v2
        Route::get('/esewa/initiate/{paymentId}', [PaymentGatewayController::class, 'initiateEsewa'])->name('esewa.initiate');
        Route::get('/esewa/success', [PaymentGatewayController::class, 'esewaSuccess'])->name('esewa.success');
        Route::get('/esewa/failure', [PaymentGatewayController::class, 'esewaFailure'])->name('esewa.failure');

        // Khalti EPayment v2
        Route::get('/khalti/initiate/{paymentId}', [PaymentGatewayController::class, 'initiateKhalti'])->name('khalti.initiate');
        Route::post('/khalti/callback/{paymentId}', [PaymentGatewayController::class, 'khaltiCallback'])->name('khalti.callback');

        // Fonepay Dynamic QR
        Route::get('/fonepay/initiate/{paymentId}', [PaymentGatewayController::class, 'initiateFonepay'])->name('fonepay.initiate');
        Route::post('/fonepay/callback/{paymentId}', [PaymentGatewayController::class, 'fonepayCallback'])->name('fonepay.callback');

        // ConnectIPS NCHL
        Route::get('/connectips/initiate/{paymentId}', [PaymentGatewayController::class, 'initiateConnectips'])->name('connectips.initiate');
        Route::post('/connectips/callback/{paymentId}', [PaymentGatewayController::class, 'connectipsCallback'])->name('connectips.callback');
    });
});
