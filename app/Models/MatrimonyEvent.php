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

    public function faqs(): HasMany
    {
        return $this->hasMany(EventFaq::class)->orderBy('sort_order');
    }
}
