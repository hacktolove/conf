<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="mb-4">
                    @php
                        $logo = App\Models\SiteSetting::get('site_logo');
                        $logoUrl = $logo ? url('/storage/' . $logo) : null;
                    @endphp
                    @if($logo && $logoUrl)
                        <img src="{{ $logoUrl }}" alt="{{ App\Models\SiteSetting::getLocalized('site_name', 'Evenza') }}" class="footer-logo mb-3" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    @endif
                    @if(!$logo)
                        <h4 class="mb-4"><i class="bi bi-calendar-event"></i> {{ App\Models\SiteSetting::getLocalized('site_name', 'Evenza') }}</h4>
                    @endif
                </div>
                <p class="text-white-50">{{ App\Models\SiteSetting::getLocalized('site_description', 'The premier event management platform for conferences, seminars, and corporate events.') }}</p>
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
                <h6 class="text-uppercase mb-4">{{ __('messages.footer_quick_links') }}</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('about') }}">{{ __('messages.footer_about_us') }}</a></li>
                    <li class="mb-2"><a href="{{ route('events') }}">{{ __('messages.nav_events') }}</a></li>
                    <li class="mb-2"><a href="{{ route('speakers') }}">{{ __('messages.nav_speakers') }}</a></li>
                    <li class="mb-2"><a href="{{ route('schedule') }}">{{ __('messages.nav_schedule') }}</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4">
                <h6 class="text-uppercase mb-4">{{ __('messages.footer_support') }}</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('blog') }}">{{ __('messages.nav_blog') }}</a></li>
                    <li class="mb-2"><a href="{{ route('gallery') }}">{{ __('messages.footer_gallery') }}</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}">{{ __('messages.nav_contact') }}</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4">
                <h6 class="text-uppercase mb-4">{{ __('messages.footer_newsletter') }}</h6>
                <p class="text-white-50">{{ __('messages.footer_subscribe_description') }}</p>
                <form action="{{ route('subscribe') }}" method="POST" class="mt-3">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="{{ __('messages.footer_email_placeholder') }}" required>
                        <button class="btn btn-primary" type="submit">{{ __('messages.footer_subscribe') }}</button>
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
                <p class="text-white-50 mb-0">{{ __('messages.footer_all_rights_reserved', ['year' => date('Y')]) }}</p>
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
