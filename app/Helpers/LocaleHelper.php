<?php

namespace App\Helpers;

class LocaleHelper
{
    /**
     * Get the current locale
     */
    public static function getLocale(): string
    {
        return app()->getLocale();
    }

    /**
     * Check if current locale is Arabic
     */
    public static function isArabic(): bool
    {
        return self::getLocale() === 'ar';
    }

    /**
     * Get localized field value from model
     * Returns Arabic version if locale is 'ar' and field exists, otherwise returns English
     */
    public static function getLocalized($model, string $field): ?string
    {
        $locale = self::getLocale();
        
        if ($locale === 'ar') {
            $arField = $field . '_ar';
            if (isset($model->$arField) && !empty($model->$arField)) {
                return $model->$arField;
            }
        }
        
        // Fallback to English or return null
        return $model->$field ?? null;
    }

    /**
     * Get localized field value with fallback
     * Tries Arabic first, then English, then returns default
     */
    public static function getLocalizedWithFallback($model, string $field, ?string $default = null): ?string
    {
        $locale = self::getLocale();
        
        if ($locale === 'ar') {
            $arField = $field . '_ar';
            if (isset($model->$arField) && !empty($model->$arField)) {
                return $model->$arField;
            }
        }
        
        // Fallback to English
        if (isset($model->$field) && !empty($model->$field)) {
            return $model->$field;
        }
        
        return $default;
    }

    /**
     * Set locale
     */
    public static function setLocale(string $locale): void
    {
        app()->setLocale($locale);
        session(['locale' => $locale]);
    }
}

