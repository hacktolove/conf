@extends('frontend.layouts.app')

@section('title', 'Speakers - Evenza')

@push('styles')
<style>
    .navbar { background: var(--dark) !important; }
    .navbar.scrolled { background: #fff !important; }
</style>
@endpush

@section('content')
<section class="page-header">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Our Speakers</h1>
        <p class="lead opacity-75">Meet our industry experts and thought leaders</p>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        @if($speakers->count() > 0)
        <div class="row g-4">
            @foreach($speakers as $speaker)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm speaker-card text-center">
                    <div class="card-body p-4">
                        <div class="speaker-image mb-3 mx-auto">
                            @if($speaker->image)
                            <img src="{{ asset('storage/' . $speaker->image) }}" alt="{{ $speaker->name }}" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                            <div class="bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 150px; height: 150px;">
                                <i class="bi bi-person text-primary" style="font-size: 4rem;"></i>
                            </div>
                            @endif
                        </div>
                        <h5 class="fw-bold mb-1">
                            <a href="{{ route('speakers.show', $speaker->slug) }}" class="text-decoration-none text-dark">{{ $speaker->name }}</a>
                        </h5>
                        <p class="text-primary mb-1">{{ $speaker->title }}</p>
                        @if($speaker->company)
                        <p class="text-muted small mb-3">{{ $speaker->company }}</p>
                        @endif
                        <div class="social-links">
                            @if($speaker->twitter)
                            <a href="{{ $speaker->twitter }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-twitter-x"></i></a>
                            @endif
                            @if($speaker->linkedin)
                            <a href="{{ $speaker->linkedin }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-linkedin"></i></a>
                            @endif
                            @if($speaker->website)
                            <a href="{{ $speaker->website }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-globe"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-5">
            {{ $speakers->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-people text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3">No Speakers Found</h4>
            <p class="text-muted">Check back later for speaker announcements.</p>
        </div>
        @endif
    </div>
</section>
@endsection
