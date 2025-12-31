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

    /* Custom Pagination Styles */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 1rem;
        margin-top: 3rem;
    }
    .custom-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .custom-pagination .pagination-list {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .custom-pagination .pagination-item {
        margin: 0;
    }
    .custom-pagination .pagination-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0.5rem 0.75rem;
        color: #666666;
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 0.375rem;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .custom-pagination .pagination-link:hover:not(.disabled) {
        color: #333;
        border-color: #ccc;
    }
    .custom-pagination .pagination-item.active .pagination-link {
        background: var(--primary);
        color: #fff;
        border-color: #9DC89D;
        box-shadow: 0 2px 4px rgba(157, 200, 157, 0.3);
        font-weight: 600;
    }
    .custom-pagination .pagination-item.disabled .pagination-link {
        color: #999;
        background: #fff;
        border-color: #e0e0e0;
        cursor: not-allowed;
        opacity: 0.6;
    }
    .custom-pagination .pagination-item.disabled .pagination-link:hover {
        color: #999;
        border-color: #e0e0e0;
    }
    .pagination-info {
        color: #666666;
        font-size: 0.9rem;
        text-align: center;
    }

    /* RTL Support for Pagination */
    [dir="rtl"] .custom-pagination {
        direction: rtl;
    }
    [dir="rtl"] .custom-pagination .pagination-list {
        flex-direction: row;
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

        /* Pagination Mobile */
        .custom-pagination .pagination-link {
            min-width: 36px;
            height: 36px;
            padding: 0.4rem 0.6rem;
            font-size: 0.9rem;
        }
        .pagination-info {
            font-size: 0.85rem;
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

        /* Pagination Extra Small Mobile */
        .custom-pagination .pagination-link {
            min-width: 32px;
            height: 32px;
            padding: 0.3rem 0.5rem;
            font-size: 0.85rem;
        }
        .pagination-info {
            font-size: 0.8rem;
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
        <div class="pagination-wrapper">
            {{ $speakers->links('vendor.pagination.custom') }}
            @if($speakers->hasPages())
            <div class="pagination-info">
                @if(app()->getLocale() === 'ar')
                    عرض {{ $speakers->firstItem() ?? 0 }} إلى {{ $speakers->lastItem() ?? 0 }} من {{ $speakers->total() }} نتيجة
                @else
                    Showing {{ $speakers->firstItem() ?? 0 }} to {{ $speakers->lastItem() ?? 0 }} of {{ $speakers->total() }} results
                @endif
            </div>
            @endif
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
