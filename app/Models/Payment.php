<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'raw_response' => 'array',
        'amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    public function getPaymentGatewayAttribute(): ?string
    {
        return $this->attributes['gateway'] ?? $this->attributes['payment_gateway'] ?? null;
    }

    public function setPaymentGatewayAttribute($value): void
    {
        $this->attributes['gateway'] = $value;
    }
}
