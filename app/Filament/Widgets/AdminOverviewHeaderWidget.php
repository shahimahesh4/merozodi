<?php

namespace App\Filament\Widgets;

use App\Models\Blog;
use App\Models\ContactInquiry;
use App\Models\Coupon;
use App\Models\MatrimonyEvent;
use App\Models\Payment;
use App\Models\SiteSetting;
use App\Models\User;
use App\Models\UserReport;
use App\Models\UserVerification;
use Filament\Widgets\Widget;

class AdminOverviewHeaderWidget extends Widget
{
    protected int | string | array $columnSpan = [
        'default' => 'full',
        'sm' => 'full',
        'md' => 'full',
        'lg' => 'full',
        'xl' => 'full',
        '2xl' => 'full',
    ];

    protected string $view = 'filament.widgets.admin-overview-header';

    public function getViewData(): array
    {
        return [
            'totalUsers' => User::count(),
            'onlineUsers' => User::where('last_active_at', '>=', now()->subMinutes(5))->count(),
            'pendingKyc' => UserVerification::where('status', 'pending')->count(),
            'pendingInquiries' => ContactInquiry::where('status', 'new')->orWhere('is_read', false)->count(),
            'upcomingEvents' => MatrimonyEvent::where('event_datetime', '>=', now())->count(),
            'publishedBlogs' => Blog::where('is_published', true)->count(),
            'activeCoupons' => Coupon::where('is_active', true)->count(),
            'pendingReports' => UserReport::where('status', 'pending')->count(),
            'totalRevenue' => Payment::where('status', 'completed')->sum('amount'),
            'adminUser' => auth()->user(),
        ];
    }
}
