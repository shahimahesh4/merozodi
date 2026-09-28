<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function religion(): BelongsTo
    {
        return $this->belongsTo(Religion::class);
    }

    public function caste(): BelongsTo
    {
        return $this->belongsTo(Caste::class);
    }

    public function getMaritalStatusLabelAttribute(): string
    {
        return match (strtolower($this->marital_status ?? 'unmarried')) {
            'never_married', 'unmarried' => 'Unmarried',
            'widow', 'widowed' => 'Widow',
            'divorced' => 'Divorced',
            'separated' => 'Separated',
            default => ucwords(str_replace('_', ' ', $this->marital_status ?? 'unmarried')),
        };
    }

    public function getProfileCreatedByLabelAttribute(): string
    {
        return match (strtolower($this->profile_created_by ?? 'self')) {
            'self' => 'Self',
            'parents', 'parent' => 'Parents',
            'sibling', 'brother', 'sister' => 'Sibling',
            'relative' => 'Relative',
            'friend' => 'Friend',
            default => ucwords(str_replace('_', ' ', $this->profile_created_by ?? 'self')),
        };
    }
}
