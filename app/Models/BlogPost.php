<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'user_id', 'title', 'title_ar', 'slug', 'excerpt', 'excerpt_ar', 'content', 'content_ar', 'image',
        'category', 'category_ar', 'tags', 'is_published', 'published_at', 'views'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where('published_at', '<=', now());
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function getReadTimeAttribute()
    {
        $content = \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'content', '');
        $words = str_word_count(strip_tags($content));
        $minutes = ceil($words / 200);
        return $minutes . ' min read';
    }

    /**
     * Get localized title
     */
    public function getLocalizedTitleAttribute(): string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'title', '');
    }

    /**
     * Get localized excerpt
     */
    public function getLocalizedExcerptAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'excerpt');
    }

    /**
     * Get localized content
     */
    public function getLocalizedContentAttribute(): string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'content', '');
    }

    /**
     * Get localized category
     */
    public function getLocalizedCategoryAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'category');
    }
}
