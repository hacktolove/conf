<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Speaker extends Model
{
    protected $fillable = [
        'name', 'name_ar', 'slug', 'title', 'title_ar', 'company', 'company_ar', 'bio', 'bio_ar', 'image',
        'email', 'phone', 'experience',
        'facebook', 'twitter', 'linkedin', 'instagram', 'website',
        'is_featured', 'is_active', 'order'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($speaker) {
            if (empty($speaker->slug)) {
                $speaker->slug = Str::slug($speaker->name);
            }
        });
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

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
     * Get localized bio
     */
    public function getLocalizedBioAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'bio');
    }
}
