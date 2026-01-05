@extends('admin.layouts.app')
@section('title', 'Edit Schedule')
@section('page-title', 'Edit Schedule')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST" enctype="multipart/form-data">
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
                        <label class="form-label">Speakers (Optional)</label>
                        <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                            @php
                                $selectedSpeakerIds = old('speaker_ids', $schedule->speakers->pluck('id')->toArray());
                            @endphp
                            @forelse($speakers as $speaker)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="speaker_ids[]" value="{{ $speaker->id }}" id="speaker_{{ $speaker->id }}" {{ in_array($speaker->id, $selectedSpeakerIds) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="speaker_{{ $speaker->id }}">
                                        {{ $speaker->name }}
                                    </label>
                                </div>
                            @empty
                                <p class="text-muted mb-0">No speakers available</p>
                            @endforelse
                        </div>
                        <small class="text-muted">Select one or more speakers for this schedule</small>
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
                        <small class="text-muted">Enter venue name or Google Meet URL</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="day_label" class="form-label">Day Label</label>
                        <input type="text" class="form-control" id="day_label" name="day_label" value="{{ old('day_label', $schedule->day_label) }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" id="venue_is_link" name="venue_is_link" value="1" {{ old('venue_is_link', $schedule->venue_is_link) ? 'checked' : '' }}>
                        <label class="form-check-label" for="venue_is_link">Display Venue as Google Meet Link</label>
                        <small class="text-muted d-block">Check this if the venue is a Google Meet URL that should be clickable</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $schedule->order) }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="pdf_file" class="form-label">PDF File</label>
                        @if($schedule->pdf_file)
                            <div class="mb-2">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-file-earmark-pdf text-danger fs-4"></i>
                                    <div>
                                        <a href="{{ asset('storage/' . $schedule->pdf_file) }}" target="_blank" class="text-decoration-none">
                                            {{ basename($schedule->pdf_file) }}
                                        </a>
                                        <small class="text-muted d-block">Current PDF file</small>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remove_pdf" name="remove_pdf" value="1">
                                    <label class="form-check-label text-danger" for="remove_pdf">Remove current PDF</label>
                                </div>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="pdf_file" name="pdf_file" accept="application/pdf">
                        <small class="text-muted">Maximum file size: 10MB. Only PDF files are allowed. Leave empty to keep current file.</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="allow_download" name="allow_download" value="1" {{ old('allow_download', $schedule->allow_download) ? 'checked' : '' }}>
                        <label class="form-check-label" for="allow_download">Allow Download on Frontend</label>
                        <small class="text-muted d-block">Check this to make the PDF visible and downloadable on the frontend</small>
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
