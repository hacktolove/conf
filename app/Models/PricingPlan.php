<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $fillable = [
        'name', 'name_ar', 'price', 'currency', 'duration', 'duration_ar', 'description', 'description_ar',
        'features', 'features_ar', 'is_featured', 'is_active', 'button_text', 'button_text_ar',
        'button_link', 'order'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'features' => 'array',
        'features_ar' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get localized name
     */
    public function getLocalizedNameAttribute(): string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'name', '');
    }

    /**
     * Get localized description
     */
    public function getLocalizedDescriptionAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'description');
    }

    /**
     * Get localized duration
     */
    public function getLocalizedDurationAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'duration');
    }

    /**
     * Get localized button text
     */
    public function getLocalizedButtonTextAttribute(): string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'button_text', 'Buy Ticket');
    }

    /**
     * Get localized features
     */
    public function getLocalizedFeaturesAttribute(): ?array
    {
        $locale = \App\Helpers\LocaleHelper::getLocale();
        if ($locale === 'ar' && isset($this->features_ar) && !empty($this->features_ar)) {
            return is_array($this->features_ar) ? $this->features_ar : json_decode($this->features_ar, true);
        }
        return $this->features;
    }
}
