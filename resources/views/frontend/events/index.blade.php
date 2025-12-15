@extends('frontend.layouts.app')

@section('title', 'Events - Evenza')

@push('styles')
<style>
    .navbar { background: var(--dark) !important; }
    .navbar.scrolled { background: #fff !important; }
</style>
@endpush

@section('content')
<section class="page-header">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Our Events</h1>
        <p class="lead opacity-75">Discover upcoming conferences and meetups</p>
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
                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}" style="height: 220px; object-fit: cover;">
                        @else
                        <div class="bg-primary-subtle d-flex align-items-center justify-content-center" style="height: 220px;">
                            <i class="bi bi-calendar-event text-primary" style="font-size: 4rem;"></i>
                        </div>
                        @endif
                        @if($event->is_featured)
                        <span class="badge bg-warning position-absolute top-0 end-0 m-3">Featured</span>
                        @endif
                        @if($event->event_date)
                        <div class="event-date position-absolute bottom-0 start-0 m-3 bg-white rounded p-2 text-center shadow-sm">
                            <span class="d-block fw-bold text-primary fs-4">{{ $event->event_date->format('d') }}</span>
                            <span class="text-muted small">{{ $event->event_date->format('M Y') }}</span>
                        </div>
                        @endif
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold">
                            <a href="{{ route('events.show', $event->slug) }}" class="text-decoration-none text-dark">{{ $event->title }}</a>
                        </h5>
                        <p class="card-text text-muted small mb-3">{{ Str::limit($event->short_description ?? $event->description, 100) }}</p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @if($event->venue)
                            <span class="badge bg-light text-dark"><i class="bi bi-geo-alt me-1"></i>{{ $event->venue }}</span>
                            @endif
                            @if($event->start_time)
                            <span class="badge bg-light text-dark"><i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}</span>
                            @endif
                        </div>
                        <a href="{{ route('events.show', $event->slug) }}" class="btn btn-outline-primary btn-sm">View Details</a>
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
            <h4 class="mt-3">No Events Found</h4>
            <p class="text-muted">Check back later for upcoming events.</p>
        </div>
        @endif
    </div>
</section>
@endsection
