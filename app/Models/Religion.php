<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Religion extends Model
{
    protected $guarded = [];

    public function castes(): HasMany
    {
        return $this->hasMany(Caste::class);
    }
}
