<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Matrimonial Events
        Schema::create('matrimony_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('banner_image')->nullable();
            $table->enum('type', ['physical', 'virtual_meet'])->default('physical');
            $table->dateTime('event_datetime');
            $table->string('location_venue')->nullable();
            $table->decimal('entry_fee_npr', 8, 2)->default(0.00);
            $table->integer('max_participants')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Event FAQs
        Schema::create('event_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matrimony_event_id')->constrained()->cascadeOnDelete();
            $table->string('question');
            $table->text('answer');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 3. Matrimonial Blogs & Articles
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // 4. Advertisements (Sidebars & in-feed promos)
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_path');
            $table->string('target_url');
            $table->enum('placement', ['sidebar', 'header', 'footer', 'in_feed'])->default('sidebar');
            $table->date('starts_at');
            $table->date('expires_at');
            $table->integer('click_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 5. Banners & Homepage Sliders
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_path');
            $table->string('link_url')->nullable();
            $table->string('subtitle')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
        Schema::dropIfExists('advertisements');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('event_faqs');
        Schema::dropIfExists('matrimony_events');
    }
};
