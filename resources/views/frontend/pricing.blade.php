@extends('frontend.layouts.app')

@section('title', 'Pricing - Evenza')

@push('styles')
<style>
    .navbar { background: var(--dark) !important; }
    .navbar.scrolled { background: #fff !important; }
    .pricing-card.featured { transform: scale(1.05); border: 2px solid var(--primary); }
    .pricing-card.featured .card-header { background: var(--primary); color: white; }
</style>
@endpush

@section('content')
<section class="page-header">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Pricing Plans</h1>
        <p class="lead opacity-75">Choose the perfect ticket for your experience</p>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        @if($pricingPlans->count() > 0)
        <div class="row g-4 justify-content-center">
            @foreach($pricingPlans as $plan)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow pricing-card {{ $plan->is_featured ? 'featured' : '' }}">
                    <div class="card-header text-center py-4 {{ $plan->is_featured ? '' : 'bg-light' }}">
                        @if($plan->is_featured)
                        <span class="badge bg-warning mb-2">Most Popular</span>
                        @endif
                        <h4 class="fw-bold mb-0">{{ $plan->name }}</h4>
                    </div>
                    <div class="card-body p-4 text-center">
                        <div class="pricing-value mb-4">
                            <span class="currency text-muted">{{ $plan->currency ?? '$' }}</span>
                            <span class="amount display-4 fw-bold">{{ number_format($plan->price, 0) }}</span>
                            @if($plan->period)
                            <span class="period text-muted">/ {{ $plan->period }}</span>
                            @endif
                        </div>

                        @if($plan->description)
                        <p class="text-muted mb-4">{{ $plan->description }}</p>
                        @endif

                        @if($plan->features)
                        <ul class="list-unstyled text-start mb-4">
                            @foreach($plan->features as $feature)
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                        @endif

                        @if($plan->button_link)
                        <a href="{{ $plan->button_link }}" class="btn {{ $plan->is_featured ? 'btn-primary' : 'btn-outline-primary' }} w-100">
                            {{ $plan->button_text ?? 'Get Ticket' }}
                        </a>
                        @else
                        <button class="btn {{ $plan->is_featured ? 'btn-primary' : 'btn-outline-primary' }} w-100">
                            {{ $plan->button_text ?? 'Get Ticket' }}
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-tag text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3">No Pricing Plans Available</h4>
            <p class="text-muted">Pricing information will be announced soon.</p>
        </div>
        @endif
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h3 class="fw-bold mb-3">Need a Custom Package?</h3>
                <p class="text-muted mb-0">Contact us for group discounts, corporate packages, or sponsorship opportunities. We'll create a tailored solution for your needs.</p>
            </div>
            <div class="col-lg-6 text-lg-end">
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Contact Us</a>
            </div>
        </div>
    </div>
</section>
@endsection
