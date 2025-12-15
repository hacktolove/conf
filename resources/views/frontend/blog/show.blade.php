@extends('frontend.layouts.app')

@section('title', $post->title . ' - Evenza')

@push('styles')
<style>
    .navbar { background: var(--dark) !important; }
    .navbar.scrolled { background: #fff !important; }
    .blog-content { line-height: 1.8; }
    .blog-content p { margin-bottom: 1.5rem; }
    .blog-content h2, .blog-content h3 { margin-top: 2rem; margin-bottom: 1rem; }
</style>
@endpush

@section('content')
<section class="page-header">
    <div class="container text-center">
        @if($post->category)
        <span class="badge bg-primary mb-3">{{ $post->category }}</span>
        @endif
        <h1 class="display-5 fw-bold">{{ $post->title }}</h1>
        <div class="d-flex align-items-center justify-content-center text-white-50 mt-3">
            @if($post->user)
            <span class="me-3"><i class="bi bi-person me-1"></i>{{ $post->user->name }}</span>
            @endif
            <span><i class="bi bi-calendar me-1"></i>{{ $post->published_at ? $post->published_at->format('F d, Y') : $post->created_at->format('F d, Y') }}</span>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded shadow-sm mb-5 w-100">
                @endif

                <article class="blog-content">
                    {!! $post->content !!}
                </article>

                @if($post->tags && count($post->tags) > 0)
                <div class="mt-5 pt-4 border-top">
                    <h6 class="fw-bold mb-3">Tags:</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($post->tags as $tag)
                        <span class="badge bg-light text-dark">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="mt-5 pt-4 border-top">
                    <h6 class="fw-bold mb-3">Share this article:</h6>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="mailto:?subject={{ urlencode($post->title) }}&body={{ urlencode(request()->url()) }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-envelope"></i>
                        </a>
                    </div>
                </div>

                @if($post->user)
                <div class="mt-5 pt-4 border-top">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 70px; height: 70px;">
                            <i class="bi bi-person text-primary fs-3"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">{{ $post->user->name }}</h6>
                            <p class="text-muted mb-0">Author</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    @if(isset($recentPosts) && $recentPosts->count() > 0)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Recent Posts</h5>
                            @foreach($recentPosts as $recentPost)
                            <div class="d-flex mb-3 pb-3 border-bottom">
                                @if($recentPost->image)
                                <img src="{{ asset('storage/' . $recentPost->image) }}" alt="{{ $recentPost->title }}" class="rounded me-3" style="width: 70px; height: 70px; object-fit: cover;">
                                @else
                                <div class="bg-primary-subtle rounded d-flex align-items-center justify-content-center me-3" style="width: 70px; height: 70px;">
                                    <i class="bi bi-newspaper text-primary"></i>
                                </div>
                                @endif
                                <div>
                                    <h6 class="mb-1">
                                        <a href="{{ route('blog.show', $recentPost->slug) }}" class="text-decoration-none text-dark">{{ Str::limit($recentPost->title, 50) }}</a>
                                    </h6>
                                    <small class="text-muted">{{ $recentPost->published_at ? $recentPost->published_at->format('M d, Y') : $recentPost->created_at->format('M d, Y') }}</small>
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
