<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MatrimonyEvent extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'event_datetime' => 'datetime',
        'is_active' => 'boolean',
        'entry_fee_npr' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::saving(function (MatrimonyEvent $event) {
            if (empty($event->slug) && !empty($event->title)) {
                $event->slug = \Illuminate\Support\Str::slug($event->title);
            }
        });
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(EventFaq::class)->orderBy('sort_order');
    }

    public function getBannerImageAttribute($value): string
    {
        if (!$value) {
            return asset('images/nepali-wedding-banner.png');
        }

        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        return asset(ltrim($value, '/'));
    }
}
