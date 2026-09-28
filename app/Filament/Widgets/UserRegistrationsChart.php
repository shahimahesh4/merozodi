<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\UserVerification;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class UserRegistrationsChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected ?string $heading = 'Member Registrations & KYC Trends';

    protected ?string $description = 'Monthly overview of registered profiles and verified members.';

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $months = collect(range(5, 0))->map(function ($monthsAgo) {
            return Carbon::now()->subMonths($monthsAgo);
        });

        $labels = $months->map(fn (Carbon $date) => $date->format('M Y'))->toArray();

        $registrations = $months->map(function (Carbon $date) {
            return User::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        })->toArray();

        $verifications = $months->map(function (Carbon $date) {
            return UserVerification::where('status', 'approved')
                ->whereYear('updated_at', $date->year)
                ->whereMonth('updated_at', $date->month)
                ->count();
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'New Registrations',
                    'data' => $registrations,
                    'borderColor' => '#e11d48',
                    'backgroundColor' => 'rgba(225, 29, 72, 0.15)',
                    'fill' => true,
                    'tension' => 0.35,
                ],
                [
                    'label' => 'Verified Profiles',
                    'data' => $verifications,
                    'borderColor' => '#7c3aed',
                    'backgroundColor' => 'rgba(124, 58, 237, 0.1)',
                    'fill' => true,
                    'tension' => 0.35,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
