@extends('frontend.layouts.app')

@section('title', __('messages.page_title_gallery'))

@push('styles')
<style>
    .navbar { background: var(--dark) !important; }
    .navbar.scrolled { background: #fff !important; }
    .gallery-item { position: relative; overflow: hidden; border-radius: 0.5rem; }
    .gallery-item img { transition: transform 0.3s ease; }
    .gallery-item:hover img { transform: scale(1.1); }
    .gallery-overlay { position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); opacity: 0; transition: opacity 0.3s ease; display: flex; align-items: center; justify-content: center; }
    .gallery-item:hover .gallery-overlay { opacity: 1; }
    
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
        
        /* Filter Buttons Mobile */
        .btn-group {
            flex-wrap: wrap;
            justify-content: center;
        }
        .btn-group .btn {
            margin: 0.25rem;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }
        
        /* Gallery Grid Mobile */
        .gallery-item img {
            height: 220px !important;
        }
        .col-lg-4 {
            margin-bottom: 1rem;
        }
        
        /* Modal Mobile */
        .modal-dialog.modal-lg {
            max-width: 95%;
            margin: 1rem auto;
        }
    }
    
    @media (max-width: 576px) {
        /* Extra Small Mobile */
        .page-header h1.display-4 {
            font-size: 1.5rem !important;
        }
        .gallery-item img {
            height: 200px !important;
        }
        .btn-group .btn {
            font-size: 0.85rem;
            padding: 0.4rem 0.75rem;
        }
        .modal-dialog.modal-lg {
            max-width: 100%;
            margin: 0.5rem;
        }
    }
</style>
@endpush

@section('content')
<section class="page-header">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-white">{{ __('messages.gallery') }}</h1>
        <p class="lead text-white">{{ __('messages.gallery_subtitle') }}</p>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        @if($galleries->count() > 0)
        @php
            $types = $galleries->pluck('type')->unique()->filter();
        @endphp

        @if($types->count() > 1)
        <div class="text-center mb-5">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary active" data-filter="all">{{ __('messages.all') }}</button>
                @foreach($types as $type)
                <button type="button" class="btn btn-outline-primary" data-filter="{{ Str::slug($type) }}">{{ ucfirst($type) }}</button>
                @endforeach
            </div>
        </div>
        @endif

        <div class="row g-4" id="gallery-grid">
            @foreach($galleries as $item)
            <div class="col-md-6 col-lg-4 gallery-item-wrapper" data-category="{{ $item->type ? Str::slug($item->type) : 'other' }}">
                <div class="gallery-item">
                    @if($item->type === 'video' && $item->video_url)
                    <div class="ratio ratio-16x9">
                        @php
                            $videoId = '';
                            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $item->video_url, $match)) {
                                $videoId = $match[1];
                            }
                        @endphp
                        @if($videoId)
                        <iframe src="https://www.youtube.com/embed/{{ $videoId }}" allowfullscreen></iframe>
                        @else
                        <video controls class="w-100">
                            <source src="{{ $item->video_url }}" type="video/mp4">
                        </video>
                        @endif
                    </div>
                    @else
                    <a href="{{ asset('storage/' . $item->image) }}" data-bs-toggle="modal" data-bs-target="#galleryModal" data-image="{{ asset('storage/' . $item->image) }}" data-title="{{ $item->title }}">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="img-fluid w-100" style="height: 280px; object-fit: cover;">
                        <div class="gallery-overlay">
                            <div class="text-center text-white">
                                <i class="bi bi-zoom-in fs-2 mb-2"></i>
                                @if($item->title)
                                <h6 class="mb-0">{{ $item->title }}</h6>
                                @endif
                            </div>
                        </div>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-5">
            {{ $galleries->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-images text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3">{{ __('messages.no_gallery_items') }}</h4>
            <p class="text-muted">{{ __('messages.check_back_gallery') }}</p>
        </div>
        @endif
    </div>
</section>

<!-- Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 text-center">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
                <img src="" alt="" class="img-fluid rounded" id="modalImage">
                <h5 class="text-white mt-3" id="modalTitle"></h5>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterButtons = document.querySelectorAll('[data-filter]');
    const galleryItems = document.querySelectorAll('.gallery-item-wrapper');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.dataset.filter;

            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            galleryItems.forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Modal functionality
    const galleryModal = document.getElementById('galleryModal');
    if (galleryModal) {
        galleryModal.addEventListener('show.bs.modal', function(event) {
            const trigger = event.relatedTarget;
            const image = trigger.dataset.image;
            const title = trigger.dataset.title;

            document.getElementById('modalImage').src = image;
            document.getElementById('modalTitle').textContent = title || '';
        });
    }
});
</script>
@endpush
