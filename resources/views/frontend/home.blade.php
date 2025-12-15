@extends('frontend.layouts.app')

@section('title', 'Evenza - Premier Event Management')

@push('styles')
<style>
    .countdown-timer {
        display: flex;
        gap: 2rem;
        justify-content: center;
        margin: 3rem 0;
    }
    .countdown-item {
        text-align: center;
        color: #fff;
    }
    .countdown-item .number {
        font-size: 3rem;
        font-weight: 800;
        display: block;
        line-height: 1;
    }
    .countdown-item .label {
        font-size: 0.9rem;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 1px;
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
    }
    .about-tabs .nav-link.active {
        color: var(--primary);
        border-bottom: 3px solid var(--primary);
    }
    .core-feature-card, .key-benefit-card {
        background: #fff;
        border-radius: 1rem;
        padding: 2rem;
        height: 100%;
        transition: transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    .core-feature-card:hover, .key-benefit-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .schedule-day-tabs .nav-link {
        border: none;
        color: #666;
        font-weight: 600;
        padding: 1rem 2rem;
        margin: 0 0.5rem;
    }
    .schedule-day-tabs .nav-link.active {
        color: var(--primary);
        background: rgba(99, 102, 241, 0.1);
        border-radius: 0.5rem;
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
        padding: 2rem;
        text-align: center;
        height: 100%;
    }
    .newsletter-section {
        background: linear-gradient(135deg, var(--gradient-primary-from) 0%, var(--gradient-primary-to) 100%);
        padding: 4rem 0;
        color: #fff;
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
                @if($slide->subtitle)
                <p class="section-subtitle mb-3">{{ $slide->subtitle }}</p>
                @endif
                <h1 class="display-3 fw-bold mb-4">{{ $slide->title }}</h1>
                <p class="lead mb-4 text-white-50">{{ $slide->description }}</p>
                <div class="d-flex gap-3 mb-5">
                    @if($slide->button_text)
                    <a href="{{ $slide->button_link ?? '#' }}" class="btn btn-primary btn-lg px-4">{{ $slide->button_text }}</a>
                    @endif
                    @if($slide->button_text_2)
                    <a href="{{ $slide->button_link_2 ?? '#' }}" class="btn btn-outline-light btn-lg px-4">{{ $slide->button_text_2 }}</a>
                    @endif
                </div>

                <!-- Countdown Timer -->
                <div class="countdown-timer">
                    <div class="countdown-item">
                        <span class="number" id="days">00</span>
                        <span class="label">Days</span>
                    </div>
                    <div class="countdown-item">
                        <span class="number" id="hours">00</span>
                        <span class="label">Hours</span>
                    </div>
                    <div class="countdown-item">
                        <span class="number" id="minutes">00</span>
                        <span class="label">Minutes</span>
                    </div>
                    <div class="countdown-item">
                        <span class="number" id="seconds">00</span>
                        <span class="label">Seconds</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                @if($slide->image)
                <img src="{{ asset('storage/' . $slide->image) }}" alt="{{ $slide->title }}" class="img-fluid rounded-4 shadow-lg">
                @endif
            </div>
        </div>
        @else
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-8 mx-auto text-center text-white">
                <p class="section-subtitle mb-3">Welcome to Evenza</p>
                <h1 class="display-3 fw-bold mb-4">The Premier Event Experience</h1>
                <p class="lead mb-4 text-white-50">Join us for an unforgettable experience with industry leaders and innovators.</p>
                <a href="{{ route('pricing') }}" class="btn btn-primary btn-lg px-5">Get Your Ticket</a>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Announcements Marquee -->
<section class="announcements-marquee">
    <div class="marquee-content">
        Latest Updates New Announcements Workshop Alerts Live Notices Event Countdown Workshop Alerts Quick Updates Latest Updates New Announcements Workshop Alerts Live Notices Event Countdown Workshop Alerts Quick Updates Latest Updates New Announcements Workshop Alerts Live Notices Event Countdown Workshop Alerts Quick Updates Latest Updates New Announcements Workshop Alerts Live Notices Event Countdown Workshop Alerts Quick Updates
    </div>
</section>

<!-- Statistics -->
@if($statistics->count() > 0)
<section class="stats-section">
    <div class="container">
        <div class="row g-4">
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
    </div>
</section>
@endif

<!-- About Section with Tabs -->
<section class="py-5">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600" alt="About" class="img-fluid rounded-4 shadow">
            </div>
            <div class="col-lg-6">
                <p class="section-subtitle">About Us</p>
                <h2 class="section-title display-5">Uncover our mission & purpose behind this event</h2>
                <p class="text-muted mb-4">Discover the vision that drives this event—a commitment to bringing together innovators, leaders, and changemakers to share knowledge, spark inspiration, and create meaningful connections.</p>

                <ul class="nav nav-tabs about-tabs mb-4" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#mission" type="button">Our Mission</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#vision" type="button">Our Vision</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#goal" type="button">Our Goal</button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="mission" role="tabpanel">
                        <p class="text-muted">{{ $mission }}</p>
                    </div>
                    <div class="tab-pane fade" id="vision" role="tabpanel">
                        <p class="text-muted">{{ $vision }}</p>
                    </div>
                    <div class="tab-pane fade" id="goal" role="tabpanel">
                        <p class="text-muted">{{ $goal }}</p>
                    </div>
                </div>

                <a href="{{ route('about') }}" class="btn btn-primary mt-4">Learn More About</a>
            </div>
        </div>
    </div>
</section>

<!-- Core Features Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <p class="section-subtitle">Core Feature</p>
            <h2 class="section-title display-5">Core features that power our exceptional services</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="core-feature-card">
                    <i class="bi bi-calendar-check display-4 text-primary mb-3"></i>
                    <h5 class="mb-3">Event Planning Manage</h5>
                    <p class="text-muted mb-3">Deliver seamless virtual experience with high-quality streaming and interactive tools.</p>
                    <a href="#" class="text-primary text-decoration-none">Read More <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="core-feature-card">
                    <i class="bi bi-people display-4 text-primary mb-3"></i>
                    <h5 class="mb-3">Conference Coordination</h5>
                    <p class="text-muted mb-3">Deliver seamless virtual experience with high-quality streaming and interactive tools.</p>
                    <a href="#" class="text-primary text-decoration-none">Read More <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="core-feature-card">
                    <i class="bi bi-building display-4 text-primary mb-3"></i>
                    <h5 class="mb-3">Venue Booking & Setup</h5>
                    <p class="text-muted mb-3">Deliver seamless virtual experience with high-quality streaming and interactive tools.</p>
                    <a href="#" class="text-primary text-decoration-none">Read More <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="core-feature-card">
                    <i class="bi bi-graph-up display-4 text-primary mb-3"></i>
                    <h5 class="mb-3">Post-Event Analytics</h5>
                    <p class="text-muted mb-3">Deliver seamless virtual experience with high-quality streaming and interactive tools.</p>
                    <a href="#" class="text-primary text-decoration-none">Read More <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Key Benefits Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <p class="section-subtitle">Key Benefits</p>
            <h2 class="section-title display-5">Key advantages that ensure your events stand out</h2>
        </div>
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="key-benefit-card">
                    <i class="bi bi-mic display-4 text-primary mb-3"></i>
                    <h4 class="mb-3">Expert-Led Keynote Sessions</h4>
                    <p class="text-muted">Experience inspiring keynote sessions led by industry experts who share valuable insights, trends, and strategies to help you grow personally and professionally.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="key-benefit-card">
                    <i class="bi bi-laptop display-4 text-primary mb-3"></i>
                    <h4 class="mb-3">Advanced Event Technology</h4>
                    <p class="text-muted">Experience inspiring keynote sessions led by industry experts who share valuable insights, trends, and strategies to help you grow personally and professionally.</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('schedule') }}" class="btn btn-primary btn-lg">View Our Schedule</a>
        </div>
    </div>
