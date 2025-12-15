<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h4 class="mb-4"><i class="bi bi-calendar-event"></i> Evenza</h4>
                <p class="text-white-50">{{ App\Models\SiteSetting::get('site_description', 'The premier event management platform for conferences, seminars, and corporate events.') }}</p>
                <div class="d-flex gap-3 mt-4">
                    @if($fb = App\Models\SiteSetting::get('social_facebook'))
                    <a href="{{ $fb }}" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if($tw = App\Models\SiteSetting::get('social_twitter'))
                    <a href="{{ $tw }}" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-twitter-x"></i></a>
                    @endif
                    @if($ig = App\Models\SiteSetting::get('social_instagram'))
                    <a href="{{ $ig }}" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if($li = App\Models\SiteSetting::get('social_linkedin'))
                    <a href="{{ $li }}" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-linkedin"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <h6 class="text-uppercase mb-4">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('about') }}">About Us</a></li>
                    <li class="mb-2"><a href="{{ route('events') }}">Events</a></li>
                    <li class="mb-2"><a href="{{ route('speakers') }}">Speakers</a></li>
                    <li class="mb-2"><a href="{{ route('schedule') }}">Schedule</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4">
                <h6 class="text-uppercase mb-4">Support</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('pricing') }}">Pricing</a></li>
                    <li class="mb-2"><a href="{{ route('blog') }}">Blog</a></li>
                    <li class="mb-2"><a href="{{ route('gallery') }}">Gallery</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4">
                <h6 class="text-uppercase mb-4">Newsletter</h6>
                <p class="text-white-50">Subscribe to get the latest updates and news.</p>
                <form action="{{ route('subscribe') }}" method="POST" class="mt-3">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Your email" required>
                        <button class="btn btn-primary" type="submit">Subscribe</button>
                    </div>
                </form>
                @if(session('success'))
                <div class="alert alert-success mt-2 py-2 small">{{ session('success') }}</div>
                @endif
            </div>
        </div>
        <hr class="my-4 border-secondary">
        <div class="row">
            <div class="col-md-6">
                <p class="text-white-50 mb-0">&copy; {{ date('Y') }} Evenza. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="text-white-50 mb-0">
                    @if($email = App\Models\SiteSetting::get('contact_email'))
                    <i class="bi bi-envelope me-2"></i>{{ $email }}
                    @endif
                </p>
            </div>
        </div>
    </div>
</footer>
