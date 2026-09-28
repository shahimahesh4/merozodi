<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'marital_status')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('marital_status')->nullable()->default('unmarried')->after('gender');
            });
        }

        if (!Schema::hasColumn('user_profiles', 'marital_status')) {
            Schema::table('user_profiles', function (Blueprint $table) {
                $table->string('marital_status')->default('unmarried')->after('mother_tongue');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'marital_status')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('marital_status');
            });
        }
    }
};
