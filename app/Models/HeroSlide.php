<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $fillable = [
        'title', 'title_ar', 'subtitle', 'subtitle_ar', 'description', 'description_ar', 'image',
        'button_text', 'button_text_ar', 'button_link', 'button_text_2', 'button_text_2_ar', 'button_link_2',
        'is_active', 'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get localized title
     */
    public function getLocalizedTitleAttribute(): string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'title', '');
    }

    /**
     * Get localized subtitle
     */
    public function getLocalizedSubtitleAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'subtitle');
    }

    /**
     * Get localized description
     */
    public function getLocalizedDescriptionAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'description');
    }

    /**
     * Get localized button text
     */
    public function getLocalizedButtonTextAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'button_text');
    }

    /**
     * Get localized button text 2
     */
    public function getLocalizedButtonText2Attribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'button_text_2');
    }
}
