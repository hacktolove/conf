@extends('frontend.layouts.app')

@section('title', 'Evenza - Premier Event Management')

@push('styles')
<style>
    /* Enhanced Countdown Timer */
    .countdown-timer {
        display: flex;
        gap: 1.5rem;
        justify-content: flex-start;
        margin: 2.5rem 0;
        flex-wrap: wrap;
    }
    .countdown-item {
        text-align: center;
        color: #fff;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 1.5rem 1rem;
        min-width: 90px;
        transition: transform 0.3s;
    }
    .countdown-item:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.15);
    }
    /* Speaker Reveal Countdown */
    #speakerCountdown .countdown-item {
        background: rgba(99, 102, 241, 0.1);
        color: var(--primary);
    }
    #speakerCountdown .countdown-item:hover {
        background: rgba(99, 102, 241, 0.15);
    }
    .countdown-item .number {
        font-size: 2.5rem;
        font-weight: 800;
        display: block;
        line-height: 1;
        margin-bottom: 0.5rem;
    }
    .countdown-item .label {
        font-size: 0.75rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 600;
    }
    /* Watch Video Button */
    .btn-watch-video {
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s;
        text-decoration: none;
    }
    .btn-watch-video:hover {
        background: rgba(255, 255, 255, 0.3);
        border-color: rgba(255, 255, 255, 0.5);
        color: #fff;
        transform: translateY(-2px);
    }
    .btn-watch-video i {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    .announcements-marquee {
        background: rgba(255,255,255,0.1);
        padding: 1rem 0;
        overflow: hidden;
        white-space: nowrap;
    }
    .marquee-content {
        display: inline-block;
        animation: marquee 30s linear infinite;
        color: #fff;
        font-size: 0.9rem;
    }
    @keyframes marquee {
        0% { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
    }
    .about-tabs .nav-link {
        border: none;
        color: #666;
        font-weight: 600;
        padding: 1rem 2rem;
        background: transparent;
        border-radius: 0;
        position: relative;
        transition: all 0.3s;
    }
    .about-tabs .nav-link:hover {
        color: var(--primary);
    }
    .about-tabs .nav-link.active {
        color: var(--primary);
        background: transparent;
    }
    .about-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--primary);
    }
    .core-feature-card {
        background: #fff;
        border-radius: 1rem;
        padding: 2.5rem;
        height: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        border: 1px solid #f0f0f0;
    }
    .core-feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        border-color: var(--primary);
    }
    .core-feature-card i {
        transition: transform 0.3s;
    }
    .core-feature-card:hover i {
        transform: scale(1.1);
    }
    .key-benefit-card {
        background: #fff;
        border-radius: 1rem;
        padding: 3rem;
        height: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        border: 1px solid #f0f0f0;
    }
    .key-benefit-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        border-color: var(--primary);
    }
    .schedule-day-tabs {
        border-bottom: 2px solid #e9ecef;
    }
    .schedule-day-tabs .nav-link {
        border: none;
        color: #666;
        font-weight: 600;
        padding: 1rem 2rem;
        margin: 0 0.25rem;
        background: transparent;
        border-radius: 0.5rem 0.5rem 0 0;
        transition: all 0.3s;
    }
    .schedule-day-tabs .nav-link:hover {
        color: var(--primary);
        background: rgba(99, 102, 241, 0.05);
    }
    .schedule-day-tabs .nav-link.active {
        color: var(--primary);
        background: rgba(99, 102, 241, 0.1);
        border-bottom: 3px solid var(--primary);
    }
    .schedule-day-content {
        display: none;
    }
    .schedule-day-content.active {
        display: block;
    }
    .speaker-benefit-card {
        background: #f8f9fa;
        border-radius: 1rem;
        padding: 2.5rem;
        text-align: center;
        height: 100%;
        transition: all 0.3s;
        border: 1px solid #e9ecef;
    }
    .speaker-benefit-card:hover {
        background: #fff;
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-color: var(--primary);
    }
    .speaker-benefit-card i {
        transition: transform 0.3s;
    }
    .speaker-benefit-card:hover i {
        transform: scale(1.1);
    }
    .newsletter-section {
        background: linear-gradient(135deg, var(--gradient-primary-from) 0%, var(--gradient-primary-to) 100%);
        padding: 5rem 0;
        color: #fff;
        position: relative;
    }
    .newsletter-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></svg>');
        background-size: 80px 80px;
        opacity: 0.5;
    }
    .card-speaker {
        cursor: pointer;
        transition: all 0.3s;
    }
    .card-speaker:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
    }
    a .card-speaker {
        color: inherit;
    }
    a:hover .card-speaker .card-title {
        color: var(--primary);
    }
    /* Pricing Cards */
    .pricing-card {
        border: none;
        border-radius: 1rem;
        padding: 3rem 2rem;
        text-align: center;
        transition: all 0.3s;
        position: relative;
        height: 100%;
    }
    .pricing-card.featured {
        background: linear-gradient(135deg, var(--gradient-primary-from) 0%, var(--gradient-primary-to) 100%);
        color: #fff;
        transform: scale(1.05);
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }
    .pricing-card.featured::before {
        content: 'Popular';
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(255,255,255,0.2);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .pricing-card:not(.featured) {
        background: #fff;
        box-shadow: 0 5px 30px rgba(0,0,0,0.1);
        border: 2px solid #f0f0f0;
    }
    .pricing-card:not(.featured):hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        border-color: var(--primary);
    }
    /* FAQ Styling */
    .faq-item {
        border: none;
        margin-bottom: 1rem;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .faq-item .accordion-button {
        background: #f8f9fa;
        font-weight: 600;
        border: none;
        padding: 1.25rem 1.5rem;
        font-size: 1.05rem;
    }
    .faq-item .accordion-button:not(.collapsed) {
        background: var(--primary);
        color: #fff;
        box-shadow: none;
    }
    .faq-item .accordion-button:focus {
        box-shadow: none;
        border-color: transparent;
    }
    .faq-item .accordion-body {
        background: #fff;
        padding: 1.5rem;
    }
    /* Testimonial Cards */
    .testimonial-card {
        background: #fff;
        border-radius: 1rem;
        padding: 2.5rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        height: 100%;
        transition: all 0.3s;
        border: 1px solid #f0f0f0;
    }
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container position-relative">
        @if($heroSlides->count() > 0)
        @php $slide = $heroSlides->first(); @endphp
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6 text-white">
                @if($slide->localized_subtitle)
                <p class="section-subtitle mb-3">{{ $slide->localized_subtitle }}</p>
                @endif
                <h1 class="display-3 fw-bold mb-4">{{ $slide->localized_title }}</h1>
                <p class="lead mb-4 text-white-50">{{ $slide->localized_description }}</p>
                <div class="d-flex gap-3 mb-5 flex-wrap align-items-center">
                    @if($slide->localized_button_text)
                    <a href="{{ $slide->button_link ?? '#' }}" class="btn btn-primary btn-lg px-5">{{ $slide->localized_button_text }}</a>
                    @endif
                    <a href="#" class="btn-watch-video" data-bs-toggle="modal" data-bs-target="#videoModal">
                        <i class="bi bi-play-fill"></i>
                        <span>{{ __('messages.watch_video') }}</span>
                    </a>

                    <!-- Video Modal -->
                    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content bg-transparent border-0">
                                <div class="modal-header border-0">
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-0">
                                    <div class="ratio ratio-16x9">
                                        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Countdown Timer -->
                <div class="countdown-timer">
                    <div class="countdown-item">
                        <span class="number" id="days">00</span>
                        <span class="label">{{ __('messages.days') }}</span>
                    </div>
                    <div class="countdown-item">
                        <span class="number" id="hours">00</span>
                        <span class="label">{{ __('messages.hours') }}</span>
                    </div>
                    <div class="countdown-item">
                        <span class="number" id="minutes">00</span>
                        <span class="label">{{ __('messages.minutes') }}</span>
                    </div>
                    <div class="countdown-item">
                        <span class="number" id="seconds">00</span>
                        <span class="label">{{ __('messages.seconds') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                @if($slide->image)
                <img src="{{ asset('storage/' . $slide->image) }}" alt="{{ $slide->localized_title }}" class="img-fluid rounded-4 shadow-lg">
                @endif
            </div>
        </div>
        @else
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-8 mx-auto text-center text-white">
                <p class="section-subtitle mb-3">{{ __('messages.welcome_to_evenza') }}</p>
                <h1 class="display-3 fw-bold mb-4">{{ __('messages.premier_event_experience') }}</h1>
                <p class="lead mb-4 text-white-50">{{ __('messages.join_us_description') }}</p>
                <a href="{{ route('pricing') }}" class="btn btn-primary btn-lg px-5">{{ __('messages.get_your_ticket') }}</a>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Announcements Marquee -->
<section class="announcements-marquee">
    <div class="marquee-content">
        {{ __('messages.announcements_text') }}
    </div>
</section>

<!-- Upcoming Speaker Reveal Section -->
@if($speakerRevealDate)
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <p class="section-subtitle mb-3">{{ __('messages.upcoming_speaker_reveal') }}</p>
                @if($showSpeaker && $upcomingSpeaker)
                    <h2 class="display-5 fw-bold mb-4">{{ $upcomingSpeaker->localized_name }}</h2>
                    @if($upcomingSpeaker->localized_title)
                        <p class="text-primary mb-2 fw-semibold">{{ $upcomingSpeaker->localized_title }}</p>
                    @endif
                    @if($upcomingSpeaker->localized_company)
                        <p class="text-muted mb-3">{{ $upcomingSpeaker->localized_company }}</p>
                    @endif
                    @if($upcomingSpeaker->localized_bio)
                        <p class="text-muted mb-4">{{ \Illuminate\Support\Str::limit($upcomingSpeaker->localized_bio, 150) }}</p>
                    @endif
                @else
                    <h2 class="display-5 fw-bold mb-4">{{ __('messages.speaker_announcement_coming_soon') }}</h2>
                    <p class="text-muted mb-4">{{ __('messages.stay_tuned_speaker_reveal') }}</p>
                @endif
                <div class="countdown-timer" id="speakerCountdown">
                    <div class="countdown-item">
                        <span class="number" id="speaker-days">00</span>
                        <span class="label">{{ __('messages.days') }}</span>
                    </div>
                    <div class="countdown-item">
                        <span class="number" id="speaker-hours">00</span>
                        <span class="label">{{ __('messages.hours') }}</span>
                    </div>
                    <div class="countdown-item">
                        <span class="number" id="speaker-minutes">00</span>
                        <span class="label">{{ __('messages.minutes') }}</span>
                    </div>
                    <div class="countdown-item">
                        <span class="number" id="speaker-seconds">00</span>
                        <span class="label">{{ __('messages.seconds') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="speaker-reveal-image">
                    @if($showSpeaker && $upcomingSpeaker && $upcomingSpeaker->image)
                        <img src="{{ asset('storage/' . $upcomingSpeaker->image) }}" alt="{{ $upcomingSpeaker->localized_name }}" class="img-fluid rounded-4 shadow-lg" style="max-height: 500px; width: auto; object-fit: cover;">
                    @else
                        <div class="bg-primary-subtle rounded-4 p-5" style="min-height: 400px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-person-check display-1 text-primary opacity-50"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Statistics -->
<section class="stats-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h2 class="display-4 fw-bold mb-3">25+ Institute for Professional Achievement Awards 2025</h2>
                <p class="lead opacity-90 mb-4">Recognizing excellence and innovation in professional development</p>
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3">
                            <i class="bi bi-award text-white"></i>
                        </div>
                        <div class="text-start">
                            <p class="mb-0 fw-bold">Award Winner</p>
                            <small class="opacity-75">Esther Howard</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($statistics->count() > 0)
        <div class="row g-4 mt-5">
            @foreach($statistics as $stat)
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    @if($stat->icon)<i class="{{ $stat->icon }} display-4 mb-3"></i>@endif
                    <h2>{{ $stat->value }}{{ $stat->suffix }}</h2>
                    <p class="mb-0 opacity-75">{{ $stat->title }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- About Section with Tabs -->
<section class="py-5">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="{{ asset('storage/about/about-1.jpg') }}" alt="About" class="img-fluid rounded-4 shadow-lg" onerror="this.src='https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600'">
            </div>
            <div class="col-lg-6">
                <p class="section-subtitle mb-3">{{ __('messages.about_us') }}</p>
                <h2 class="section-title display-5 fw-bold mb-4">{{ __('messages.uncover_mission') }}</h2>
                <p class="text-muted mb-4 lead">{{ __('messages.discover_vision') }}</p>

                <ul class="nav nav-tabs about-tabs mb-4 border-bottom" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#mission" type="button" role="tab">{{ __('messages.our_mission') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#vision" type="button" role="tab">{{ __('messages.our_vision') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#goal" type="button" role="tab">{{ __('messages.our_goal') }}</button>
                    </li>
                </ul>

                <div class="tab-content mb-4">
                    <div class="tab-pane fade show active" id="mission" role="tabpanel">
                        <p class="text-muted fs-6">{{ App\Models\SiteSetting::getLocalized('mission', $mission) }}</p>
                    </div>
                    <div class="tab-pane fade" id="vision" role="tabpanel">
                        <p class="text-muted fs-6">{{ App\Models\SiteSetting::getLocalized('vision', $vision) }}</p>
                    </div>
                    <div class="tab-pane fade" id="goal" role="tabpanel">
                        <p class="text-muted fs-6">{{ App\Models\SiteSetting::getLocalized('goal', $goal) }}</p>
                    </div>
                </div>

                <a href="{{ route('about') }}" class="btn btn-primary btn-lg px-4">{{ __('messages.learn_more_about') }}</a>
            </div>
        </div>
    </div>
</section>

<!-- Core Features Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <p class="section-subtitle mb-3">{{ __('messages.core_feature') }}</p>
            <h2 class="section-title display-5 fw-bold">{{ __('messages.core_features_title') }}</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="core-feature-card text-center">
                    <div class="mb-4">
                        <i class="bi bi-calendar-check display-4 text-primary"></i>
                    </div>
                    <h5 class="mb-3 fw-bold">{{ __('messages.event_planning_manage') }}</h5>
                    <p class="text-muted mb-4">{{ __('messages.event_planning_description') }}</p>
                    <a href="#" class="text-primary text-decoration-none fw-semibold">{{ __('messages.read_more') }} <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="core-feature-card text-center">
                    <div class="mb-4">
                        <i class="bi bi-people display-4 text-primary"></i>
                    </div>
                    <h5 class="mb-3 fw-bold">{{ __('messages.conference_coordination') }}</h5>
                    <p class="text-muted mb-4">{{ __('messages.event_planning_description') }}</p>
                    <a href="#" class="text-primary text-decoration-none fw-semibold">{{ __('messages.read_more') }} <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="core-feature-card text-center">
                    <div class="mb-4">
                        <i class="bi bi-building display-4 text-primary"></i>
                    </div>
                    <h5 class="mb-3 fw-bold">{{ __('messages.venue_booking_setup') }}</h5>
                    <p class="text-muted mb-4">{{ __('messages.event_planning_description') }}</p>
                    <a href="#" class="text-primary text-decoration-none fw-semibold">{{ __('messages.read_more') }} <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="core-feature-card text-center">
                    <div class="mb-4">
                        <i class="bi bi-graph-up display-4 text-primary"></i>
                    </div>
                    <h5 class="mb-3 fw-bold">{{ __('messages.post_event_analytics') }}</h5>
                    <p class="text-muted mb-4">{{ __('messages.event_planning_description') }}</p>
                    <a href="#" class="text-primary text-decoration-none fw-semibold">{{ __('messages.read_more') }} <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Key Benefits Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <p class="section-subtitle mb-3">{{ __('messages.key_benefits') }}</p>
            <h2 class="section-title display-5 fw-bold">{{ __('messages.key_advantages_title') }}</h2>
        </div>
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-6">
                <div class="key-benefit-card">
                    <div class="mb-4">
                        <i class="bi bi-mic display-3 text-primary"></i>
                    </div>
                    <h4 class="mb-3 fw-bold">{{ __('messages.expert_keynote_sessions') }}</h4>
                    <p class="text-muted fs-6">{{ __('messages.expert_keynote_description') }}</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="key-benefit-card">
                    <div class="mb-4">
                        <i class="bi bi-laptop display-3 text-primary"></i>
                    </div>
                    <h4 class="mb-3 fw-bold">{{ __('messages.advanced_event_technology') }}</h4>
                    <p class="text-muted fs-6">{{ __('messages.expert_keynote_description') }}</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('schedule') }}" class="btn btn-primary btn-lg px-5">{{ __('messages.view_our_schedule') }}</a>
        </div>
    </div>
</section>

<!-- Event Schedule with Day Tabs -->
@if($schedules->count() > 0)
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <p class="section-subtitle">{{ __('messages.our_event_schedule') }}</p>
            <h2 class="section-title display-5">{{ __('messages.explore_complete_schedule') }}</h2>
        </div>

        @php
            $days = $schedules->groupBy('day_label')->keys()->filter()->values();
            if($days->isEmpty()) {
                $days = collect(['Day 01', 'Day 02', 'Day 03']);
            }
        @endphp

        <ul class="nav nav-tabs schedule-day-tabs justify-content-center mb-4" role="tablist">
            @foreach($days as $index => $day)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $index === 0 ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#day{{ $index + 1 }}" type="button">{{ $day }}</button>
            </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach($days as $index => $day)
            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="day{{ $index + 1 }}" role="tabpanel">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        @php
                            $daySchedules = $schedules->where('day_label', $day);
                            if($daySchedules->isEmpty()) {
                                $daySchedules = $schedules->skip($index * 2)->take(4);
                            }
                        @endphp
                        @foreach($daySchedules as $schedule)
                        <div class="schedule-item mb-4 p-4 bg-white rounded shadow-sm">
                            <div class="row align-items-center g-3">
                                <div class="col-md-2 col-12">
                                    <div class="text-primary fw-bold fs-5 mb-1">
                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                        @if($schedule->end_time)
                                        - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                        @endif
                                    </div>
                                    <small class="text-muted d-block">{{ $schedule->schedule_date ? \Carbon\Carbon::parse($schedule->schedule_date)->format('d M Y') : '' }}</small>
                                </div>
                                <div class="col-md-7 col-12">
                                    <h5 class="mb-2 fw-bold">{{ $schedule->localized_title }}</h5>
                                    <p class="text-muted mb-2">{{ Str::limit($schedule->localized_description, 120) }}</p>
                                    @if($schedule->localized_venue)
                                    <small class="text-muted d-flex align-items-center gap-1">
                                        <i class="bi bi-geo-alt"></i>{{ $schedule->localized_venue }}
                                    </small>
                                    @endif
                                </div>
                                @if($schedule->speaker)
                                <div class="col-md-3 col-12 text-md-end">
                                    <div class="d-flex align-items-center justify-content-md-end gap-2">
                                        @if($schedule->speaker->image)
                                        <img src="{{ asset('storage/' . $schedule->speaker->image) }}" alt="{{ $schedule->speaker->localized_name }}" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                        @endif
                                        <div>
                                            <small class="text-primary d-block fw-bold"><i class="bi bi-person me-1"></i>{{ $schedule->speaker->localized_name }}</small>
                                            <small class="text-muted d-block">{{ $schedule->speaker->localized_title }}</small>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Speakers -->
@if($speakers->count() > 0)
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <p class="section-subtitle mb-3">{{ __('messages.our_speakers') }}</p>
            <h2 class="section-title display-5 fw-bold">{{ __('messages.expert_speakers_title') }}</h2>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($speakers->take(3) as $speaker)
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('speakers.show', $speaker->slug) }}" class="text-decoration-none text-dark">
                    <div class="card card-speaker shadow-sm h-100 border-0 overflow-hidden">
                        @if($speaker->image)
                        <img src="{{ asset('storage/' . $speaker->image) }}" alt="{{ $speaker->localized_name }}" class="card-img-top" style="height: 350px; object-fit: cover;">
                        @else
                        <div class="bg-gradient-primary d-flex align-items-center justify-content-center" style="height:350px">
                            <i class="bi bi-person display-1 text-white"></i>
                        </div>
                        @endif
                        <div class="card-body text-center p-4">
                            <h5 class="card-title mb-2 fw-bold">{{ $speaker->localized_name }}</h5>
                            <p class="text-muted mb-3">{{ $speaker->localized_title }}</p>
                            <div class="d-flex justify-content-center gap-3">
                                @if($speaker->facebook)
                                <a href="{{ $speaker->facebook }}" class="text-muted" onclick="event.stopPropagation();" title="Facebook">
                                    <i class="bi bi-facebook fs-5"></i>
                                </a>
                                @endif
                                @if($speaker->twitter)
                                <a href="{{ $speaker->twitter }}" class="text-muted" onclick="event.stopPropagation();" title="Twitter">
                                    <i class="bi bi-twitter-x fs-5"></i>
                                </a>
                                @endif
                                @if($speaker->linkedin)
                                <a href="{{ $speaker->linkedin }}" class="text-muted" onclick="event.stopPropagation();" title="LinkedIn">
                                    <i class="bi bi-linkedin fs-5"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <p class="text-muted lead">{{ __('messages.join_speaker_text') }}</p>
        </div>
    </div>
</section>
@endif

<!-- Speaker Benefits Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="speaker-benefit-card">
                    <i class="bi bi-chat-dots display-4 text-primary mb-3"></i>
                    <h5 class="mb-3">{{ __('messages.interactive_panel_discussions') }}</h5>
                    <p class="text-muted">{{ __('messages.build_meaningful_relationships') }}</p>
                    <a href="#" class="text-primary text-decoration-none">{{ __('messages.read_more_btn') }} <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="speaker-benefit-card">
                    <i class="bi bi-people display-4 text-primary mb-3"></i>
                    <h5 class="mb-3">{{ __('messages.connect_top_professionals') }}</h5>
                    <p class="text-muted">{{ __('messages.build_meaningful_relationships') }}</p>
                    <a href="#" class="text-primary text-decoration-none">{{ __('messages.read_more_btn') }} <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="speaker-benefit-card">
                    <i class="bi bi-folder display-4 text-primary mb-3"></i>
                    <h5 class="mb-3">{{ __('messages.exclusive_access_event_material') }}</h5>
                    <p class="text-muted">{{ __('messages.build_meaningful_relationships') }}</p>
                    <a href="#" class="text-primary text-decoration-none">{{ __('messages.read_more_btn') }} <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="speaker-benefit-card">
                    <i class="bi bi-bell display-4 text-primary mb-3"></i>
                    <h5 class="mb-3">{{ __('messages.realtime_event_announcement') }}</h5>
                    <p class="text-muted">{{ __('messages.build_meaningful_relationships') }}</p>
                    <a href="#" class="text-primary text-decoration-none">{{ __('messages.read_more_btn') }} <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing -->
@if($pricingPlans->count() > 0)
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <p class="section-subtitle">{{ __('messages.pricing_plan') }}</p>
            <h2 class="section-title display-5">{{ __('messages.discover_pricing_plans') }}</h2>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($pricingPlans as $plan)
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card {{ $plan->is_featured ? 'featured' : '' }}">
                    <h4>{{ $plan->localized_name }}</h4>
                    <p class="text-muted mb-3">{{ $plan->localized_description }}</p>
                    <div class="my-4">
                        <span class="display-4 fw-bold">{{ $plan->currency }}{{ number_format($plan->price, 0) }}</span>
                        <span class="text-muted">/{{ $plan->localized_duration ?? 'One-Time' }}</span>
                    </div>
                    <p class="text-muted mb-3"><small>{{ __('messages.could_relate_subscription') }}</small></p>
                    @if($plan->localized_features)
                    <ul class="list-unstyled mb-4">
                        @foreach($plan->localized_features as $feature)
                        <li class="mb-2"><i class="bi bi-check-circle me-2"></i>{{ $feature }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <a href="{{ $plan->button_link ?? route('contact') }}" class="btn {{ $plan->is_featured ? 'btn-light' : 'btn-primary' }} w-100">{{ $plan->localized_button_text }}</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <ul class="list-inline">
                <li class="list-inline-item"><i class="bi bi-check-circle text-primary me-2"></i>{{ __('messages.get_30_day_trial') }}</li>
                <li class="list-inline-item"><i class="bi bi-check-circle text-primary me-2"></i>{{ __('messages.no_hidden_fee') }}</li>
                <li class="list-inline-item"><i class="bi bi-check-circle text-primary me-2"></i>{{ __('messages.cancel_anytime') }}</li>
            </ul>
        </div>
    </div>
</section>
@endif

<!-- FAQ Section -->
@if($faqs->count() > 0)
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <p class="section-subtitle">{{ __('messages.faqs') }}</p>
            <h2 class="section-title display-5">{{ __('messages.questions_clearly_answer') }}</h2>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="accordion" id="faqAccordion">
                    @foreach($faqs as $index => $faq)
                    <div class="accordion-item faq-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}">
                                {{ $index + 1 }}. {{ $faq->localized_question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {{ $faq->localized_answer }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Testimonials -->
@if($testimonials->count() > 0)
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <p class="section-subtitle mb-3">{{ __('messages.testimonials') }}</p>
            <h2 class="section-title display-5 fw-bold">{{ __('messages.customers_say_title') }}</h2>
            <p class="text-muted lead">{{ __('messages.attendees_connected') }}</p>
            <p class="text-muted mb-4">{{ __('messages.client_experience_speak') }}</p>
        </div>
        <div class="row g-4">
            @foreach($testimonials->take(3) as $testimonial)
            <div class="col-lg-4">
                <div class="testimonial-card h-100">
                    <div class="mb-4">
                        @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= ($testimonial->rating ?? 5) ? '-fill' : '' }} text-warning"></i>
                        @endfor
                    </div>
                    <p class="text-muted mb-4 fs-6">"{{ $testimonial->localized_content }}"</p>
                    <div class="d-flex align-items-center">
                        @if($testimonial->image)
                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->localized_name }}" class="rounded-circle me-3" style="width:60px;height:60px;object-fit:cover">
                        @else
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width:60px;height:60px">
                            <span class="text-white fw-bold fs-5">{{ substr($testimonial->localized_name, 0, 1) }}</span>
                        </div>
                        @endif
                        <div>
                            <h6 class="mb-0 fw-bold">{{ $testimonial->localized_name }}</h6>
                            <small class="text-muted">{{ $testimonial->localized_title }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="#" class="btn btn-outline-primary btn-lg px-4">{{ __('messages.view_all_reviews') }}</a>
        </div>
    </div>
</section>
@endif

<!-- Sponsors -->
@if($sponsors->count() > 0)
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <p class="section-subtitle mb-3">{{ __('messages.supported_by_brands') }}</p>
        </div>
        <div class="row g-4 align-items-center justify-content-center">
            @foreach($sponsors as $sponsor)
            <div class="col-lg-2 col-md-3 col-6">
                <a href="{{ $sponsor->website ?? '#' }}" target="_blank" class="d-block text-center p-3">
                    @if($sponsor->logo)
                    <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}" class="img-fluid sponsor-logo" style="max-height:70px; width: auto;">
                    @else
                    <div class="sponsor-logo-placeholder bg-white p-4 rounded shadow-sm">
                        <span class="text-muted small fw-bold">{{ $sponsor->name }}</span>
                    </div>
                    @endif
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Blog Preview -->
@if($blogPosts->count() > 0)
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <p class="section-subtitle mb-3">{{ __('messages.latest_blog') }}</p>
            <h2 class="section-title display-5 fw-bold">{{ __('messages.explore_latest_insights') }}</h2>
        </div>
        <div class="row g-4">
            @foreach($blogPosts as $post)
            <div class="col-lg-4">
                <div class="card card-event h-100 border-0 shadow-sm">
                    @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->localized_title }}" style="height: 250px; object-fit: cover;">
                    @else
                    <div class="bg-gradient-primary d-flex align-items-center justify-content-center" style="height:250px">
                        <i class="bi bi-newspaper display-1 text-white"></i>
                    </div>
                    @endif
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                <i class="bi bi-person text-primary"></i>
                            </div>
                            <small class="text-muted fw-semibold">Esther Howard</small>
                            <small class="text-muted ms-auto"><i class="bi bi-calendar3 me-1"></i>{{ $post->created_at->format('M d, Y') }}</small>
                        </div>
                        <h5 class="card-title mb-3 fw-bold">{{ $post->localized_title }}</h5>
                        <p class="card-text text-muted mb-3">{{ Str::limit($post->localized_excerpt ?? '', 120) }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline-primary btn-sm">{{ __('messages.read_more_btn') }} <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Newsletter Subscription -->
<section class="newsletter-section position-relative overflow-hidden">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="display-4 fw-bold mb-4">{{ __('messages.join_newsletter_title') }}</h2>
                <p class="lead opacity-90 mb-3">{{ __('messages.stay_informed') }}</p>
                <p class="opacity-75 fs-5">{{ __('messages.experience_world_class') }}</p>
            </div>
            <div class="col-lg-6">
                <form action="{{ route('subscribe') }}" method="POST" class="d-flex gap-2">
                    @csrf
                    <input type="email" name="email" class="form-control form-control-lg rounded-pill px-4" placeholder="{{ __('messages.enter_email_placeholder') }}" required style="border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <button type="submit" class="btn btn-light btn-lg px-5 rounded-pill fw-semibold">{{ __('messages.subscribe') }}</button>
                </form>
                @if(session('success'))
                <div class="alert alert-success mt-3 rounded-pill">{{ session('success') }}</div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gradient-primary py-5 text-white">
    <div class="container py-5 text-center">
        <h2 class="display-5 fw-bold mb-4">{{ __('messages.ready_to_join') }}</h2>
        <p class="lead mb-4 opacity-75">{{ __('messages.dont_miss_out') }}</p>
        <a href="{{ route('pricing') }}" class="btn btn-light btn-lg px-5">{{ __('messages.get_ticket_now') }}</a>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Countdown Timer
    function updateCountdown() {
        const countdownDate = new Date('{{ $countdownDate }}').getTime();
        const now = new Date().getTime();
        const distance = countdownDate - now;

        if (distance < 0) {
            document.getElementById('days').textContent = '00';
            document.getElementById('hours').textContent = '00';
            document.getElementById('minutes').textContent = '00';
            document.getElementById('seconds').textContent = '00';
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById('days').textContent = String(days).padStart(2, '0');
        document.getElementById('hours').textContent = String(hours).padStart(2, '0');
        document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
        document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);

    // Speaker Reveal Countdown (using reveal date from site settings)
    function updateSpeakerCountdown() {
        const speakerDate = new Date('{{ $speakerRevealDate }}').getTime();
        const now = new Date().getTime();
        const distance = speakerDate - now;

        if (distance < 0) {
            document.getElementById('speaker-days').textContent = '00';
            document.getElementById('speaker-hours').textContent = '00';
            document.getElementById('speaker-minutes').textContent = '00';
            document.getElementById('speaker-seconds').textContent = '00';
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById('speaker-days').textContent = String(days).padStart(2, '0');
        document.getElementById('speaker-hours').textContent = String(hours).padStart(2, '0');
        document.getElementById('speaker-minutes').textContent = String(minutes).padStart(2, '0');
        document.getElementById('speaker-seconds').textContent = String(seconds).padStart(2, '0');
    }

    updateSpeakerCountdown();
    setInterval(updateSpeakerCountdown, 1000);
</script>
@endpush
