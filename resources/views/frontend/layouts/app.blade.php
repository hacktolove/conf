<!DOCTYPE html>
@php
    $currentLocale = app()->getLocale() ?: 'ar';
    $isRTL = $currentLocale === 'ar';
@endphp
<html lang="{{ $currentLocale }}" dir="{{ $isRTL ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Evenza - Event Management')</title>
    <!-- Preconnect to Google Fonts for better performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @if($isRTL)
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @if($isRTL)
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @endif
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary: {{ config('theme.colors.primary', '#6366f1') }};
            --primary-dark: {{ config('theme.colors.primary_dark', '#4f46e5') }};
            --secondary: {{ config('theme.colors.secondary', '#059669') }};
            --accent: {{ config('theme.colors.accent', '#F79222') }};
            --dark: {{ config('theme.colors.dark', '#0f172a') }};
            --dark-light: {{ config('theme.colors.dark_light', '#1e293b') }};
            --gradient-primary-from: {{ config('theme.gradients.primary.from', '#6366f1') }};
            --gradient-primary-to: {{ config('theme.gradients.primary.to', '#8b5cf6') }};
            --gradient-hero-from: {{ config('theme.gradients.hero.from', '#0f172a') }};
            --gradient-hero-to: {{ config('theme.gradients.hero.to', '#1e293b') }};
        }
        /* Prevent horizontal scrolling */
        html, body {
            overflow-x: hidden;
            max-width: 100%;
            width: 100%;
            box-sizing: border-box;
        }
        *, *::before, *::after {
            box-sizing: border-box;
        }
        body {
            font-family: {{ $isRTL ? "'Noto Kufi Arabic', 'Arial', sans-serif" : "'Inter', sans-serif" }};
        }
        /* Make all Bootstrap icons orange (secondary color) */
        i.bi, i[class*="bi-"] {
            color: var(--secondary) !important;
        }
        /* Exceptions for specific cases that should keep their original color */
        i.bi.text-muted,
        i.bi.text-warning,
        i.bi.text-danger {
            color: inherit !important;
        }
        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }
        [dir="rtl"] .navbar-nav {
            margin-right: auto;
            margin-left: 0;
        }
        [dir="rtl"] .ms-auto {
            margin-right: auto !important;
            margin-left: 0 !important;
        }
        [dir="rtl"] .me-1, [dir="rtl"] .me-2, [dir="rtl"] .me-3 {
            margin-right: 0 !important;
            margin-left: 0.25rem !important;
        }
        [dir="rtl"] .me-2 {
            margin-left: 0.5rem !important;
        }
        [dir="rtl"] .me-3 {
            margin-left: 1rem !important;
        }
        [dir="rtl"] .ms-1, [dir="rtl"] .ms-2, [dir="rtl"] .ms-3 {
            margin-left: 0 !important;
            margin-right: 0.25rem !important;
        }
        [dir="rtl"] .ms-2 {
            margin-right: 0.5rem !important;
        }
        [dir="rtl"] .ms-3 {
            margin-right: 1rem !important;
        }
        [dir="rtl"] .text-end {
            text-align: left !important;
        }
        [dir="rtl"] .text-start {
            text-align: right !important;
        }
        [dir="rtl"] .end-0 {
            left: 0 !important;
            right: auto !important;
        }
        [dir="rtl"] .start-0 {
            right: 0 !important;
            left: auto !important;
        }
        [dir="rtl"] .schedule-item {
            border-left: none;
            border-right: 3px solid var(--primary);
            padding-left: 0;
            padding-right: 1.5rem;
        }
        /* Dropdown fixes */
        .navbar {
            overflow: visible !important;
        }
        .navbar .container {
            overflow: visible !important;
        }
        .navbar .navbar-collapse {
            overflow: visible !important;
        }
        .navbar .dropdown {
            position: relative;
        }
        .navbar .dropdown-menu {
            position: absolute !important;
            z-index: 1050 !important;
            min-width: 150px;
            top: 100% !important;
            margin-top: 0.25rem;
            max-height: none !important;
            overflow: visible !important;
            display: none;
        }
        .navbar .dropdown-menu.show {
            display: block !important;
        }
        /* Dropdown RTL fixes */
        [dir="rtl"] .dropdown-menu-end {
            right: auto !important;
            left: 0 !important;
        }
        [dir="rtl"] .dropdown-menu-start {
            left: auto !important;
            right: 0 !important;
        }
        [dir="rtl"] .dropdown-toggle::after {
            margin-left: 0;
            margin-right: 0.255em;
        }
        [dir="rtl"] .dropdown-item {
            text-align: right;
        }
        [dir="ltr"] .dropdown-item {
            text-align: left;
        }
        /* Language dropdown button RTL fixes */
        [dir="rtl"] #languageDropdown {
            flex-direction: row-reverse;
        }
        [dir="rtl"] #languageDropdown i {
            order: 2;
        }
        [dir="rtl"] #languageDropdown span {
            order: 1;
        }
        /* Ensure dropdown shows above navbar */
        .navbar .dropdown-menu {
            background: rgba(15, 23, 42, 0.98) !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        .navbar .dropdown-item {
            color: rgba(255, 255, 255, 0.9) !important;
            padding: 0.75rem 1rem;
        }
        .navbar .dropdown-item:hover,
        .navbar .dropdown-item.active {
            background: rgba(255, 255, 255, 0.1) !important;
            color: #fff !important;
        }
        .navbar {
            background: linear-gradient(135deg, var(--gradient-hero-from) 0%, var(--gradient-hero-to) 100%);
            transition: all 0.3s;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .navbar.scrolled {
            background: rgba(15, 23, 42, 0.95);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        @media (max-width: 991px) {
            .navbar {
                background: rgba(15, 23, 42, 0.98);
                overflow: visible !important;
            }
            .navbar .navbar-collapse {
                background: rgba(15, 23, 42, 1) !important;
                margin-top: 1rem;
                padding: 1.5rem;
                border-radius: 0.5rem;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
                border: 1px solid rgba(255, 255, 255, 0.1);
                overflow: visible !important;
            }
            .navbar .navbar-collapse .nav-link {
                color: rgba(255, 255, 255, 0.9) !important;
                padding: 0.75rem 1rem;
                border-radius: 0.5rem;
                margin-bottom: 0.5rem;
                transition: all 0.3s;
            }
            .navbar .navbar-collapse .nav-link:hover,
            .navbar .navbar-collapse .nav-link.active {
                background: rgba(255, 255, 255, 0.1);
                color: #fff !important;
            }
            .navbar .navbar-collapse .dropdown {
                position: relative;
            }
            .navbar .navbar-collapse .dropdown-menu {
                position: absolute !important;
                z-index: 1050 !important;
                background: rgba(15, 23, 42, 0.98) !important;
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
                margin-top: 0.5rem;
                max-height: none !important;
                overflow: visible !important;
                display: none;
            }
            .navbar .navbar-collapse .dropdown-menu.show {
                display: block !important;
            }
            .navbar .navbar-collapse .btn-outline-light {
                border-color: rgba(255, 255, 255, 0.3);
                color: rgba(255, 255, 255, 0.9);
            }
            .navbar .navbar-collapse .btn-outline-light:hover {
                background: rgba(255, 255, 255, 0.1);
                border-color: rgba(255, 255, 255, 0.5);
            }
        }
        .navbar-brand { font-weight: 700; font-size: 1.5rem; }
        .navbar-brand img,
        .navbar-brand-logo {
            max-height: 40px;
            max-width: 150px;
            width: auto;
            height: auto;
            object-fit: contain;
            display: block;
        }
        .footer-logo {
            max-height: 50px;
            max-width: 180px;
            width: auto;
            height: auto;
            object-fit: contain;
        }
        .nav-link { font-weight: 500; }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .btn-secondary { background: var(--secondary); border-color: var(--secondary); }
        .hero-section {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--gradient-hero-from) 0%, var(--gradient-hero-to) 100%);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="0.5"/></svg>');
            background-size: 100px 100px;
        }
        .section-title { font-weight: 700; margin-bottom: 1rem; }
        .section-subtitle { color: var(--primary); font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 0.85rem; }
        .card-speaker { border: none; border-radius: 1rem; overflow: hidden; transition: transform 0.3s; }
        .card-speaker:hover { transform: translateY(-10px); }
        .card-speaker img { height: 300px; object-fit: cover; }
        .card-event { border: none; border-radius: 1rem; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
        .card-event img { height: 200px; object-fit: cover; }
        .testimonial-card { background: #fff; border-radius: 1rem; padding: 2rem; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .schedule-item { border-left: 3px solid var(--primary); padding-left: 1.5rem; margin-bottom: 1.5rem; }
        .footer { background: var(--dark); color: #fff; padding: 4rem 0 2rem; }
        .footer a { color: rgba(255,255,255,0.7); text-decoration: none; }
        .footer a:hover { color: #fff; }
        .bg-gradient-primary { background: linear-gradient(135deg, var(--gradient-primary-from) 0%, var(--gradient-primary-to) 100%); }
        .gallery-item { position: relative; overflow: hidden; border-radius: 0.75rem; }
        .gallery-item img { transition: transform 0.3s; }
        .gallery-item:hover img { transform: scale(1.1); }
        .faq-item { border: none; margin-bottom: 1rem; }
        .faq-item .accordion-button { background: #f8f9fa; font-weight: 600; }
        .faq-item .accordion-button:not(.collapsed) { background: var(--primary); color: #fff; }
        .page-header { background: linear-gradient(135deg, var(--gradient-hero-from) 0%, var(--gradient-hero-to) 100%); padding: 8rem 0 4rem; color: #fff; }
    </style>
    @stack('styles')
</head>
<body>
    @include('frontend.partials.navbar')

    @yield('content')

    @include('frontend.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
