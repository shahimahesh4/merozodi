<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Users performance indexes
        Schema::table('users', function (Blueprint $table) {
            $table->index(['role', 'status', 'is_verified', 'gender'], 'users_browse_perf_idx');
            $table->index('last_active_at', 'users_last_active_perf_idx');
        });

        // 2. User Profiles filter indexes
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->index(['religion_id', 'caste_id'], 'profiles_rel_caste_perf_idx');
            $table->index('living_city', 'profiles_city_perf_idx');
            $table->index('manglik', 'profiles_manglik_perf_idx');
        });

        // 3. Messages indexing for ultra-fast chat polling & unread counters
        Schema::table('messages', function (Blueprint $table) {
            $table->index(['receiver_id', 'is_read'], 'messages_unread_perf_idx');
            $table->index(['sender_id', 'receiver_id', 'created_at'], 'messages_convo_perf_idx');
        });

        // 4. Connect requests & likes
        Schema::table('connect_requests', function (Blueprint $table) {
            $table->index(['receiver_id', 'status'], 'connect_receiver_status_perf_idx');
            $table->index(['sender_id', 'status'], 'connect_sender_status_perf_idx');
        });

        Schema::table('user_likes', function (Blueprint $table) {
            $table->index(['liker_id', 'liked_id'], 'user_likes_pair_perf_idx');
            $table->index('liked_id', 'user_likes_liked_perf_idx');
        });

        // 5. Profile views & activity
        Schema::table('profile_views', function (Blueprint $table) {
            $table->index(['viewed_id', 'last_viewed_at'], 'profile_views_viewed_perf_idx');
        });

        // 6. Blogs & Events
        Schema::table('blogs', function (Blueprint $table) {
            $table->index(['is_published', 'published_at'], 'blogs_published_perf_idx');
        });

        Schema::table('matrimony_events', function (Blueprint $table) {
            $table->index(['is_active', 'event_date'], 'events_active_perf_idx');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_browse_perf_idx');
            $table->dropIndex('users_last_active_perf_idx');
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropIndex('profiles_rel_caste_perf_idx');
            $table->dropIndex('profiles_city_perf_idx');
            $table->dropIndex('profiles_manglik_perf_idx');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropIndex('messages_unread_perf_idx');
            $table->dropIndex('messages_convo_perf_idx');
        });

        Schema::table('connect_requests', function (Blueprint $table) {
            $table->dropIndex('connect_receiver_status_perf_idx');
            $table->dropIndex('connect_sender_status_perf_idx');
        });

        Schema::table('user_likes', function (Blueprint $table) {
            $table->dropIndex('user_likes_pair_perf_idx');
            $table->dropIndex('user_likes_liked_perf_idx');
        });

        Schema::table('profile_views', function (Blueprint $table) {
            $table->dropIndex('profile_views_viewed_perf_idx');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropIndex('blogs_published_perf_idx');
        });

        Schema::table('matrimony_events', function (Blueprint $table) {
            $table->dropIndex('events_active_perf_idx');
        });
    }
};
