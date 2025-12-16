@extends('frontend.layouts.app')

@section('title', $speaker->localized_name . ' - Evenza')

@push('styles')
<style>
    .breadcrumb-section {
        background: linear-gradient(135deg, var(--gradient-hero-from) 0%, var(--gradient-hero-to) 100%);
        padding: 2rem 0;
        color: #fff;
    }
    .breadcrumb-item a {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
    }
    .breadcrumb-item.active {
        color: #fff;
    }
    .speaker-header-section {
        padding: 4rem 0;
        background: #f8f9fa;
    }
    .speaker-image-wrapper {
        position: relative;
        margin-bottom: 2rem;
    }
    .speaker-image-wrapper img {
        width: 100%;
        max-width: 400px;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .speaker-info-card {
        background: #fff;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }
    .info-item {
        display: flex;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #eee;
    }
    .info-item:last-child {
        border-bottom: none;
    }
    .info-item i {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(99, 102, 241, 0.1);
        color: var(--primary);
        border-radius: 0.5rem;
        margin-right: 1rem;
    }
    .info-item-content h6 {
        margin: 0;
        font-weight: 600;
        color: #333;
    }
    .info-item-content p {
        margin: 0;
        color: #666;
        font-size: 0.9rem;
    }
    .what-we-do-section {
        padding: 4rem 0;
        background: #fff;
    }
    .feature-card {
        background: #f8f9fa;
        border-radius: 1rem;
        padding: 2rem;
        text-align: center;
        height: 100%;
        transition: all 0.3s;
    }
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .feature-card i {
        font-size: 3rem;
        color: var(--primary);
        margin-bottom: 1rem;
    }
    .skills-section {
        padding: 4rem 0;
        background: #f8f9fa;
    }
    .skill-item {
        margin-bottom: 2rem;
    }
    .skill-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }
    .skill-name {
        font-weight: 600;
        color: #333;
    }
    .skill-percentage {
        color: var(--primary);
        font-weight: 600;
    }
    .progress {
        height: 10px;
        border-radius: 5px;
        background: #e9ecef;
    }
    .progress-bar {
        background: var(--primary);
    }
    .contact-form-section {
        padding: 4rem 0;
        background: #fff;
    }
    .contact-form-card {
        background: #f8f9fa;
        border-radius: 1rem;
        padding: 3rem;
    }
</style>
@endpush

@section('content')
<!-- Breadcrumb Section -->
<section class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.breadcrumb_home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('speakers') }}">{{ __('messages.nav_speakers') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $speaker->localized_name }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Speaker Header Section -->
<section class="speaker-header-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-center">
                <div class="speaker-image-wrapper">
                    @if($speaker->image)
                    <img src="{{ asset('storage/' . $speaker->image) }}" alt="{{ $speaker->localized_name }}" class="img-fluid">
                    @else
                    <div class="bg-primary-subtle rounded d-flex align-items-center justify-content-center mx-auto" style="width: 400px; height: 400px;">
                        <i class="bi bi-person text-primary" style="font-size: 8rem;"></i>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">{{ $speaker->localized_name }}</h1>
                @if($speaker->localized_title)
                <p class="lead text-primary mb-4">{{ $speaker->localized_title }}</p>
                @endif
                @if($speaker->localized_company)
                <p class="text-muted mb-4">{{ $speaker->localized_company }}</p>
                @endif
                
                <!-- Contact Information -->
                <div class="row g-3 mb-4">
                    @if($speaker->phone)
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-telephone-fill text-primary me-3 fs-4"></i>
                            <div>
                                <small class="text-muted d-block">Phone</small>
                                <strong>{{ $speaker->phone }}</strong>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($speaker->email)
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-envelope-fill text-primary me-3 fs-4"></i>
                            <div>
                                <small class="text-muted d-block">Email</small>
                                <strong>{{ $speaker->email }}</strong>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Social Links -->
                <div class="d-flex gap-3 mb-4">
                    @if($speaker->twitter)
                    <a href="{{ $speaker->twitter }}" target="_blank" class="btn btn-outline-primary rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    @endif
                    @if($speaker->linkedin)
                    <a href="{{ $speaker->linkedin }}" target="_blank" class="btn btn-outline-primary rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    @endif
                    @if($speaker->facebook)
                    <a href="{{ $speaker->facebook }}" target="_blank" class="btn btn-outline-primary rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-facebook"></i>
                    </a>
                    @endif
                    @if($speaker->instagram)
                    <a href="{{ $speaker->instagram }}" target="_blank" class="btn btn-outline-primary rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-instagram"></i>
                    </a>
                    @endif
                    @if($speaker->website)
                    <a href="{{ $speaker->website }}" target="_blank" class="btn btn-outline-primary rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-globe"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
