@extends('frontend.layouts.app')

@section('title', __('messages.page_title_schedule'))

@push('styles')
<style>
    .navbar { background: var(--dark) !important; }
    .navbar.scrolled { background: #fff !important; }
    .nav-pills .nav-link { color: var(--dark); border-radius: 0; border-bottom: 2px solid transparent; }
    .nav-pills .nav-link.active { background: transparent; color: var(--primary); border-bottom-color: var(--primary); }
    
    /* Responsive Styles */
    @media (max-width: 768px) {
        /* Page Header Mobile */
        .page-header h1.display-4 {
            font-size: 2rem !important;
        }
        .page-header .lead {
            font-size: 1rem;
        }
        
        /* Section Padding Mobile */
        section.py-5 {
            padding-top: 2.5rem !important;
            padding-bottom: 2.5rem !important;
        }
        .container.py-5 {
            padding-top: 2.5rem !important;
            padding-bottom: 2.5rem !important;
        }
        
        /* Schedule Tabs Mobile */
        .nav-pills {
            overflow-x: auto;
            flex-wrap: nowrap;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 0.5rem;
        }
        .nav-pills .nav-link {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            white-space: nowrap;
            min-width: 120px;
        }
        
        /* Schedule Items Mobile */
        .schedule-item .card-body {
            padding: 1.5rem !important;
        }
        .schedule-item .col-md-2 {
            border-end: none !important;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }
        .schedule-item .col-md-7,
        .schedule-item .col-md-3 {
            margin-bottom: 1rem;
        }
        .schedule-item .col-md-3 {
            text-align: left !important;
        }
        .schedule-item .rounded-circle {
            width: 50px !important;
            height: 50px !important;
        }
    }
    
    @media (max-width: 576px) {
        /* Extra Small Mobile */
        .page-header h1.display-4 {
            font-size: 1.5rem !important;
        }
        .schedule-item .card-body {
            padding: 1.25rem !important;
        }
        .nav-pills .nav-link {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
            min-width: 100px;
        }
    }
</style>
@endpush

@section('content')
<section class="page-header">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">{{ __('messages.event_schedule_title') }}</h1>
        <p class="lead opacity-75">{{ __('messages.plan_conference') }}</p>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        @if($schedules->count() > 0)
        @php
            $groupedSchedules = $schedules->groupBy(function($schedule) {
                return $schedule->schedule_date ? $schedule->schedule_date->format('Y-m-d') : 'No Date';
            });
        @endphp

        @if($groupedSchedules->count() > 1)
        <ul class="nav nav-pills justify-content-center mb-5" id="scheduleTab" role="tablist">
            @foreach($groupedSchedules as $date => $items)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $loop->index }}" data-bs-toggle="pill" data-bs-target="#day-{{ $loop->index }}" type="button" role="tab">
                    @if($date !== 'No Date')
                    <span class="d-block fw-bold">{{ __('messages.day') }} {{ $loop->iteration }}</span>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($date)->format('M d, Y') }}</small>
                    @else
                    <span class="d-block fw-bold">{{ __('messages.sessions') }}</span>
                    @endif
                </button>
            </li>
            @endforeach
        </ul>
        @endif

        <div class="tab-content" id="scheduleTabContent">
            @foreach($groupedSchedules as $date => $items)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="day-{{ $loop->index }}" role="tabpanel">
                <div class="schedule-timeline">
                    @foreach($items->sortBy('start_time') as $schedule)
                    <div class="schedule-item card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-2 col-12 text-center border-end mb-3 mb-md-0">
                                    <span class="badge bg-primary-subtle text-primary fs-6 mb-1">
                                        {{ $schedule->start_time ? \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') : 'TBA' }}
                                    </span>
                                    @if($schedule->end_time)
                                    <br>
                                    <small class="text-muted">to {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}</small>
                                    @endif
                                </div>
                                <div class="col-md-7 col-12 mb-3 mb-md-0">
                                    <h5 class="fw-bold mb-2">{{ $schedule->localized_title }}</h5>
                                    @if($schedule->localized_description)
                                    <p class="text-muted mb-2">{{ Str::limit($schedule->localized_description, 150) }}</p>
                                    @endif
                                    <div class="d-flex flex-wrap gap-2 mb-2">
                                        @if($schedule->localized_venue)
                                        <span class="badge bg-light text-dark"><i class="bi bi-geo-alt me-1"></i>{{ $schedule->localized_venue }}</span>
                                        @endif
                                        @if($schedule->event)
                                        <span class="badge bg-light text-dark"><i class="bi bi-calendar-event me-1"></i>{{ $schedule->event->localized_title }}</span>
                                        @endif
                                    </div>
                                    @if($schedule->pdf_file && $schedule->allow_download)
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $schedule->pdf_file) }}" target="_blank" class="btn btn-sm btn-outline-primary" download>
                                            <i class="bi bi-file-earmark-pdf me-1"></i>Download PDF
                                        </a>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-3 col-12 text-center">
                                    @if($schedule->speaker)
                                    <a href="{{ route('speakers.show', $schedule->speaker->slug) }}" class="text-decoration-none">
                                        @if($schedule->speaker->image)
                                        <img src="{{ asset('storage/' . $schedule->speaker->image) }}" alt="{{ $schedule->speaker->localized_name }}" class="rounded-circle mb-2" style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                        <div class="bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 60px; height: 60px;">
                                            <i class="bi bi-person text-primary"></i>
                                        </div>
                                        @endif
                                        <p class="mb-0 fw-semibold text-dark">{{ $schedule->speaker->localized_name }}</p>
                                        <small class="text-muted">{{ $schedule->speaker->localized_title }}</small>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-calendar3 text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3">{{ __('messages.no_schedule_available') }}</h4>
            <p class="text-muted">{{ __('messages.schedule_announced_soon') }}</p>
        </div>
        @endif
    </div>
</section>
@endsection
