<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name', 'name_ar', 'title', 'title_ar', 'company', 'company_ar', 'content', 'content_ar', 'image',
        'rating', 'is_active', 'order'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get localized name
     */
    public function getLocalizedNameAttribute(): string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'name', '');
    }

    /**
     * Get localized title
     */
    public function getLocalizedTitleAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'title');
    }

    /**
     * Get localized company
     */
    public function getLocalizedCompanyAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'company');
    }

    /**
     * Get localized content
     */
    public function getLocalizedContentAttribute(): string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'content', '');
    }
}
