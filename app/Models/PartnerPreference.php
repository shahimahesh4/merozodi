<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartnerPreference extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'preferred_religions' => 'array',
        'preferred_castes' => 'array',
        'preferred_marital_statuses' => 'array',
        'preferred_countries' => 'array',
        'preferred_education_levels' => 'array',
        'preferred_occupations' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
