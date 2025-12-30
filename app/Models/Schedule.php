<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'event_id', 'title', 'title_ar', 'description', 'description_ar',
        'schedule_date', 'start_time', 'end_time', 'venue', 'venue_ar',
        'day_label', 'day_label_ar', 'pdf_file', 'allow_download', 'order', 'is_active'
    ];

    protected $casts = [
        'schedule_date' => 'date',
        'is_active' => 'boolean',
        'allow_download' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'schedule_speaker');
    }

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
     * Get localized description
     */
    public function getLocalizedDescriptionAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'description');
    }

    /**
     * Get localized venue
     */
    public function getLocalizedVenueAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'venue');
    }

    /**
     * Get localized day label
     */
    public function getLocalizedDayLabelAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'day_label');
    }
}
