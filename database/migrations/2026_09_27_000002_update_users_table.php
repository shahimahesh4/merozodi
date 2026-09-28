<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->enum('gender', ['male', 'female', 'other'])->default('male')->after('phone');
            $table->date('dob')->nullable()->after('gender');
            $table->string('avatar')->nullable()->after('password');
            $table->string('cover_image')->nullable()->after('avatar');
            $table->enum('role', ['user', 'moderator', 'admin'])->default('user')->after('cover_image');
            $table->boolean('is_verified')->default(false)->after('role');
            $table->boolean('is_premium')->default(false)->after('is_verified');
            $table->enum('status', ['active', 'pending_approval', 'suspended', 'deactivated'])->default('active')->after('is_premium');
            $table->timestamp('last_active_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'gender', 'dob', 'avatar', 'cover_image',
                'role', 'is_verified', 'is_premium', 'status', 'last_active_at'
            ]);
        });
    }
};
