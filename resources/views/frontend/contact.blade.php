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
        <h1 class="display-4 fw-bold">Contact Us</h1>
        <p class="lead opacity-75">Get in touch with our team</p>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-5">
                <h3 class="mb-4">Get In Touch</h3>
                <p class="text-muted mb-4">Have questions about our events? Want to become a sponsor? We'd love to hear from you!</p>

                <div class="mb-4">
                    <h6><i class="bi bi-geo-alt text-primary me-2"></i> Address</h6>
                    <p class="text-muted">{{ App\Models\SiteSetting::get('contact_address', '123 Event Street, Conference City, CC 12345') }}</p>
                </div>

                <div class="mb-4">
                    <h6><i class="bi bi-envelope text-primary me-2"></i> Email</h6>
                    <p class="text-muted">{{ App\Models\SiteSetting::get('contact_email', 'info@evenza.com') }}</p>
                </div>

                <div class="mb-4">
                    <h6><i class="bi bi-telephone text-primary me-2"></i> Phone</h6>
                    <p class="text-muted">{{ App\Models\SiteSetting::get('contact_phone', '+1 (555) 123-4567') }}</p>
                </div>

                <div class="d-flex gap-3">
                    @if($fb = App\Models\SiteSetting::get('social_facebook'))<a href="{{ $fb }}" class="btn btn-outline-primary"><i class="bi bi-facebook"></i></a>@endif
                    @if($tw = App\Models\SiteSetting::get('social_twitter'))<a href="{{ $tw }}" class="btn btn-outline-primary"><i class="bi bi-twitter-x"></i></a>@endif
                    @if($ig = App\Models\SiteSetting::get('social_instagram'))<a href="{{ $ig }}" class="btn btn-outline-primary"><i class="bi bi-instagram"></i></a>@endif
                    @if($li = App\Models\SiteSetting::get('social_linkedin'))<a href="{{ $li }}" class="btn btn-outline-primary"><i class="bi bi-linkedin"></i></a>@endif
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Send us a Message</h4>

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
                                    <label class="form-label">Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email *</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Subject</label>
                                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Message *</label>
                                    <textarea class="form-control" name="message" rows="5" required>{{ old('message') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
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
