<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted(): void
    {
        static::saving(function (Page $page) {
            if (empty($page->slug) && !empty($page->title)) {
                $page->slug = \Illuminate\Support\Str::slug($page->title);
            }
        });
    }

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'extra_data' => 'array',
        ];
    }
}
