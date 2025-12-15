<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'title', 'title_ar', 'slug', 'description', 'description_ar', 'short_description', 'short_description_ar', 'image',
        'venue', 'venue_ar', 'address', 'address_ar', 'event_date', 'start_time', 'end_time',
        'is_featured', 'is_active', 'order'
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class)->orderBy('schedule_date')->orderBy('start_time');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now()->toDateString());
    }

    /**
     * Get localized title
     */
    public function getLocalizedTitleAttribute(): string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'title', '');
    }

    /**
     * Get localized description
     */
    public function getLocalizedDescriptionAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'description');
    }

    /**
     * Get localized short description
     */
    public function getLocalizedShortDescriptionAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'short_description');
    }

    /**
     * Get localized venue
     */
    public function getLocalizedVenueAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'venue');
    }

    /**
     * Get localized address
     */
    public function getLocalizedAddressAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'address');
    }
}