@if($speaker->bio)
<section class="py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title mb-4">About</h2>
                <div class="content text-muted">
                    {!! nl2br(e($speaker->localized_bio ?? '')) !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Speaker Info Cards -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row g-4">
                    @if($speaker->email)
                    <div class="col-md-6">
                        <div class="speaker-info-card">
                            <div class="info-item">
                                <i class="bi bi-envelope-fill"></i>
                                <div class="info-item-content">
                                    <h6>Email</h6>
                                    <p>{{ $speaker->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($speaker->phone)
                    <div class="col-md-6">
                        <div class="speaker-info-card">
                            <div class="info-item">
                                <i class="bi bi-telephone-fill"></i>
                                <div class="info-item-content">
                                    <h6>Phone</h6>
                                    <p>{{ $speaker->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($speaker->experience)
                    <div class="col-md-6">
                        <div class="speaker-info-card">
                            <div class="info-item">
                                <i class="bi bi-clock-history"></i>
                                <div class="info-item-content">
                                    <h6>Experience</h6>
                                    <p>{{ $speaker->experience }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($speaker->title)
                    <div class="col-md-6">
                        <div class="speaker-info-card">
                            <div class="info-item">
                                <i class="bi bi-briefcase-fill"></i>
                                <div class="info-item-content">
                                    <h6>Position</h6>
                                    <p>{{ $speaker->localized_title }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What We Do Section -->
<section class="what-we-do-section">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-subtitle">What we do</p>
            <h2 class="section-title display-5">What we do</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <i class="bi bi-mic"></i>
                    <h5 class="mb-3">Public Speaking</h5>
                    <p class="text-muted">Expert in delivering engaging and impactful presentations to diverse audiences.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <i class="bi bi-lightbulb"></i>
                    <h5 class="mb-3">Innovation Strategy</h5>
                    <p class="text-muted">Helping organizations develop and implement innovative strategies for growth.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <i class="bi bi-people"></i>
                    <h5 class="mb-3">Team Leadership</h5>
                    <p class="text-muted">Building and leading high-performing teams to achieve organizational goals.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <i class="bi bi-graph-up"></i>
                    <h5 class="mb-3">Business Growth</h5>
                    <p class="text-muted">Driving sustainable business growth through strategic planning and execution.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Work Skills Section -->
<section class="skills-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="text-center mb-5">
                    <p class="section-subtitle">Work Skills</p>
                    <h2 class="section-title display-5">Work Skills</h2>
                </div>
                <div class="bg-white rounded p-4 shadow-sm">
                    <div class="skill-item">
                        <div class="skill-header">
                            <span class="skill-name">Public Speaking</span>
                            <span class="skill-percentage">95%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 95%"></div>
                        </div>
                    </div>
                    <div class="skill-item">
                        <div class="skill-header">
                            <span class="skill-name">Strategic Planning</span>
                            <span class="skill-percentage">90%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 90%"></div>
                        </div>
                    </div>
                    <div class="skill-item">
                        <div class="skill-header">
                            <span class="skill-name">Team Leadership</span>
                            <span class="skill-percentage">88%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 88%"></div>
                        </div>
                    </div>
                    <div class="skill-item">
                        <div class="skill-header">
                            <span class="skill-name">Innovation</span>
                            <span class="skill-percentage">92%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 92%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sessions Section -->
@if($speaker->schedules->count() > 0)
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <p class="section-subtitle">Sessions</p>
            <h2 class="section-title display-5">Upcoming Sessions</h2>
        </div>
        <div class="row">
            <div class="col-lg-10 mx-auto">
                @foreach($speaker->schedules as $schedule)
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <div class="text-center">
                                    <div class="text-primary fw-bold fs-4">
                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                        @if($schedule->end_time)
                                        - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ $schedule->schedule_date ? \Carbon\Carbon::parse($schedule->schedule_date)->format('M d, Y') : '' }}</small>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h5 class="mb-2">{{ $schedule->localized_title }}</h5>
                                @if($schedule->localized_description)
                                <p class="text-muted mb-2">{{ $schedule->localized_description }}</p>
                                @endif
                                @if($schedule->localized_venue)
                                <small class="text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $schedule->localized_venue }}</small>
                                @endif
                            </div>
                            @if($schedule->event)
                            <div class="col-md-2 text-end">
                                <a href="{{ route('events.show', $schedule->event->slug) }}" class="btn btn-outline-primary btn-sm">View Event</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<!-- Get In Touch Section -->
<section class="contact-form-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="text-center mb-5">
                    <p class="section-subtitle">Get In Touch</p>
                    <h2 class="section-title display-5">Get In Touch</h2>
                </div>
                <div class="contact-form-card">
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subject" value="Contact regarding {{ $speaker->localized_name }}">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="col-md-6">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" value="Contact regarding {{ $speaker->localized_name }}">
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Message *</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Send Message</button>
                            </div>
                        </div>
                    </form>
                    @if(session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-3">Join our newsletter for event important announcement</h2>
                <p class="lead opacity-90">Stay informed with instant updates delivered straight to your inbox.</p>
            </div>
            <div class="col-lg-6">
                <form action="{{ route('subscribe') }}" method="POST" class="d-flex gap-2">
                    @csrf
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter your email address" required>
                    <button type="submit" class="btn btn-light btn-lg px-4">Subscribe</button>
                </form>
                @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
