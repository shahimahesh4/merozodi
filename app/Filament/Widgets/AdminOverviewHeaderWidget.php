<?php

namespace App\Filament\Widgets;

use App\Models\Blog;
use App\Models\MatrimonyEvent;
use App\Models\User;
use App\Models\UserVerification;
use Filament\Widgets\Widget;

class AdminOverviewHeaderWidget extends Widget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected string $view = 'filament.widgets.admin-overview-header';

    public function getViewData(): array
    {
        return [
            'totalUsers' => User::count(),
            'onlineUsers' => User::where('last_active_at', '>=', now()->subMinutes(5))->count(),
            'pendingKyc' => UserVerification::where('status', 'pending')->count(),
            'upcomingEvents' => MatrimonyEvent::where('status', 'upcoming')->orWhere('status', 'published')->count(),
            'publishedBlogs' => Blog::where('is_published', true)->count(),
            'adminUser' => auth()->user(),
        ];
    }
}
