@extends('frontend.layouts.app')

@section('title', $event->localized_title . ' - Evenza')

@push('styles')
<style>
    .navbar { background: var(--dark) !important; }
    .navbar.scrolled { background: #fff !important; }
    
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
        
        /* Main Content Mobile */
        .col-lg-8 {
            margin-bottom: 2rem;
        }
        .card-body {
            padding: 1.5rem !important;
        }
        h4 {
            font-size: 1.25rem;
        }
        
        /* Schedule Items Mobile */
        .schedule-item {
            flex-direction: column !important;
        }
        .schedule-time {
            margin-right: 0 !important;
            margin-bottom: 1rem;
            min-width: auto !important;
        }
        
        /* Sidebar Mobile */
        .sticky-top {
            position: relative !important;
            top: 0 !important;
        }
        .icon-box {
            width: 40px !important;
            height: 40px !important;
        }
        .icon-box i {
            font-size: 1rem !important;
        }
        .btn.w-100 {
            margin-top: 1rem;
        }
    }
    
    @media (max-width: 576px) {
        /* Extra Small Mobile */
        .page-header h1.display-4 {
            font-size: 1.5rem !important;
        }
        .card-body {
            padding: 1.25rem !important;
        }
        h4 {
            font-size: 1.1rem;
        }
        h5 {
            font-size: 1rem;
        }
        .icon-box {
            width: 35px !important;
            height: 35px !important;
        }
    }
</style>
@endpush

@section('content')
<section class="page-header">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">{{ $event->localized_title }}</h1>
        @if($event->localized_short_description)
        <p class="lead opacity-75">{{ $event->localized_short_description }}</p>
        @endif
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->localized_title }}" class="img-fluid rounded shadow-sm mb-4 w-100">
                @endif

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">{{ __('messages.about_this_event') }}</h4>
                        <div class="content">
                            {!! nl2br(e($event->localized_description ?? '')) !!}
                        </div>
                    </div>
                </div>

                @if($event->schedules->count() > 0)
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">{{ __('messages.event_schedule') }}</h4>
                        <div class="schedule-list">
                            @foreach($event->schedules->sortBy(['date', 'start_time']) as $schedule)
                            <div class="schedule-item d-flex mb-4 pb-4 border-bottom">
                                <div class="schedule-time me-4 text-center" style="min-width: 80px;">
                                    <span class="badge bg-primary-subtle text-primary">{{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }}</span>
                                </div>
                                <div class="schedule-content flex-grow-1">
                                    <h6 class="fw-bold mb-1">{{ $schedule->localized_title }}</h6>
                                    @if($schedule->speakers->count() > 0)
                                    <p class="text-muted small mb-1">
                                        <i class="bi bi-person me-1"></i>
                                        @foreach($schedule->speakers as $speaker)
                                            <a href="{{ route('speakers.show', $speaker->slug) }}" class="text-decoration-none">{{ $speaker->localized_name }}</a>@if(!$loop->last), @endif
                                        @endforeach
                                    </p>
                                    @endif
                                    @if($schedule->localized_venue)
                                        @php
                                            $venue = $schedule->localized_venue;
                                            $isUrl = filter_var($venue, FILTER_VALIDATE_URL) !== false || Str::startsWith($venue, ['http://', 'https://']);
                                            $isArabic = app()->getLocale() === 'ar';
                                            $linkText = $isArabic ? 'إنضم للجلسة' : 'Join Session';
                                        @endphp
                                        @if($isUrl)
                                            <a href="{{ $venue }}" target="_blank" class="btn btn-sm btn-success mb-1" style="text-decoration: none;">
                                                <i class="icon-videocam mr-1"></i>{{ $linkText }}
                                            </a>
                                        @else
                                            <p class="text-muted small mb-1">
                                                <i class="icon-location mr-1"></i>{{ $venue }}
                                            </p>
                                        @endif
                                    @endif
                                    @if($schedule->pdf_file && $schedule->allow_download)
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $schedule->pdf_file) }}" target="_blank" class="btn btn-sm btn-outline-primary" download>
                                            <i class="bi bi-file-earmark-pdf me-1"></i>Download PDF
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Event Details</h5>

                        @if($event->event_date)
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                <i class="bi bi-calendar text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Date</small>
                                <span class="fw-semibold">{{ $event->event_date->format('F d, Y') }}</span>
                            </div>
                        </div>
                        @endif

                        @if($event->start_time)
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                <i class="bi bi-clock text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Time</small>
                                <span class="fw-semibold">
                                    {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}
                                    @if($event->end_time)
                                    - {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        @endif

                        @if($event->venue)
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                <i class="bi bi-geo-alt text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Venue</small>
                                <span class="fw-semibold">{{ $event->venue }}</span>
                            </div>
                        </div>
                        @endif

                        @if($event->address)
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                <i class="bi bi-pin-map text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Address</small>
                                <span class="fw-semibold">{{ $event->address }}</span>
                            </div>
                        </div>
                        @endif

                        @if($event->registration_link)
                        <a href="{{ $event->registration_link }}" target="_blank" class="btn btn-primary w-100">
                            <i class="bi bi-person-plus me-2"></i>Register Now
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
