<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question', 'question_ar', 'answer', 'answer_ar', 'category', 'category_ar', 'is_active', 'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get localized question
     */
    public function getLocalizedQuestionAttribute(): string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'question', '');
    }

    /**
     * Get localized answer
     */
    public function getLocalizedAnswerAttribute(): string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'answer', '');
    }

    /**
     * Get localized category
     */
    public function getLocalizedCategoryAttribute(): ?string
    {
        return \App\Helpers\LocaleHelper::getLocalizedWithFallback($this, 'category');
    }
}
