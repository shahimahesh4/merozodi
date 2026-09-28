<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Subscription Plans (Free, Standard, Premium)
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('duration_months')->default(1);
            $table->decimal('price_npr', 10, 2);
            $table->decimal('price_usd', 8, 2)->nullable();
            $table->json('features_json')->nullable();
            $table->boolean('allows_video_calling')->default(false);
            $table->boolean('allows_direct_messaging')->default(false);
            $table->boolean('allows_contact_view')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Active User Subscriptions
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subscription_plan_id')->constrained()->cascadeOnDelete();
            $table->timestamp('starts_at')->useCurrent();
            $table->timestamp('ends_at');
            $table->boolean('is_active')->default(true);
            $table->boolean('auto_renew')->default(false);
            $table->timestamps();
        });

        // 3. Payment Transactions (eSewa, Khalti, ConnectIPS, Fonepay)
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subscription_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('gateway', ['esewa', 'khalti', 'fonepay', 'connectips', 'stripe', 'manual']);
            $table->string('transaction_id')->unique();
            $table->string('gateway_reference')->nullable();
            $table->decimal('amount', 10, 2);
            $table->decimal('tax_amount', 10, 2)->default(0.00); // 13% VAT
            $table->decimal('total_amount', 10, 2);
            $table->string('currency', 3)->default('NPR');
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->json('raw_response')->nullable();
            $table->timestamps();
        });

        // 4. Standalone Profile Boosts
        Schema::create('profile_boosts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamp('boosted_at')->useCurrent();
            $table->timestamp('expires_at');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_boosts');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('subscription_plans');
    }
};
