@extends('frontend.layouts.app')

@section('title', $event->localized_title . ' - Evenza')

@push('styles')
<style>
    .navbar { background: var(--dark) !important; }
    .navbar.scrolled { background: #fff !important; }

    /* Page Header Box Text Styling */
    .page-header-box h1,
    .page-header-box p {
        color: #ffffff !important;
        opacity: 1 !important;
    }
    .page-header-box .breadcrumb,
    .page-header-box .breadcrumb-item,
    .page-header-box .breadcrumb-item a {
        color: #ffffff !important;
        opacity: 1 !important;
    }

    /* Schedule Item Styling */
    .schedule-item {
        border-bottom: 1px solid var(--divider-color);
    }
    .schedule-item:last-child {
        border-bottom: none;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .schedule-item {
            flex-direction: column !important;
        }
        .schedule-time {
            margin-right: 0 !important;
            margin-bottom: 1rem;
            min-width: auto !important;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header Section Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">{{ $event->localized_title }}</h1>
                    @if($event->localized_short_description)
                    <p class="wow fadeInUp">{{ $event->localized_short_description }}</p>
                    @endif
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.nav_home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('events') }}">{{ __('messages.nav_events') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $event->localized_title }}</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header Section End -->

<!-- Page Schedule Single Start -->
<div class="page-schedule-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <!-- Page Single Sidebar Start -->
                <div class="page-single-sidebar">
                    <!-- Page Category List Start -->
                    <div class="page-category-list wow fadeInUp">
                        <h3>{{ __('messages.event_information') }}</h3>
                        <ul>
                            @if($event->event_date)
                            <li>
                                <span><i class="fa-regular fa-calendar"></i>{{ __('messages.date') }}:</span>
                                {{ $event->event_date->format('F d, Y') }}
                            </li>
                            @endif
                            @if($event->start_time)
                            <li>
                                <span><i class="fa-regular fa-clock"></i>{{ __('messages.time') }}:</span>
                                {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}
                                @if($event->end_time)
                                - {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}
                                @endif
                            </li>
                            @endif
                            @if($event->venue)
                            <li>
                                <span><i class="fa-regular fa-location-dot"></i>{{ __('messages.venue') }}:</span>
                                {{ $event->venue }}
                            </li>
                            @endif
                            @if($event->address)
                            <li>
                                <span><i class="fa-regular fa-map"></i>{{ __('messages.address') }}:</span>
                                {{ $event->address }}
                            </li>
                            @endif
                            @if($event->registration_link)
                            <li>
                                <a href="{{ $event->registration_link }}" target="_blank" class="btn-default btn-highlighted w-100 text-center d-block mt-3">
                                    <i class="fa-regular fa-user-plus me-2"></i>{{ __('messages.register_now') }}
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <!-- Page Category List End -->
                </div>
                <!-- Page Single Sidebar End -->
            </div>

            <div class="col-lg-8">
                <!-- Schedule Single Content Start -->
                <div class="schedule-single-content">
                    @if($event->image)
                    <!-- Page Single image Start -->
                    <div class="page-single-image">
                        <figure class="image-anime reveal">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->localized_title }}">
                        </figure>
                    </div>
                    <!-- Page Single image End -->
                    @endif

                    <!-- Schedule Entry Start -->
                    <div class="schedule-entry">
                        @if($event->localized_description)
                        <p class="wow fadeInUp">{!! nl2br(e($event->localized_description)) !!}</p>
                        @endif

                        @if($event->schedules->count() > 0)
                        <!-- Schedule Expect Box Start -->
                        <div class="schedule-expect-box">
                            <h2 class="text-anime-style-3">{{ __('messages.event_schedule') }}</h2>

                            <!-- Schedule Expect Box List Start -->
                            <div class="schedule-expect-box-list wow fadeInUp" data-wow-delay="0.2s">
                                @foreach($event->schedules->sortBy(['date', 'start_time']) as $schedule)
                                <div class="schedule-item d-flex mb-4 pb-4" style="border-bottom: 1px solid var(--divider-color);">
                                    <div class="schedule-time me-4 text-center" style="min-width: 100px;">
                                        <span class="badge" style="background: var(--accent-color); color: var(--white-color); padding: 8px 16px; border-radius: 8px; font-weight: 600;">
                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }}
                                        </span>
                                    </div>
                                    <div class="schedule-content flex-grow-1">
                                        <h6 class="fw-bold mb-2" style="font-size: 18px; color: var(--primary-color);">{{ $schedule->localized_title }}</h6>
                                        @if($schedule->speakers->count() > 0)
                                        <p class="mb-2" style="color: var(--text-color);">
                                            <i class="fa-regular fa-user me-1"></i>
                                            @foreach($schedule->speakers as $speaker)
                                                <a href="{{ route('speakers.show', $speaker->slug) }}" style="color: var(--accent-color); text-decoration: none;">{{ $speaker->localized_name }}</a>@if(!$loop->last), @endif
                                            @endforeach
                                        </p>
                                        @endif
                                        @if($schedule->venue_is_link && $schedule->localized_venue)
                                            <a href="{{ $schedule->localized_venue }}" target="_blank" class="btn btn-sm" style="background: var(--accent-color); color: var(--white-color); border: none; margin-top: 8px;">
                                                <i class="fa-regular fa-video me-1"></i>{{ __('messages.join_session') }}
                                            </a>
                                        @endif
                                        @if($schedule->pdf_file && $schedule->allow_download)
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/' . $schedule->pdf_file) }}" target="_blank" class="btn btn-sm" style="border: 1px solid var(--accent-color); color: var(--accent-color); background: transparent;" download>
                                                <i class="fa-regular fa-file-pdf me-1"></i>{{ __('messages.download_pdf') }}
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- Schedule Expect Box List End -->
                        </div>
                        <!-- Schedule Expect Box End -->
                        @endif
                    </div>
                    <!-- Schedule Entry End -->
                </div>
                <!-- Schedule Single Content End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Schedule Single End -->
@endsection
