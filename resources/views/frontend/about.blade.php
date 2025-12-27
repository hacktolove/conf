@extends('frontend.layouts.app')

@section('title', 'About Us - Evenza')

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

        /* Typography Mobile */
        .display-5 {
            font-size: 1.75rem !important;
        }
        h2.display-5 {
            font-size: 1.75rem !important;
        }

        /* Statistics Grid Mobile */
        .stat-icon i {
            font-size: 1.5rem !important;
        }
        .stat-icon {
            margin-right: 0.75rem !important;
        }

        /* Value Cards Mobile */
        .col-md-4 .card-body {
            padding: 1.5rem !important;
        }
        .icon-box {
            width: 60px !important;
            height: 60px !important;
        }
        .icon-box i {
            font-size: 1.5rem !important;
        }

        .col-lg-4 .card-body {
            padding: 1.5rem !important;
        }
    }

    @media (max-width: 576px) {
        /* Extra Small Mobile */
        .page-header h1.display-4 {
            font-size: 1.5rem !important;
        }
        .display-5 {
            font-size: 1.5rem !important;
        }
        h2.display-5 {
            font-size: 1.5rem !important;
        }
        .stat-icon i {
            font-size: 1.25rem !important;
        }
        .col-md-4 .card-body {
            padding: 1.25rem !important;
        }
        .col-lg-4 .card-body {
            padding: 1.25rem !important;
        }
    }
</style>
@endpush

@section('content')
<section class="page-header">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">{{ __('messages.about_us_title') }}</h1>
        <p class="lead opacity-75">{{ __('messages.about_us_subtitle') }}</p>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                <img src="{{ asset('images/about.jpg') }}" alt="About Us" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6 col-md-12">
                <span class="badge bg-primary-subtle text-primary mb-3">{{ __('messages.who_we_are') }}</span>
                <h2 class="display-5 fw-bold mb-4">{{ App\Models\SiteSetting::getLocalized('site_name', 'Evenza') }}</h2>
                <p class="lead text-muted">{{ App\Models\SiteSetting::getLocalized('site_tagline', 'Your Premier Event Management Platform') }}</p>
                <p class="text-muted">{{ App\Models\SiteSetting::getLocalized('site_description', 'We are dedicated to creating unforgettable event experiences that bring people together and inspire innovation.') }}</p>

                <div class="row g-4 mt-4">
                    @foreach($statistics ?? [] as $stat)
                    <div class="col-sm-6 col-6">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon me-3">
                                <i class="bi {{ $stat->icon ?? 'bi-star' }} text-primary fs-2"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0">{{ $stat->value }}{{ $stat->suffix }}</h3>
                                <p class="text-muted mb-0">{{ $stat->title }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge bg-primary-subtle text-primary mb-3">{{ __('messages.our_values') }}</span>
            <h2 class="display-5 fw-bold">{{ __('messages.what_drives_us') }}</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-primary-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-lightbulb text-primary fs-2"></i>
                        </div>
                        <h5 class="fw-bold">{{ __('messages.innovation') }}</h5>
                        <p class="text-muted mb-0">{{ __('messages.innovation_description') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-primary-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-people text-primary fs-2"></i>
                        </div>
                        <h5 class="fw-bold">{{ __('messages.community') }}</h5>
                        <p class="text-muted mb-0">{{ __('messages.community_description') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-box bg-primary-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-award text-primary fs-2"></i>
                        </div>
                        <h5 class="fw-bold">{{ __('messages.excellence') }}</h5>
                        <p class="text-muted mb-0">{{ __('messages.excellence_description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
