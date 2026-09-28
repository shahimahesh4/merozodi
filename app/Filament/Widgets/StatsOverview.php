<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use App\Models\User;
use App\Models\UserReport;
use App\Models\UserVerification;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        // 1. Total Registered Members
        $totalUsers = User::count();
        $recentUsers = User::where('created_at', '>=', now()->subDays(7))->count();

        // 2. Verified Profiles
        $verifiedProfiles = UserVerification::where('status', 'approved')->count();
        $pendingKyc = UserVerification::where('status', 'pending')->count();

        // 3. Revenue
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');
        $recentTransactions = Payment::where('status', 'completed')->where('created_at', '>=', now()->subDays(30))->count();

        // 4. Pending Reports
        $pendingReports = UserReport::where('status', 'pending')->count();

        return [
            Stat::make('Total Members', number_format($totalUsers))
                ->description($recentUsers . ' new profiles this week')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->chart([3, 5, 8, 12, 10, 15, 18, max(5, $totalUsers)])
                ->url(url('/admin/users')),

            Stat::make('Verified Matchseekers', number_format($verifiedProfiles))
                ->description($pendingKyc . ' KYC verifications pending')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color($pendingKyc > 0 ? 'warning' : 'success')
                ->chart([2, 4, 6, 8, 9, 12, 14, max(2, $verifiedProfiles)])
                ->url(url('/admin/user-verifications')),

            Stat::make('Total Monetization', 'NPR ' . number_format($totalRevenue, 2))
                ->description($recentTransactions . ' completed transactions')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success')
                ->chart([500, 1200, 2400, 3500, 5000, 6800, max(1000, (int) $totalRevenue)])
                ->url(url('/admin/payments')),

            Stat::make('Trust & Moderation', number_format($pendingReports))
                ->description($pendingReports > 0 ? 'Urgent reports pending review' : 'Zero safety escalations')
                ->descriptionIcon($pendingReports > 0 ? 'heroicon-m-exclamation-triangle' : 'heroicon-m-check-circle')
                ->color($pendingReports > 0 ? 'danger' : 'success')
                ->chart([$pendingReports, 1, 0, 2, 1, 0, $pendingReports])
                ->url(url('/admin/user-reports')),
        ];
    }
}
