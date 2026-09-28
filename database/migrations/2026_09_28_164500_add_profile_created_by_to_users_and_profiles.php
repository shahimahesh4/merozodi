<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'profile_created_by')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('profile_created_by')->nullable()->default('self')->after('marital_status');
            });
        }

        if (!Schema::hasColumn('user_profiles', 'profile_created_by')) {
            Schema::table('user_profiles', function (Blueprint $table) {
                $table->string('profile_created_by')->default('self')->after('marital_status');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'profile_created_by')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('profile_created_by');
            });
        }

        if (Schema::hasColumn('user_profiles', 'profile_created_by')) {
            Schema::table('user_profiles', function (Blueprint $table) {
                $table->dropColumn('profile_created_by');
            });
        }
    }
};