</section>

<!-- Event Schedule with Day Tabs -->
@if($schedules->count() > 0)
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <p class="section-subtitle">Our Event Schedule</p>
            <h2 class="section-title display-5">Explore the complete schedule for our event</h2>
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
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <div class="text-primary fw-bold">
                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                        @if($schedule->end_time)
                                        - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ $schedule->schedule_date ? \Carbon\Carbon::parse($schedule->schedule_date)->format('d M Y') : '' }}</small>
                                </div>
                                <div class="col-md-8">
                                    <h5 class="mb-2">{{ $schedule->title }}</h5>
                                    <p class="text-muted mb-2">{{ $schedule->description }}</p>
                                    @if($schedule->venue)
                                    <small class="text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $schedule->venue }}</small>
                                    @endif
                                </div>
                                @if($schedule->speaker)
                                <div class="col-md-2 text-end">
                                    <small class="text-primary"><i class="bi bi-person me-1"></i>{{ $schedule->speaker->name }}</small>
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
            <p class="section-subtitle">Our Speakers</p>
            <h2 class="section-title display-5">Introducing the expert speakers joining our event</h2>
        </div>
        <div class="row g-4">
            @foreach($speakers->take(3) as $speaker)
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('speakers.show', $speaker->slug) }}" class="text-decoration-none text-dark">
                    <div class="card card-speaker shadow-sm h-100">
                        @if($speaker->image)
                        <img src="{{ asset('storage/' . $speaker->image) }}" alt="{{ $speaker->name }}" class="card-img-top">
                        @else
                        <div class="bg-secondary d-flex align-items-center justify-content-center" style="height:300px">
                            <i class="bi bi-person display-1 text-white"></i>
                        </div>
                        @endif
                        <div class="card-body text-center">
                            <h5 class="card-title mb-1">{{ $speaker->name }}</h5>
                            <p class="text-muted small mb-2">{{ $speaker->title }}</p>
                            <div class="d-flex justify-content-center gap-2">
                                @if($speaker->facebook)<a href="{{ $speaker->facebook }}" class="text-muted" onclick="event.stopPropagation();"><i class="bi bi-facebook"></i></a>@endif
                                @if($speaker->twitter)<a href="{{ $speaker->twitter }}" class="text-muted" onclick="event.stopPropagation();"><i class="bi bi-twitter-x"></i></a>@endif
                                @if($speaker->linkedin)<a href="{{ $speaker->linkedin }}" class="text-muted" onclick="event.stopPropagation();"><i class="bi bi-linkedin"></i></a>@endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <p class="text-muted">Join our speaker and help weave innovation, quality, and success together worldwide.</p>
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
                    <h5 class="mb-3">Interactive Panel Discussions</h5>
                    <p class="text-muted">Build meaningful relationships with industry leaders, innovators.</p>
                    <a href="#" class="text-primary text-decoration-none">read more <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="speaker-benefit-card">
                    <i class="bi bi-people display-4 text-primary mb-3"></i>
                    <h5 class="mb-3">Connect With Top Professionals</h5>
                    <p class="text-muted">Build meaningful relationships with industry leaders, innovators.</p>
                    <a href="#" class="text-primary text-decoration-none">read more <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="speaker-benefit-card">
                    <i class="bi bi-folder display-4 text-primary mb-3"></i>
                    <h5 class="mb-3">Exclusive Access Event Material</h5>
                    <p class="text-muted">Build meaningful relationships with industry leaders, innovators.</p>
                    <a href="#" class="text-primary text-decoration-none">read more <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="speaker-benefit-card">
                    <i class="bi bi-bell display-4 text-primary mb-3"></i>
                    <h5 class="mb-3">Real-Time Event Announcement</h5>
                    <p class="text-muted">Build meaningful relationships with industry leaders, innovators.</p>
                    <a href="#" class="text-primary text-decoration-none">read more <i class="bi bi-arrow-right"></i></a>
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
            <p class="section-subtitle">Pricing Plan</p>
            <h2 class="section-title display-5">Discover our flexible pricing plans for attendees</h2>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($pricingPlans as $plan)
            <div class="col-lg-4 col-md-6">
                <div class="pricing-card {{ $plan->is_featured ? 'featured' : '' }}">
                    <h4>{{ $plan->name }}</h4>
                    <p class="text-muted mb-3">{{ $plan->description }}</p>
                    <div class="my-4">
                        <span class="display-4 fw-bold">{{ $plan->currency }}{{ number_format($plan->price, 0) }}</span>
                        <span class="text-muted">/{{ $plan->duration ?? 'One-Time' }}</span>
                    </div>
                    <p class="text-muted mb-3"><small>It could relate to a subscription</small></p>
                    @if($plan->features)
                    <ul class="list-unstyled mb-4">
                        @foreach($plan->features as $feature)
                        <li class="mb-2"><i class="bi bi-check-circle me-2"></i>{{ $feature }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <a href="{{ $plan->button_link ?? route('contact') }}" class="btn {{ $plan->is_featured ? 'btn-light' : 'btn-primary' }} w-100">{{ $plan->button_text }}</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <ul class="list-inline">
                <li class="list-inline-item"><i class="bi bi-check-circle text-primary me-2"></i>Get 30 day free trial</li>
                <li class="list-inline-item"><i class="bi bi-check-circle text-primary me-2"></i>No any hidden fee pay</li>
                <li class="list-inline-item"><i class="bi bi-check-circle text-primary me-2"></i>You can cancel anytime</li>
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
            <p class="section-subtitle">FAQ's</p>
            <h2 class="section-title display-5">Your Questions, Clearly Answer</h2>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="accordion" id="faqAccordion">
                    @foreach($faqs as $index => $faq)
                    <div class="accordion-item faq-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}">
                                {{ $index + 1 }}. {{ $faq->question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {{ $faq->answer }}
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
            <p class="section-subtitle">Testimonials</p>
            <h2 class="section-title display-5">What our customers say about their experience</h2>
            <p class="text-muted">Over 15,000+ Attendees Connected Worldwide</p>
            <p class="text-muted mb-4">Client Experience Speak For Themselves</p>
        </div>
        <div class="row g-4">
            @foreach($testimonials->take(3) as $testimonial)
            <div class="col-lg-4">
                <div class="testimonial-card h-100">
                    <p class="text-muted mb-4">"{{ $testimonial->content }}"</p>
                    <div class="d-flex align-items-center">
                        @if($testimonial->image)
                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="rounded-circle me-3" style="width:50px;height:50px;object-fit:cover">
                        @else
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width:50px;height:50px">
                            <span class="text-white fw-bold">{{ substr($testimonial->name, 0, 1) }}</span>
                        </div>
                        @endif
                        <div>
                            <h6 class="mb-0">{{ $testimonial->name }}</h6>
                            <small class="text-muted">{{ $testimonial->title }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="#" class="btn btn-outline-primary">View All Reviews</a>
        </div>
    </div>
</section>
@endif

<!-- Sponsors -->
@if($sponsors->count() > 0)
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <p class="section-subtitle">Supported by Brands That Inspire Innovation</p>
        </div>
        <div class="row g-4 align-items-center justify-content-center">
            @foreach($sponsors as $sponsor)
            <div class="col-lg-2 col-md-3 col-4">
                <a href="{{ $sponsor->website ?? '#' }}" target="_blank" class="d-block text-center">
                    @if($sponsor->logo)
                    <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}" class="img-fluid sponsor-logo" style="max-height:60px">
                    @else
                    <div class="sponsor-logo-placeholder bg-light p-3 rounded">
                        <span class="text-muted">{{ $sponsor->name }}</span>
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
            <p class="section-subtitle">Latest Blog</p>
            <h2 class="section-title display-5">Explore our latest insights stories and updates</h2>
        </div>
        <div class="row g-4">
            @foreach($blogPosts as $post)
            <div class="col-lg-4">
                <div class="card card-event h-100">
                    @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @else
                    <div class="bg-primary d-flex align-items-center justify-content-center" style="height:200px">
                        <i class="bi bi-newspaper display-1 text-white"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <small class="text-muted"><i class="bi bi-person me-1"></i>Esther Howard</small>
                        <h5 class="card-title mt-2">{{ $post->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($post->excerpt, 100) }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline-primary btn-sm">read more</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Newsletter Subscription -->
<section class="newsletter-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-3">Join our newsletter for event important announcement</h2>
                <p class="lead opacity-90">Stay informed with instant updates delivered straight to your inbox.</p>
                <p class="opacity-75">Experience a world-class conference designed to inspire innovation, empower professionals, and connect leaders from around the globe.</p>
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

<!-- CTA Section -->
<section class="bg-gradient-primary py-5 text-white">
    <div class="container py-5 text-center">
        <h2 class="display-5 fw-bold mb-4">Ready to Join the Event?</h2>
        <p class="lead mb-4 opacity-75">Don't miss out on this incredible opportunity to learn, connect, and grow.</p>
        <a href="{{ route('pricing') }}" class="btn btn-light btn-lg px-5">Get Your Ticket Now</a>
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
</script>
@endpush
