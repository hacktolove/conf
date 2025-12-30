@extends('frontend.layouts.app')

@section('title', __('messages.page_title_speakers'))

@push('styles')
<style>
    .navbar { background: var(--dark) !important; }
    .navbar.scrolled { background: #fff !important; }

    /* Social Links Centering */
    .social-links {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .social-links .btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        padding: 0;
    }
    .social-links .btn i {
        margin: 0;
    }

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

        /* Speaker Cards Mobile */
        .speaker-card .card-body {
            padding: 1.5rem !important;
        }
        .speaker-image img,
        .speaker-image div {
            width: 120px !important;
            height: 120px !important;
        }
        .speaker-image i {
            font-size: 3rem !important;
        }
        .col-lg-3 {
            margin-bottom: 1.5rem;
        }
        .social-links .btn {
            width: 35px;
            height: 35px;
            padding: 0;
        }
    }

    @media (max-width: 576px) {
        /* Extra Small Mobile */
        .page-header h1.display-4 {
            font-size: 1.5rem !important;
        }
        .speaker-card .card-body {
            padding: 1.25rem !important;
        }
        .speaker-image img,
        .speaker-image div {
            width: 100px !important;
            height: 100px !important;
        }
        .speaker-image i {
            font-size: 2.5rem !important;
        }
        h5 {
            font-size: 1rem;
        }
    }
</style>
@endpush

@section('content')
<section class="page-header">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">{{ __('messages.our_speakers_title') }}</h1>
        <p class="lead opacity-75">{{ __('messages.meet_experts') }}</p>
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
                            <img src="{{ asset('storage/' . $speaker->image) }}" alt="{{ $speaker->localized_name }}" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                            <div class="bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 150px; height: 150px;">
                                <i class="bi bi-person text-primary" style="font-size: 4rem;"></i>
                            </div>
                            @endif
                        </div>
                        <h5 class="fw-bold mb-1">
                            <a href="{{ route('speakers.show', $speaker->slug) }}" class="text-decoration-none text-dark">{{ $speaker->localized_name }}</a>
                        </h5>
                        <p class="text-primary mb-1">{{ $speaker->localized_title }}</p>
                        @if($speaker->localized_company)
                        <p class="text-muted small mb-3">{{ $speaker->localized_company }}</p>
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
            <h4 class="mt-3">{{ __('messages.no_speakers_found') }}</h4>
            <p class="text-muted">{{ __('messages.check_back_speakers') }}</p>
        </div>
        @endif
    </div>
</section>
@endsection
