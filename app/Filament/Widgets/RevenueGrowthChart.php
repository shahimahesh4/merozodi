<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RevenueGrowthChart extends ChartWidget
{
    protected static ?int $sort = 4;

    protected ?string $heading = 'Revenue & Subscription Growth (NPR)';

    protected ?string $description = 'Monthly paid subscription payments collected via eSewa, Khalti, & Cards.';

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

        $revenue = $months->map(function (Carbon $date) {
            return (float) Payment::where('status', 'completed')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('amount');
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Revenue (NPR)',
                    'data' => $revenue,
                    'backgroundColor' => [
                        'rgba(5, 150, 105, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(14, 165, 233, 0.7)',
                        'rgba(124, 58, 237, 0.7)',
                        'rgba(244, 63, 94, 0.7)',
                        'rgba(225, 29, 72, 0.85)',
                    ],
                    'borderRadius' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
