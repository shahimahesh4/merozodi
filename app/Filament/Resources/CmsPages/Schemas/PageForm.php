<?php

namespace App\Filament\Resources\CmsPages\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Page Information')
                    ->description('General title, URL slug, and subtitle')
                    ->schema([
                        TextInput::make('title')
                            ->label('Page Title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('e.g. contact-us, about-us, privacy-policy, terms-and-conditions'),
                        TextInput::make('subtitle')
                            ->label('Subtitle / Tagline')
                            ->maxLength(500)
                            ->columnSpanFull(),
                        TextInput::make('banner_image')
                            ->label('Header Banner Image URL')
                            ->url()
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Page Content & Body')
                    ->description('Rich HTML content body of the page')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Full Body Content')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Contact & Helpdesk Settings (For Contact Us Page)')
                    ->description('Customize phone, email, WhatsApp, office hours, dynamic map, and interactive FAQs')
                    ->schema([
                        TextInput::make('contact_phone')
                            ->label('Helpline Number')
                            ->placeholder('+977-1-4567890'),
                        TextInput::make('contact_email')
                            ->label('Support Email')
                            ->email()
                            ->placeholder('support@merozodi.com'),
                        TextInput::make('extra_data.whatsapp_number')
                            ->label('WhatsApp Support Desk')
                            ->placeholder('+977-9801234567'),
                        TextInput::make('extra_data.hero_badge')
                            ->label('Hero Top Badge Text')
                            ->placeholder('Dedicated Nepali Matrimonial Helpdesk'),
                        TextInput::make('contact_address')
                            ->label('Physical Office Address')
                            ->placeholder('Lazimpat, Kathmandu, Nepal')
                            ->columnSpanFull(),
                        TextInput::make('extra_data.visiting_hours_weekdays')
                            ->label('Weekday Visiting Hours')
                            ->placeholder('Sunday – Friday: 9:00 AM – 6:00 PM NPT'),
                        TextInput::make('extra_data.visiting_hours_weekend')
                            ->label('Weekend / Holiday Hours')
                            ->placeholder('Saturday & Holidays: 24/7 WhatsApp Desk'),
                        TextInput::make('extra_data.map_embed_url')
                            ->label('Interactive Map Embed URL (OpenStreetMap / Google Maps iframe URL)')
                            ->placeholder('https://www.openstreetmap.org/export/embed.html?bbox=...')
                            ->columnSpanFull(),
                        TextInput::make('extra_data.map_directions_url')
                            ->label('Map Directions Link (Google Maps URL)')
                            ->placeholder('https://maps.google.com/?q=Lazimpat,+Kathmandu,+Nepal')
                            ->columnSpanFull(),
                        Repeater::make('extra_data.faqs')
                            ->label('Frequently Asked Questions (FAQs)')
                            ->schema([
                                TextInput::make('question')
                                    ->label('Question')
                                    ->required(),
                                Textarea::make('answer')
                                    ->label('Answer')
                                    ->rows(2)
                                    ->required(),
                            ])
                            ->columnSpanFull()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['question'] ?? null),
                    ])->columns(2)->collapsed(),

                Section::make('SEO & Publishing')
                    ->description('Search engine metadata and live publication toggle')
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('SEO Meta Title')
                            ->maxLength(255),
                        Textarea::make('meta_description')
                            ->label('SEO Meta Description')
                            ->rows(2)
                            ->maxLength(500),
                        Toggle::make('is_published')
                            ->label('Publish Live')
                            ->default(true),
                    ])->columns(1),
            ]);
    }
}
