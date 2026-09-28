<?php

namespace App\Filament\Resources\Coupons\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CouponForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label('Promo / Coupon Code')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50)
                    ->extraInputAttributes(['style' => 'text-transform: uppercase; font-weight: bold;'])
                    ->helperText('e.g. DASHAIN2026, TIHAR500, NEWYEAR25'),
                TextInput::make('name')
                    ->label('Campaign / Promo Name')
                    ->required()
                    ->maxLength(255)
                    ->helperText('e.g. Dashain 20% Special Discount'),
                Select::make('discount_type')
                    ->options([
                        'percentage' => 'Percentage (%) Discount',
                        'fixed' => 'Fixed NPR Amount Discount',
                    ])
                    ->default('percentage')
                    ->required(),
                TextInput::make('discount_value')
                    ->label('Discount Amount / Percentage')
                    ->numeric()
                    ->required()
                    ->helperText('For percentage, enter 20 for 20%. For fixed, enter 500 for NPR 500.'),
                TextInput::make('min_order_amount')
                    ->label('Minimum Order Subtotal (NPR)')
                    ->numeric()
                    ->default(0)
                    ->prefix('NPR'),
                TextInput::make('max_uses')
                    ->label('Max Redemptions Allowed (Leave blank for unlimited)')
                    ->numeric()
                    ->nullable(),
                TextInput::make('times_used')
                    ->label('Times Redeemed')
                    ->numeric()
                    ->default(0)
                    ->disabled(),
                DateTimePicker::make('expires_at')
                    ->label('Expiration Date & Time (Optional)')
                    ->nullable(),
                Toggle::make('is_active')
                    ->label('Is Coupon Active')
                    ->default(true),
            ]);
    }
}
