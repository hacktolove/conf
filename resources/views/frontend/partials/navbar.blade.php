<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            @php
                $logo = App\Models\SiteSetting::get('site_logo');
                $logoUrl = $logo ? url('/storage/' . $logo) : null;
            @endphp
            @if($logo && $logoUrl)
                <img src="{{ $logoUrl }}" alt="{{ App\Models\SiteSetting::getLocalized('site_name', 'Evenza') }}" class="navbar-brand-logo {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';">
            @endif
            @if(!$logo)
                <i class="bi bi-calendar-event {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}"></i>
            @endif
            <span>{{ App\Models\SiteSetting::getLocalized('site_name', 'Evenza') }}</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">{{ __('messages.nav_home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">{{ __('messages.nav_about') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('events*') ? 'active' : '' }}" href="{{ route('events') }}">{{ __('messages.nav_events') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('speakers*') ? 'active' : '' }}" href="{{ route('speakers') }}">{{ __('messages.nav_speakers') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('schedule') ? 'active' : '' }}" href="{{ route('schedule') }}">{{ __('messages.nav_schedule') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}" href="{{ route('blog') }}">{{ __('messages.nav_blog') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">{{ __('messages.nav_contact') }}</a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <div class="dropdown">
                    @php
                        $currentLang = app()->getLocale() ?: 'ar';
                        $isArabic = $currentLang === 'ar';
                    @endphp
                    <button class="btn btn-outline-light btn-sm dropdown-toggle d-flex align-items-center gap-2" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-globe"></i>
                        <span>{{ $isArabic ? __('messages.nav_arabic') : __('messages.nav_english') }}</span>
                    </button>
                    <ul class="dropdown-menu {{ $isArabic ? 'dropdown-menu-start' : 'dropdown-menu-end' }}" aria-labelledby="languageDropdown">
                        <li><a class="dropdown-item {{ $isArabic ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['lang' => 'ar']) }}">{{ __('messages.nav_arabic') }}</a></li>
                        <li><a class="dropdown-item {{ !$isArabic ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}">{{ __('messages.nav_english') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
