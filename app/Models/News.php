<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'title', 'title_ar', 'slug', 'body', 'body_ar', 'date', 'image',
        'is_published', 'published_at', 'views'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where('published_at', '<=', now());
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('date', 'desc')->orderBy('published_at', 'desc');
    }

    /**
     * Get localized title
     */
    public function getLocalizedTitleAttribute(): string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'title', '');
    }

    /**
     * Get localized body
     */
    public function getLocalizedBodyAttribute(): string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'body', '');
    }
}

