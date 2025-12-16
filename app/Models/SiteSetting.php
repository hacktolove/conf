<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'value_ar', 'type', 'group'];

    public static function get($key, $default = null)
    {
        $setting = Cache::rememberForever('setting_' . $key, function () use ($key) {
            return self::where('key', $key)->first();
        });

        return $setting ? $setting->value : $default;
    }
    
    public static function getLocalized($key, $default = null)
    {
        $setting = Cache::rememberForever('setting_' . $key, function () use ($key) {
            return self::where('key', $key)->first();
        });

        if (!$setting) {
            return $default;
        }

        $locale = app()->getLocale();
        if ($locale === 'ar' && $setting->value_ar) {
            return $setting->value_ar;
        }

        return $setting->value ?: $default;
    }

    public static function set($key, $value, $type = 'text', $group = 'general', $valueAr = null)
    {
        $data = ['value' => $value, 'type' => $type, 'group' => $group];
        if ($valueAr !== null) {
            $data['value_ar'] = $valueAr;
        }
        
        $setting = self::updateOrCreate(
            ['key' => $key],
            $data
        );

        Cache::forget('setting_' . $key);

        return $setting;
    }
    
    public static function clearCache()
    {
        // Clear all setting caches
        $settings = self::pluck('key');
        foreach ($settings as $key) {
            Cache::forget('setting_' . $key);
        }
    }

    public static function getGroup($group)
    {
        return self::where('group', $group)->pluck('value', 'key')->toArray();
    }
}
