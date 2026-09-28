<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Personal & Astrological Profile
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('religion_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('caste_id')->nullable()->constrained()->nullOnDelete();
            $table->string('sub_caste')->nullable();
            $table->string('mother_tongue')->default('Nepali');
            $table->string('marital_status')->default('unmarried');
            $table->string('profile_created_by')->default('self');
            $table->string('rashi')->nullable(); // Mesha, Vrishabha, Mithuna, etc.
            $table->string('gotra')->nullable();
            $table->enum('manglik', ['yes', 'no', 'dont_know'])->default('dont_know');
            $table->string('citizenship_country')->default('Nepal');
            $table->string('living_country')->default('Nepal');
            $table->string('living_state')->nullable();
            $table->string('living_city')->nullable();
            $table->string('permanent_address')->nullable();
            $table->enum('residency_status', ['citizen', 'permanent_resident', 'work_permit', 'student_visa', 'temporary'])->default('citizen');
            $table->text('about_me')->nullable();
            $table->text('about_partner')->nullable();
            $table->enum('profile_visibility', ['public', 'members_only', 'verified_only', 'hidden'])->default('public');
            $table->boolean('show_contact_to_premium')->default(true);
            $table->timestamps();
        });

        // 2. Physical & Lifestyle Attributes
        Schema::create('physical_lifestyles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('height_cm')->nullable(); // e.g. 175 cm
            $table->integer('weight_kg')->nullable();
            $table->enum('body_type', ['slim', 'athletic', 'average', 'heavy'])->default('average');
            $table->enum('complexion', ['very_fair', 'fair', 'wheatish', 'dark'])->default('fair');
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable();
            $table->enum('diet', ['vegetarian', 'non_vegetarian', 'eggetarian', 'vegan'])->default('non_vegetarian');
            $table->enum('smoke_habit', ['no', 'occasionally', 'regularly'])->default('no');
            $table->enum('drink_habit', ['no', 'occasionally', 'regularly'])->default('no');
            $table->timestamps();
        });

        // 3. Education & Profession
        Schema::create('education_professions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('education_level_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('education_field_id')->nullable()->constrained()->nullOnDelete();
            $table->string('college_name')->nullable();
            $table->foreignId('occupation_id')->nullable()->constrained()->nullOnDelete();
            $table->string('designation')->nullable();
            $table->string('company_name')->nullable();
            $table->enum('employment_sector', ['private', 'government', 'business', 'self_employed', 'ngo_ingo', 'not_working'])->default('private');
            $table->string('annual_income_currency')->default('NPR');
            $table->string('annual_income_range')->nullable(); // e.g. "5 Lakh - 10 Lakh"
            $table->timestamps();
        });

        // 4. Family Details
        Schema::create('family_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('father_name')->nullable();
            $table->string('father_profession')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_profession')->nullable();
            $table->integer('brothers_count')->default(0);
            $table->integer('married_brothers_count')->default(0);
            $table->integer('sisters_count')->default(0);
            $table->integer('married_sisters_count')->default(0);
            $table->enum('family_type', ['nuclear', 'joint'])->default('nuclear');
            $table->enum('family_values', ['traditional', 'moderate', 'liberal'])->default('moderate');
            $table->enum('family_status', ['middle_class', 'upper_middle_class', 'affluent'])->default('middle_class');
            $table->text('family_location')->nullable();
            $table->timestamps();
        });

        // 5. Partner Preferences
        Schema::create('partner_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('min_age')->default(18);
            $table->integer('max_age')->default(50);
            $table->integer('min_height_cm')->nullable();
            $table->integer('max_height_cm')->nullable();
            $table->json('preferred_religions')->nullable(); // [1, 2]
            $table->json('preferred_castes')->nullable();     // [1, 5, 12]
            $table->json('preferred_marital_statuses')->nullable();
            $table->json('preferred_countries')->nullable();
            $table->json('preferred_education_levels')->nullable();
            $table->json('preferred_occupations')->nullable();
            $table->enum('preferred_manglik', ['yes', 'no', 'any'])->default('any');
            $table->enum('preferred_diet', ['vegetarian', 'non_vegetarian', 'any'])->default('any');
            $table->timestamps();
        });

        // 6. Photo Gallery
        Schema::create('user_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->boolean('is_profile')->default(false);
            $table->boolean('is_cover')->default(false);
            $table->boolean('is_private')->default(false);
            $table->boolean('is_approved')->default(true);
            $table->timestamps();
        });

        // 7. Identity & KYC Verifications
        Schema::create('user_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('document_type', ['citizenship', 'passport', 'national_id', 'driving_license']);
            $table->string('document_number');
            $table->string('front_image_path');
            $table->string('back_image_path')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_verifications');
        Schema::dropIfExists('user_galleries');
        Schema::dropIfExists('partner_preferences');
        Schema::dropIfExists('family_details');
        Schema::dropIfExists('education_professions');
        Schema::dropIfExists('physical_lifestyles');
        Schema::dropIfExists('user_profiles');
    }
};
