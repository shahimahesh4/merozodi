<?php

namespace App\Filament\Resources\CmsPages\Tables;

use App\Models\Page;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Page Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (Page $record): string => '/' . ($record->slug === 'about-us' ? 'about-us' : ($record->slug === 'contact-us' ? 'contact-us' : ($record->slug === 'privacy-policy' ? 'privacy-policy' : ($record->slug === 'terms-and-conditions' ? 'terms-and-conditions' : 'p/' . $record->slug))))),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->badge()
                    ->color('gray')
                    ->searchable(),

                IconColumn::make('is_published')
                    ->boolean()
                    ->label('Published'),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('is_published')
                    ->label('Publication Status')
                    ->options([
                        '1' => 'Published',
                        '0' => 'Draft',
                    ]),
            ])
            ->recordActions([
                Action::make('view_live')
                    ->label('View Live')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->color('info')
                    ->url(fn (Page $record): string => match ($record->slug) {
                        'about-us' => url('/about-us'),
                        'contact-us' => url('/contact-us'),
                        'privacy-policy' => url('/privacy-policy'),
                        'terms-and-conditions' => url('/terms-and-conditions'),
                        default => url('/p/' . $record->slug),
                    })
                    ->openUrlInNewTab(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
