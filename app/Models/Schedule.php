<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'event_id', 'speaker_id', 'title', 'description',
        'schedule_date', 'start_time', 'end_time', 'venue',
        'day_label', 'order', 'is_active'
    ];

    protected $casts = [
        'schedule_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
