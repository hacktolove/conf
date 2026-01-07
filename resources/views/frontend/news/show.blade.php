@extends('frontend.layouts.app')

@section('title', $news->localized_title . ' - Evenza')

@push('styles')
<style>
    .navbar { background: var(--dark) !important; }
    .navbar.scrolled { background: #fff !important; }
    .news-content { line-height: 1.8; }
    .news-content p { margin-bottom: 1.5rem; }
    .news-content h2, .news-content h3 { margin-top: 2rem; margin-bottom: 1rem; }
    
    /* Responsive Styles */
    @media (max-width: 768px) {
        /* Page Header Mobile */
        .page-header h1.display-5 {
            font-size: 1.75rem !important;
        }
        .page-header .d-flex {
            flex-direction: column;
            gap: 0.5rem;
        }
        .page-header .me-3 {
            margin-right: 0 !important;
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
        
        /* Main Content Mobile */
        .col-lg-8 {
            margin-bottom: 2rem;
        }
        .news-content {
            font-size: 0.95rem;
        }
        .news-content h2 {
            font-size: 1.5rem;
            margin-top: 1.5rem;
        }
        .news-content h3 {
            font-size: 1.25rem;
            margin-top: 1.5rem;
        }
        
        /* Sidebar Mobile */
        .sticky-top {
            position: relative !important;
            top: 0 !important;
        }
        .card-body {
            padding: 1.5rem !important;
        }
        .d-flex.mb-3 img,
        .d-flex.mb-3 div {
            width: 60px !important;
            height: 60px !important;
        }
        
        /* Share Buttons Mobile */
        .d-flex.gap-2 {
            flex-wrap: wrap;
        }
        .btn-sm {
            margin: 0.25rem;
        }
    }
    
    @media (max-width: 576px) {
        /* Extra Small Mobile */
        .page-header h1.display-5 {
            font-size: 1.5rem !important;
        }
        .news-content {
            font-size: 0.9rem;
        }
        .news-content h2 {
            font-size: 1.25rem;
        }
        .news-content h3 {
            font-size: 1.1rem;
        }
        .card-body {
            padding: 1.25rem !important;
        }
        h5 {
            font-size: 1rem;
        }
        h6 {
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@section('content')
<section class="page-header">
    <div class="container text-center">
        <h1 class="display-5 fw-bold">{{ $news->localized_title }}</h1>
        <div class="d-flex align-items-center justify-content-center text-white-50 mt-3">
            <span><i class="bi bi-calendar me-1"></i>{{ $news->date->format('F d, Y') }}</span>
            <span class="ms-3"><i class="bi bi-eye me-1"></i>{{ $news->views }} {{ __('messages.views') ?? 'Views' }}</span>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if($news->image)
                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->localized_title }}" class="img-fluid rounded shadow-sm mb-5 w-100">
                @endif

                <article class="news-content">
                    {!! $news->localized_body !!}
                </article>

                <div class="mt-5 pt-4 border-top">
                    <h6 class="fw-bold mb-3">Share this news:</h6>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->localized_title) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="mailto:?subject={{ urlencode($news->localized_title) }}&body={{ urlencode(request()->url()) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    @if(isset($recentNews) && $recentNews->count() > 0)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Recent News</h5>
                            @foreach($recentNews as $recentItem)
                            <div class="d-flex mb-3 pb-3 border-bottom">
                                @if($recentItem->image)
                                <img src="{{ asset('storage/' . $recentItem->image) }}" alt="{{ $recentItem->localized_title }}" class="rounded me-3" style="width: 70px; height: 70px; object-fit: cover;">
                                @else
                                <div class="bg-primary-subtle rounded d-flex align-items-center justify-content-center me-3" style="width: 70px; height: 70px;">
                                    <i class="bi bi-newspaper text-primary"></i>
                                </div>
                                @endif
                                <div>
                                    <h6 class="mb-1">
                                        <a href="{{ route('news.show', $recentItem->slug) }}" class="text-decoration-none text-dark">{{ Str::limit($recentItem->localized_title, 50) }}</a>
                                    </h6>
                                    <small class="text-muted">{{ $recentItem->date->format('M d, Y') }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="card border-0 shadow-sm bg-primary text-white">
                        <div class="card-body p-4 text-center">
                            <i class="bi bi-envelope-paper fs-1 mb-3"></i>
                            <h5 class="fw-bold mb-3">Subscribe to Our Newsletter</h5>
                            <p class="opacity-75 mb-4">Get the latest updates delivered to your inbox.</p>
                            <form action="{{ route('subscribe') }}" method="POST">
                                @csrf
                                <input type="email" name="email" class="form-control mb-3" placeholder="Your email address" required>
                                <button type="submit" class="btn btn-light w-100">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

