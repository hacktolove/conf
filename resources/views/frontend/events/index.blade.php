@extends('frontend.layouts.app')

@section('title', 'Events - Evenza')

@push('styles')
<style>
    .navbar { background: var(--dark) !important; }
    .navbar.scrolled { background: #fff !important; }

    /* RTL fixes for events page */
    [dir="rtl"] .event-card .position-absolute.end-0 {
        left: 0 !important;
        right: auto !important;
    }
    [dir="rtl"] .event-card .position-absolute.start-0 {
        right: 0 !important;
        left: auto !important;
    }
    [dir="rtl"] .event-card .badge i.me-1 {
        margin-right: 0 !important;
        margin-left: 0.25rem !important;
    }
    [dir="rtl"] .event-date {
        right: 0 !important;
        left: auto !important;
    }
    [dir="rtl"] .event-card .d-flex.gap-2 {
        flex-direction: row-reverse;
    }
</style>
@endpush

@section('content')
<section class="page-header">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">{{ __('messages.our_events') }}</h1>
        <p class="lead opacity-75">{{ __('messages.discover_upcoming') }}</p>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        @if($events->count() > 0)
        <div class="row g-4">
            @foreach($events as $event)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm event-card">
                    <div class="position-relative">
                        @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->localized_title }}" style="height: 220px; object-fit: cover;">
                        @else
                        <div class="bg-primary-subtle d-flex align-items-center justify-content-center" style="height: 220px;">
                            <i class="bi bi-calendar-event text-primary" style="font-size: 4rem;"></i>
                        </div>
                        @endif
                        @if($event->is_featured)
                        <span class="badge bg-warning position-absolute top-0 {{ app()->getLocale() === 'ar' ? 'start-0' : 'end-0' }} m-3">{{ __('messages.featured') }}</span>
                        @endif
                        @if($event->event_date)
                        <div class="event-date position-absolute bottom-0 {{ app()->getLocale() === 'ar' ? 'end-0' : 'start-0' }} m-3 bg-white rounded p-2 text-center shadow-sm">
                            <span class="d-block fw-bold text-primary fs-4">{{ $event->event_date->format('d') }}</span>
                            <span class="text-muted small">{{ $event->event_date->format('M Y') }}</span>
                        </div>
                        @endif
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold">
                            <a href="{{ route('events.show', $event->slug) }}" class="text-decoration-none text-dark">{{ $event->localized_title }}</a>
                        </h5>
                        <p class="card-text text-muted small mb-3">{{ Str::limit($event->localized_short_description ?? $event->localized_description, 100) }}</p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @if($event->localized_venue)
                            <span class="badge bg-light text-dark"><i class="bi bi-geo-alt {{ app()->getLocale() === 'ar' ? 'ms-1' : 'me-1' }}"></i>{{ $event->localized_venue }}</span>
                            @endif
                            @if($event->start_time)
                            <span class="badge bg-light text-dark"><i class="bi bi-clock {{ app()->getLocale() === 'ar' ? 'ms-1' : 'me-1' }}"></i>{{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}</span>
                            @endif
                        </div>
                        <a href="{{ route('events.show', $event->slug) }}" class="btn btn-outline-primary btn-sm">{{ __('messages.view_details') }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-5">
            {{ $events->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-calendar-x text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3">{{ __('messages.no_events_found') }}</h4>
            <p class="text-muted">{{ __('messages.check_back_events') }}</p>
        </div>
        @endif
    </div>
</section>
@endsection
