<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Photo Privacy Shield Requests
        Schema::create('photo_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('target_user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
            $table->text('message')->nullable();
            $table->timestamps();

            $table->unique(['requester_id', 'target_user_id']);
        });

        // 2. Scheduled Virtual Video Dating Appointments
        Schema::create('video_date_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('receiver_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('scheduled_at');
            $table->enum('status', ['pending', 'accepted', 'declined', 'completed', 'cancelled'])->default('pending');
            $table->string('room_id')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });

        // 3. Discount Coupons & Promo Codes Engine
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->enum('discount_type', ['percentage', 'fixed'])->default('percentage');
            $table->decimal('discount_value', 10, 2); // e.g. 20 for 20% or 500 for NPR 500
            $table->decimal('min_order_amount', 10, 2)->default(0);
            $table->integer('max_uses')->nullable();
            $table->integer('times_used')->default(0);
            $table->dateTime('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 4. Global Dynamic Site Settings (Branding, Support, Social, Payment toggles)
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->string('label')->nullable();
            $table->string('type')->default('text'); // text, textarea, boolean, number, image
            $table->timestamps();
        });

        // 5. Update user_profiles with photo privacy and astrological fields
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->boolean('is_photo_blurred')->default(false)->after('profile_visibility');
            $table->string('nadi')->nullable()->after('gotra'); // Adi, Madhya, Antya
            $table->string('gana')->nullable()->after('nadi'); // Deva, Manushya, Rakshasa
            $table->string('birth_time')->nullable()->after('gana');
            $table->string('birth_place')->nullable()->after('birth_time');
        });

        // 6. Update payments table with discount coupon tracking
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('coupon_id')->nullable()->after('subscription_id')->constrained('coupons')->nullOnDelete();
            $table->decimal('discount_amount', 10, 2)->default(0)->after('amount');
        });

        // 7. Update messages table for voice duration
        Schema::table('messages', function (Blueprint $table) {
            $table->integer('audio_duration')->nullable()->after('attachment_size'); // In seconds
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('audio_duration');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['coupon_id']);
            $table->dropColumn(['coupon_id', 'discount_amount']);
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn(['is_photo_blurred', 'nadi', 'gana', 'birth_time', 'birth_place']);
        });

        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('coupons');
        Schema::dropIfExists('video_date_appointments');
        Schema::dropIfExists('photo_requests');
    }
};
