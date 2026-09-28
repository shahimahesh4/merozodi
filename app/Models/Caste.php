<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Caste extends Model
{
    protected $guarded = [];

    public function religion(): BelongsTo
    {
        return $this->belongsTo(Religion::class);
    }
}
