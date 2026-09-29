<?php

namespace App\Filament\Resources\SiteSettings\Pages;

use App\Filament\Resources\SiteSettings\SiteSettingResource;
use App\Models\SiteSetting;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListSiteSettings extends ListRecords
{
    protected static string $resource = SiteSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Settings')
                ->icon('heroicon-m-squares-2x2')
                ->badge(fn () => SiteSetting::count()),

            'general' => Tab::make('General & Branding')
                ->icon('heroicon-m-globe-alt')
                ->badge(fn () => SiteSetting::where('group', 'general')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('group', 'general')),

            'payment' => Tab::make('Payment Gateways')
                ->icon('heroicon-m-credit-card')
                ->badge(fn () => SiteSetting::where('group', 'payment')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('group', 'payment')),

            'contact' => Tab::make('Contact & Support')
                ->icon('heroicon-m-phone')
                ->badge(fn () => SiteSetting::where('group', 'contact')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('group', 'contact')),

            'social' => Tab::make('Social Media')
                ->icon('heroicon-m-share')
                ->badge(fn () => SiteSetting::where('group', 'social')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('group', 'social')),

            'homepage' => Tab::make('Homepage & Stats')
                ->icon('heroicon-m-home')
                ->badge(fn () => SiteSetting::whereIn('group', ['homepage', 'homepage_stats'])->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->whereIn('group', ['homepage', 'homepage_stats'])),

            'footer' => Tab::make('Footer & Legal')
                ->icon('heroicon-m-document-text')
                ->badge(fn () => SiteSetting::where('group', 'footer')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('group', 'footer')),
        ];
    }
}
