@extends('frontend.layouts.app')

@section('title', $event->localized_title . ' - Evenza')

@push('styles')
<style>
    .navbar { background: var(--dark) !important; }
    .navbar.scrolled { background: #fff !important; }
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
                                    @if($schedule->speaker)
                                    <p class="text-muted small mb-1">
                                        <i class="bi bi-person me-1"></i>{{ $schedule->speaker->localized_name }}
                                    </p>
                                    @endif
                                    @if($schedule->localized_venue)
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $schedule->localized_venue }}
                                    </p>
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
