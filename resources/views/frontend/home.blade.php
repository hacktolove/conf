@extends('frontend.layouts.app')

@section('title', 'Evenza - Premier Event Management')

@push('styles')
<style>
    /* Hero Carousel Styles */
    .hero-section .carousel {
        min-height: 100vh;
    }
    .hero-section .carousel-inner {
        min-height: 100vh;
    }
    .hero-section .carousel-item {
        min-height: 100vh;
    }
    .hero-section .carousel-control-prev,
    .hero-section .carousel-control-next {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0.8;
        transition: all 0.3s;
    }
    .hero-section .carousel-control-prev {
        left: 20px;
    }
    .hero-section .carousel-control-next {
        right: 20px;
    }
    .hero-section .carousel-control-prev:hover,
    .hero-section .carousel-control-next:hover {
        background: rgba(255, 255, 255, 0.3);
        opacity: 1;
    }
    .hero-section .carousel-indicators {
        bottom: 30px;
        margin-bottom: 0;
    }
    .hero-section .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        border: 2px solid rgba(255, 255, 255, 0.8);
        margin: 0 5px;
    }
    .hero-section .carousel-indicators button.active {
        background: #fff;
        border-color: #fff;
    }
    /* RTL Support for Hero Carousel */
    [dir="rtl"] .hero-section .carousel-control-prev {
        left: auto;
        right: 20px;
    }
    [dir="rtl"] .hero-section .carousel-control-next {
        right: auto;
        left: 20px;
    }
    [dir="rtl"] .hero-section .carousel-item .row {
        direction: rtl;
    }
    [dir="rtl"] .hero-section .carousel-item .col-lg-6:first-child {
        text-align: right;
    }
    [dir="rtl"] .hero-section .carousel-item .col-lg-6:last-child {
        text-align: left;
    }
    /* Ensure carousel content is always visible */
    .hero-section .carousel-item {
        opacity: 1 !important;
    }
    .hero-section .carousel-item.active {
        display: block !important;
    }
    .hero-section .carousel-item .row {
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
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
        <div class="hero-slide-single">
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
                    </div>

                    <!-- Countdown Timer (Dynamic from Database) -->
                    @if($hasCountdown)
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
                    @endif
                </div>
                <div class="col-lg-6 text-center">
                    @if($slide->image)
                    <img src="{{ asset('storage/' . $slide->image) }}" alt="{{ $slide->localized_title }}" class="img-fluid rounded-4 shadow-lg">
                    @endif
                </div>
            </div>
        </div>
        @else
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-8 mx-auto text-center text-white">
                <p class="section-subtitle mb-3">{{ __('messages.welcome_to_evenza') }}</p>
                <h1 class="display-3 fw-bold mb-4">{{ __('messages.premier_event_experience') }}</h1>
                <p class="lead mb-4 text-white-50">{{ __('messages.join_us_description') }}</p>
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-5">{{ __('messages.nav_contact') }}</a>
            </div>
        </div>
        @endif
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
                                    <small class="text-muted d-flex align-items-center gap-1 mb-2">
                                        <i class="bi bi-geo-alt"></i>{{ $schedule->localized_venue }}
                                    </small>
                                    @endif
                                    @if($schedule->pdf_file && $schedule->allow_download)
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $schedule->pdf_file) }}" target="_blank" class="btn btn-sm btn-outline-primary" download>
                                            <i class="bi bi-file-earmark-pdf me-1"></i>{{ __('messages.download_pdf') }}
                                        </a>
                                    </div>
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

<!-- CTA Section -->
<section class="bg-gradient-primary py-5 text-white">
    <div class="container py-5 text-center">
        <h2 class="display-5 fw-bold mb-4">{{ __('messages.ready_to_join') }}</h2>
        <p class="lead mb-4 opacity-75">{{ __('messages.dont_miss_out') }}</p>
        <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5">{{ __('messages.nav_contact') }}</a>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Countdown Timer (Dynamic from Database)
    @if($hasCountdown)
    function updateCountdown() {
        try {
            const countdownDateStr = '{{ $countdownDate }}';
            if (!countdownDateStr) {
                return;
            }

            const countdownDate = new Date(countdownDateStr).getTime();
            const now = new Date().getTime();

            // Check if date is valid
            if (isNaN(countdownDate)) {
                console.error('Invalid countdown date:', countdownDateStr);
                return;
            }

            const distance = countdownDate - now;

            if (distance < 0) {
                // Countdown has passed
                const daysEl = document.getElementById('days');
                const hoursEl = document.getElementById('hours');
                const minutesEl = document.getElementById('minutes');
                const secondsEl = document.getElementById('seconds');

                if (daysEl) daysEl.textContent = '00';
                if (hoursEl) hoursEl.textContent = '00';
                if (minutesEl) minutesEl.textContent = '00';
                if (secondsEl) secondsEl.textContent = '00';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const daysEl = document.getElementById('days');
            const hoursEl = document.getElementById('hours');
            const minutesEl = document.getElementById('minutes');
            const secondsEl = document.getElementById('seconds');

            if (daysEl) daysEl.textContent = String(days).padStart(2, '0');
            if (hoursEl) hoursEl.textContent = String(hours).padStart(2, '0');
            if (minutesEl) minutesEl.textContent = String(minutes).padStart(2, '0');
            if (secondsEl) secondsEl.textContent = String(seconds).padStart(2, '0');
        } catch (error) {
            console.error('Error updating countdown:', error);
        }
    }

    // Initialize countdown timer only if elements exist
    if (document.getElementById('days')) {
        updateCountdown();
        setInterval(updateCountdown, 1000);
    }
    @endif

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
