@extends('frontend.layouts.app')

@section('title', __('messages.page_title_blog'))

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

        /* Blog Cards Mobile */
        .blog-card .card-body {
            padding: 1.5rem !important;
        }
        .blog-card img,
        .blog-card div {
            height: 200px !important;
        }
        .blog-card i {
            font-size: 3rem !important;
        }
        .col-lg-4 {
            margin-bottom: 1.5rem;
        }
        h5.card-title {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 576px) {
        /* Extra Small Mobile */
        .page-header h1.display-4 {
            font-size: 1.5rem !important;
        }
        .blog-card .card-body {
            padding: 1.25rem !important;
        }
        .blog-card img,
        .blog-card div {
            height: 180px !important;
        }
        .blog-card i {
            font-size: 2.5rem !important;
        }
        h5.card-title {
            font-size: 1rem;
        }
    }
</style>
@endpush

@section('content')
<section class="page-header">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-white">{{ __('messages.our_blog') }}</h1>
        <p class="lead text-white">{{ __('messages.latest_news_insights') }}</p>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        @if($posts->count() > 0)
        <div class="row g-4">
            @foreach($posts as $post)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm blog-card">
                    <div class="position-relative">
                        @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->localized_title }}" style="height: 220px; object-fit: cover;">
                        @else
                        <div class="bg-primary-subtle d-flex align-items-center justify-content-center" style="height: 220px;">
                            <i class="bi bi-newspaper text-primary" style="font-size: 4rem;"></i>
                        </div>
                        @endif
                        <!-- @if($post->localized_category)
                        <span class="badge bg-primary position-absolute top-0 start-0 m-3">{{ $post->localized_category }}</span>
                        @endif -->
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center text-muted small mb-2">
                            <i class="bi bi-calendar me-1"></i>
                            <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                            @if($post->user)
                            <span class="mx-2">|</span>
                            <i class="bi bi-person me-1"></i>
                            <span>{{ $post->user->name }}</span>
                            @endif
                        </div>
                        <h5 class="card-title fw-bold">
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none text-dark">{{ $post->localized_title }}</a>
                        </h5>
                        <p class="card-text text-muted">{{ Str::limit($post->localized_excerpt ?? strip_tags($post->localized_content ?? ''), 120) }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-link text-primary p-0">
                            {{ __('messages.read_more_link') }} <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-5">
            {{ $posts->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-journal-x text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3">{{ __('messages.no_blog_posts') }}</h4>
            <p class="text-muted">{{ __('messages.check_back_blog') }}</p>
        </div>
        @endif
    </div>
</section>
@endsection
