<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $guarded = ['id'];

    protected static ?array $runtimeCache = null;

    protected static function booted()
    {
        static::saved(function () {
            static::$runtimeCache = null;
            Cache::forget('global_site_settings');
        });

        static::deleted(function () {
            static::$runtimeCache = null;
            Cache::forget('global_site_settings');
        });
    }

    public static function get(string $key, $default = null)
    {
        $settings = static::allCached();
        return $settings[$key] ?? $default;
    }

    public static function allCached(): array
    {
        if (static::$runtimeCache !== null) {
            return static::$runtimeCache;
        }

        try {
            static::$runtimeCache = Cache::remember('global_site_settings', 86400, function () {
                return static::pluck('value', 'key')->toArray();
            });
            return static::$runtimeCache ?? [];
        } catch (\Throwable $e) {
            return [];
        }
    }

    public static function set(string $key, $value, string $group = 'general', ?string $label = null, string $type = 'text'): self
    {
        static::$runtimeCache = null;
        $setting = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'label' => $label ?? ucwords(str_replace('_', ' ', $key)),
                'type' => $type,
            ]
        );
        Cache::forget('global_site_settings');
        return $setting;
    }
}
