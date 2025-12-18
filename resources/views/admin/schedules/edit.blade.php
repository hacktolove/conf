@extends('admin.layouts.app')
@section('title', 'Edit Schedule')
@section('page-title', 'Edit Schedule')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="event_id" class="form-label">Event *</label>
                        <select class="form-select" id="event_id" name="event_id" required>
                            <option value="">Select Event</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}" {{ old('event_id', $schedule->event_id) == $event->id ? 'selected' : '' }}>{{ $event->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="speaker_id" class="form-label">Speaker</label>
                        <select class="form-select" id="speaker_id" name="speaker_id">
                            <option value="">Select Speaker (Optional)</option>
                            @foreach($speakers as $speaker)
                                <option value="{{ $speaker->id }}" {{ old('speaker_id', $schedule->speaker_id) == $speaker->id ? 'selected' : '' }}>{{ $speaker->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $schedule->title) }}" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $schedule->description) }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="schedule_date" class="form-label">Date *</label>
                        <input type="date" class="form-control" id="schedule_date" name="schedule_date" value="{{ old('schedule_date', $schedule->schedule_date->format('Y-m-d')) }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time *</label>
                        <input type="time" class="form-control" id="start_time" name="start_time" value="{{ old('start_time', $schedule->start_time) }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time', $schedule->end_time) }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="venue" class="form-label">Venue</label>
                        <input type="text" class="form-control" id="venue" name="venue" value="{{ old('venue', $schedule->venue) }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="day_label" class="form-label">Day Label</label>
                        <input type="text" class="form-control" id="day_label" name="day_label" value="{{ old('day_label', $schedule->day_label) }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $schedule->order) }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $schedule->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <h6 class="mb-3">Arabic Content</h6>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="title_ar" class="form-label">Title (Arabic)</label>
                        <input type="text" class="form-control" id="title_ar" name="title_ar" value="{{ old('title_ar', $schedule->title_ar) }}" dir="rtl">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="description_ar" class="form-label">Description (Arabic)</label>
                        <textarea class="form-control" id="description_ar" name="description_ar" rows="3" dir="rtl">{{ old('description_ar', $schedule->description_ar) }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="venue_ar" class="form-label">Venue (Arabic)</label>
                        <input type="text" class="form-control" id="venue_ar" name="venue_ar" value="{{ old('venue_ar', $schedule->venue_ar) }}" dir="rtl">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="day_label_ar" class="form-label">Day Label (Arabic)</label>
                        <input type="text" class="form-control" id="day_label_ar" name="day_label_ar" value="{{ old('day_label_ar', $schedule->day_label_ar) }}" dir="rtl">
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Schedule</button>
            </div>
        </form>
    </div>
</div>
@endsection
