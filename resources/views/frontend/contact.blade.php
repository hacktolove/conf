@extends('frontend.layouts.app')

@section('title', 'Contact Us - Evenza')

@push('styles')
<style>
    .navbar { background: var(--dark) !important; }
    .navbar.scrolled { background: #fff !important; }
</style>
@endpush

@section('content')
<section class="page-header">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">{{ __('messages.contact_us') }}</h1>
        <p class="lead opacity-75">{{ __('messages.get_in_touch') }}</p>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-5 col-md-12 mb-4 mb-lg-0">
                <h3 class="mb-4">{{ __('messages.get_in_touch') }}</h3>
                <p class="text-muted mb-4">{{ __('messages.contact_description') }}</p>

                <div class="mb-4">
                    <h6><i class="bi bi-geo-alt text-primary me-2"></i> {{ __('messages.address') }}</h6>
                    <p class="text-muted">{{ App\Models\SiteSetting::getLocalized('contact_address', '123 Event Street, Conference City, CC 12345') }}</p>
                </div>

                <div class="mb-4">
                    <h6><i class="bi bi-envelope text-primary me-2"></i> {{ __('messages.email') }}</h6>
                    <p class="text-muted">{{ App\Models\SiteSetting::get('contact_email', 'info@evenza.com') }}</p>
                </div>

                <div class="mb-4">
                    <h6><i class="bi bi-telephone text-primary me-2"></i> {{ __('messages.phone') }}</h6>
                    <p class="text-muted">{{ App\Models\SiteSetting::get('contact_phone', '+1 (555) 123-4567') }}</p>
                </div>

                <div class="d-flex gap-3">
                    @if($fb = App\Models\SiteSetting::get('social_facebook'))<a href="{{ $fb }}" class="btn btn-outline-primary"><i class="bi bi-facebook"></i></a>@endif
                    @if($tw = App\Models\SiteSetting::get('social_twitter'))<a href="{{ $tw }}" class="btn btn-outline-primary"><i class="bi bi-twitter-x"></i></a>@endif
                    @if($ig = App\Models\SiteSetting::get('social_instagram'))<a href="{{ $ig }}" class="btn btn-outline-primary"><i class="bi bi-instagram"></i></a>@endif
                    @if($li = App\Models\SiteSetting::get('social_linkedin'))<a href="{{ $li }}" class="btn btn-outline-primary"><i class="bi bi-linkedin"></i></a>@endif
                </div>
            </div>

            <div class="col-lg-7 col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="mb-4">{{ __('messages.send_us_message') }}</h4>

                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.name') }} *</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.email') }} *</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.phone') }}</label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.subject') }}</label>
                                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">{{ __('messages.message') }} *</label>
                                    <textarea class="form-control" name="message" rows="5" required>{{ old('message') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">{{ __('messages.send_message') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
